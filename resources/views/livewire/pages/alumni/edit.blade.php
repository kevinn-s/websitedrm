<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage as StorageFacade;
use Illuminate\Validation\Rule;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Models\Alumni;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

new #[Layout('layouts.app')] class extends Component {
    use WithFileUploads;

    public Alumni $alumni;

    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $city = '';

    public string $province = '';

    public string $job = '';

    public string $company = '';

    public string $linkedin = '';

    public string $facebook = '';

    public string $x = '';

    public string $instagram = '';

    public array $competencies = [];

    public $avatar;

    public array $researches = [];

    public function mount()
    {
        $user = Auth::user();

        if (! $user || ! $user->alumni) {
            throw new NotFoundHttpException();
        }

    $this->alumni = $user->alumni()->first();
    $this->alumni?->loadMissing(['profession', 'research']);

    $this->avatar = null;

        $this->name = $this->alumni->name;
        $this->email = $this->alumni->email;
        $this->phone = $this->alumni->phone_number ?? '';
        $this->linkedin = $this->alumni->linkedin ?? '';
        $this->facebook = $this->alumni->facebook ?? '';
        $this->instagram = $this->alumni->instagram ?? '';
        $this->x = $this->alumni->x ?? '';

        $profession = $this->alumni->profession;
        $this->job = $profession->profession ?? '';
        $this->company = $profession->company ?? '';
        $this->city = $profession->city ?? '';
        $this->province = $profession->province ?? '';

        $this->competencies = is_array($this->alumni->competency) ? $this->alumni->competency : [];

        // Load all research records
        $this->researches = $this->alumni->research()->get()->map(function ($research) {
            return [
                'id' => $research->id,
                'title' => $research->title ?? '',
                'type' => $research->type ?? '',
                'publication_year' => $research->publication_year ?? '',
                'publisher' => $research->publisher ?? '',
                'publication_link' => $research->publication_link ?? '',
            ];
        })->toArray();

        // Add empty research if none exist
        if (empty($this->researches)) {
            $this->researches[] = [
                'id' => null,
                'title' => '',
                'type' => '',
                'publication_year' => '',
                'publisher' => '',
                'publication_link' => '',
            ];
        }
    }    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('alumni', 'email')->ignore($this->alumni->id),
                Rule::unique('users', 'email')->ignore($this->alumni->user_id ?? $this->alumni->user?->id),
            ],
            'phone' => ['nullable', 'string', 'max:30'],
            'city' => ['nullable', 'string', 'max:120',],
            'province' => ['nullable', 'string', 'max:120',],
            'job' => ['nullable', 'string', 'max:120', ],
            'company' => ['nullable', 'string', 'max:120'],
            'linkedin' => ['nullable', 'string', 'max:100'],
            'facebook' => ['nullable', 'string', 'max:100'],
            'instagram' => ['nullable', 'string', 'max:100'],
            'x' => ['nullable', 'string', 'max:100'],
            'competencies' => ['array'],
            'competencies.*' => ['string', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:2048'], // 2MB max
            'researches' => ['array'],
            'researches.*.title' => ['nullable', 'string', 'max:255'],
            'researches.*.type' => ['nullable', 'string', 'max:120'],
            'researches.*.publication_year' => ['nullable', 'string', 'max:10'],
            'researches.*.publisher' => ['nullable', 'string', 'max:255'],
            'researches.*.publication_link' => ['nullable', 'url', 'max:255'],
        ];
    }

    public function update()
    {
        $this->validate();

        DB::transaction(function () {
            $alumniData = [
                'name' => trim($this->name),
                'email' => trim($this->email),
                'phone_number' => $this->sanitizeString($this->phone),
                'linkedin' => $this->sanitizeString($this->linkedin),
                'facebook' => $this->sanitizeString($this->facebook),
                'instagram' => $this->sanitizeString($this->instagram),
                'x' => $this->sanitizeString($this->x),
                'competency' => $this->sanitizeCompetencies(),
            ];

            if ($this->avatar instanceof TemporaryUploadedFile) {
                $newAvatarPath = $this->avatar->store('profile', 'public');

              
                if ($this->alumni->profile_photo_path) {
                    StorageFacade::disk('public')->delete($this->alumni->profile_photo_path);
                }

                $alumniData['profile_photo_path'] = $newAvatarPath;
            } elseif (is_string($this->avatar) && StorageFacade::disk('public')->exists($this->avatar)) {
                $alumniData['profile_photo_path'] = $this->avatar;
            }

            $this->alumni->update($alumniData);
            $this->alumni->user?->update([
                'name' => trim($this->name),
                'email' => trim($this->email),
            ]);

            $professionPayload = $this->professionPayload();

            if ($professionPayload) {
                $this->alumni->profession()->updateOrCreate([], $professionPayload);
            } elseif ($this->alumni->profession) {
                $this->alumni->profession()->delete();
            }

            // Handle multiple research records
            $existingResearchIds = $this->alumni->research()->pluck('id')->toArray();
            $updatedResearchIds = [];

            foreach ($this->researches as $researchData) {
                $payload = $this->buildResearchPayload($researchData);
                
                if ($payload) {
                    if (!empty($researchData['id'])) {
                        // Update existing
                        $research = $this->alumni->research()->find($researchData['id']);
                        if ($research) {
                            $research->update($payload);
                            $updatedResearchIds[] = $researchData['id'];
                        }
                    } else {
                        // Create new
                        $newResearch = $this->alumni->research()->create($payload);
                        $updatedResearchIds[] = $newResearch->id;
                    }
                }
            }

            // Delete research records that were removed
            $researchToDelete = array_diff($existingResearchIds, $updatedResearchIds);
            if (!empty($researchToDelete)) {
                $this->alumni->research()->whereIn('id', $researchToDelete)->delete();
            }
        });

        $this->resetAvatarState();

        session()->flash('message', 'Profile updated successfully.');

        return redirect()->route('profile');
    }

    protected function sanitizeCompetencies(): ?array
    {
        $clean = array_values(array_filter(
            array_map(fn ($value) => is_string($value) ? trim($value) : $value, $this->competencies),
            fn ($value) => filled($value)
        ));

        return empty($clean) ? null : $clean;
    }

    protected function professionPayload(): ?array
    {
        $sanitized = [
            $this->sanitizeString($this->job),
            $this->sanitizeString($this->company),
            $this->sanitizeString($this->city),
            $this->sanitizeString($this->province),
        ];

        if (! array_filter($sanitized, fn ($value) => filled($value))) {
            return null;
        }

        return [
            'profession' => $this->sanitizeString($this->job) ?? '',
            'company' => $this->sanitizeString($this->company),
            'city' => $this->sanitizeString($this->city) ?? '',
            'province' => $this->sanitizeString($this->province) ?? '',
        ];
    }

    protected function buildResearchPayload(array $researchData): ?array
    {
        $payload = [
            'title' => $this->sanitizeString($researchData['title'] ?? ''),
            'type' => $this->sanitizeString($researchData['type'] ?? ''),
            'publication_year' => $this->sanitizeString($researchData['publication_year'] ?? ''),
            'publisher' => $this->sanitizeString($researchData['publisher'] ?? ''),
            'publication_link' => $this->sanitizeString($researchData['publication_link'] ?? ''),
        ];

        if (! array_filter($payload, fn ($value) => filled($value))) {
            return null;
        }

        return $payload;
    }

    public function addResearch(): void
    {
        $this->researches[] = [
            'id' => null,
            'title' => '',
            'type' => '',
            'publication_year' => '',
            'publisher' => '',
            'publication_link' => '',
        ];
    }

    public function removeResearch(int $index): void
    {
        unset($this->researches[$index]);
        $this->researches = array_values($this->researches);
    }

    protected function researchPayload(): ?array
    {
        $payload = [
            'title' => $this->sanitizeString($this->researchTitle),
            'type' => $this->sanitizeString($this->researchType),
            'publication_year' => $this->sanitizeString($this->researchYear),
            'publisher' => $this->sanitizeString($this->researchPublisher),
            'publication_link' => $this->sanitizeString($this->researchLink),
        ];

        if (! array_filter($payload, fn ($value) => filled($value))) {
            return null;
        }

        return $payload;
    }

    protected function resetAvatarState(): void
    {
        $this->avatar = null;

        $this->alumni->refresh();

        $this->name = $this->alumni->name;
        $this->email = $this->alumni->email;
        $this->phone = $this->alumni->phone_number ?? '';
        $this->linkedin = $this->alumni->linkedin ?? '';
        $this->facebook = $this->alumni->facebook ?? '';
        $this->instagram = $this->alumni->instagram ?? '';
        $this->x = $this->alumni->x ?? '';
        $this->competencies = is_array($this->alumni->competency) ? $this->alumni->competency : [];

        $profession = $this->alumni->profession;
        $this->job = $profession->profession ?? '';
        $this->company = $profession->company ?? '';
        $this->city = $profession->city ?? '';
        $this->province = $profession->province ?? '';

        // Reload research records
        $this->researches = $this->alumni->research()->get()->map(function ($research) {
            return [
                'id' => $research->id,
                'title' => $research->title ?? '',
                'type' => $research->type ?? '',
                'publication_year' => $research->publication_year ?? '',
                'publisher' => $research->publisher ?? '',
                'publication_link' => $research->publication_link ?? '',
            ];
        })->toArray();

        if (empty($this->researches)) {
            $this->researches[] = [
                'id' => null,
                'title' => '',
                'type' => '',
                'publication_year' => '',
                'publisher' => '',
                'publication_link' => '',
            ];
        }
    }

    protected function sanitizeString(?string $value): ?string
    {
        if (! is_string($value)) {
            return null;
        }

        $trimmed = trim($value);

        return $trimmed === '' ? null : $trimmed;
    }
}; ?>
@php
    $currentAvatar = $alumni->profile_photo_path
        ? StorageFacade::url($alumni->profile_photo_path)
        : asset('images/placeholder.png');
@endphp

<div class="px-6 py-4 md:px-36 md:pt-16 pb-28 bg-white">
    <h2 class="text-2xl font-bold mb-8">Edit Profil Anda</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="update" class="w-full md:w-10/12 lg:w-8/12 xl:w-8/12 space-y-8">

        <fieldset class="space-y-2">
          
              <x-file
                wire:model.live="avatar"
                accept="image/*"
    
                crop-after-change
                class="w-full"
            >
                <img src="{{ $currentAvatar }}" alt="Foto Profil" class="h-40 w-40 rounded-full object-cover bg-gray-200" />
            </x-file>
            @error('avatar')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </fieldset>
        <fieldset class="space-y-6">

            <x-input class="w-full h-10 border-[0.4px] border-gray-300" label="Nama Lengkap" required
                wire:model="name"></x-input>

            <x-input class="w-full h-10 border-[0.4px] border-gray-300" label="Email" required
                wire:model="email"></x-input>

            <x-input class="w-full h-10 border-[0.4px] border-gray-300" label="Nomor Telepon"
                wire:model="phone"></x-input>

            <div class="w-full space-y-2">
                <label>Domisili Pekerjaan</label>
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1">
                        <x-input class="w-full border-[0.4px] border-gray-300" placeholder="Kota"
                        wire:model="city"
                        ></x-input>
                    </div>
                    <div class="flex-1">
                        <x-input class="w-full border-[0.4px] border-gray-300" placeholder="Provinsi"
                        wire:model="province"
                        ></x-input>
                    </div>
                </div>
            </div>

            <div class="w-full space-y-2">
                <label>Pekerjaan</label>
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1">
                        <x-input class="w-full border-[0.4px] border-gray-300" placeholder="Posisi"
                        wire:model="job"
                        ></x-input>
                    </div>
                    <div class="flex-1">
                        <x-input class="w-full border-[0.4px] border-gray-300" placeholder="Nama Perusahaan"
                        wire:model="company"
                        ></x-input>
                    </div>
                </div>
            </div>

            <div class="w-full space-y-2">
                <label>Akun Media Sosial</label>
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1">
                        <x-input class="w-full border-[0.4px] border-gray-300" placeholder="linkedin"
                        wire:model="linkedin"
                        ></x-input>
                    </div>
                    <div class="flex-1">
                        <x-input class="w-full border-[0.4px] border-gray-300" placeholder="facebook"
                        wire:model="facebook"
                        ></x-input>
                    </div>                                     
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1">
                        <x-input class="w-full border-[0.4px] border-gray-300" placeholder="instagram"
                        wire:model="instagram"
                        ></x-input>
                    </div>
                    <div class="flex-1">
                        <x-input class="w-full border-[0.4px] border-gray-300" placeholder="X"
                        wire:model="x"
                        ></x-input>
                    </div>   
                </div>
            </div>

            <div class="w-full space-y-2">
                <label for="competencies">Kompetensi</label>
                <x-tag-input name="competencies" wire:model="competencies" placeholder="Silahkan isi kompetensi anda"
                    input-class="border-gray-300 border-[0.4px]" class="space-y-2" />
            </div>

            <!-- Multiple Research Records Section -->
            <div class="space-y-6 border-t pt-6">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                    <h3 class="text-lg font-semibold">Karya Ilmiah</h3>
                    <button type="button" wire:click="addResearch"
                        class="hidden sm:inline-flex px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                        + Tambah Karya Ilmiah
                    </button>
                </div>

                @foreach($researches as $index => $research)
                    <div class="p-4 border border-gray-200 space-y-4 bg-gray-50">
                        <div class="flex justify-between items-center">
                            <h4 class="font-medium text-gray-700">Karya Ilmiah {{ $index + 1 }}</h4>
                            @if(count($researches) > 1)
                                <button type="button" wire:click="removeResearch({{ $index }})"
                                    class="px-3 py-1 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                    Hapus
                                </button>
                            @endif
                        </div>

                        <x-input class="w-full h-10 border-[0.4px] border-gray-300" label="Judul Karya Ilmiah"
                            wire:model="researches.{{ $index }}.title"></x-input>
                        
                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="flex-1">
                                <x-input class="w-full border-[0.4px] border-gray-300 h-10" label="Jenis Karya Ilmiah"
                                    wire:model="researches.{{ $index }}.type"></x-input>
                            </div>
                            <div class="flex-1">
                                <x-input class="w-full border-[0.4px] border-gray-300 h-10" label="Tahun Publikasi"
                                    wire:model="researches.{{ $index }}.publication_year"></x-input>
                            </div>
                        </div>
                        
                        <x-input class="w-full h-10 border-[0.4px] border-gray-300" label="Penerbit"
                            wire:model="researches.{{ $index }}.publisher"></x-input>
                        
                        <x-input class="w-full h-10 border-[0.4px] border-gray-300" label="Tautan Publikasi"
                            wire:model="researches.{{ $index }}.publication_link"></x-input>
                    </div>
                @endforeach

                <!-- Mobile Add Button (shown at bottom) -->
                <button type="button" wire:click="addResearch"
                    class="sm:hidden w-full px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    + Tambah Karya Ilmiah
                </button>
            </div>

        </fieldset>
        <div>
            <button   wire:loading.attr="disabled" 
    wire:target="photo"  type="submit" class="bg-primary-green text-white px-4 py-2 rounded hover:bg-blue-600">
                Update Profile
            </button>
        </div>

    </form>

</div>

 <!-- 'city' => ['nullable', 'string', 'max:120', 'required_with:job,province,company'],
            'province' => ['nullable', 'string', 'max:120', 'required_with:job,city,company'],
            'job' => ['nullable', 'string', 'max:120', 'required_with:city,province,company'], -->