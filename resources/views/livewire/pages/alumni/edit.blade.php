<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\Alumni;
use App\Models\Profession;
use App\Models\Research;

new #[Layout('layouts.app')] class extends Component {
    use WithFileUploads;

    public $name = '';
    public $email = '';
    public $email_profile = '';
    public $phone_number = '';
    public $photo;
    public $password = '';
    public $password_confirmation = '';

    // Job fields (Profession model)
    public $company_name = '';
    public $position = '';
    public $city = '';
    public $province = '';

    // Social media fields (Alumni model)
    public $instagram = '';
    public $linkedin = '';
    public $twitter = '';
    public $facebook = '';

    // Competency (Alumni model)
    public $tags = [];

    // Karya Ilmiah fields (Research model)
    public $karyaIlmiah = [];
    public $newKarya = [
        'title' => '',
        'type' => '',
        'year' => '',
        'link' => ''
    ];

    public function mount()
    {
        $user = Auth::user();
        $alumni = $user->alumni;

        // User data
        $this->name = $user->name;
        $this->email = $user->email;

        if ($alumni) {
            // Alumni data
            $this->email_profile = $alumni->email ?? '';
            $this->phone_number = $alumni->phone_number ?? '';
            $this->instagram = $alumni->instagram ?? '';
            $this->linkedin = $alumni->linkedin ?? '';
            $this->twitter = $alumni->x ?? '';
            $this->facebook = $alumni->facebook ?? '';
            $this->tags = $alumni->competency ?? [];

            // Profession data
            if ($alumni->profession) {
                $this->company_name = $alumni->profession->company ?? '';
                $this->position = $alumni->profession->profession ?? '';
                $this->city = $alumni->profession->city ?? '';
                $this->province = $alumni->profession->province ?? '';
            }

            // Research data
            if ($alumni->research) {
                $this->karyaIlmiah = $alumni->research->map(function ($research) {
                    return [
                        'id' => $research->id,
                        'title' => $research->title,
                        'type' => $research->type,
                        'year' => $research->publication_year,
                        'link' => $research->publication_link,
                        'publisher' => $research->publisher
                    ];
                })->toArray();
            }
        }
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:5120', // 5MB Max
        ]);
    }

    public function deletePhoto()
    {
        $alumni = Auth::user()->alumni;
        if ($alumni) {
            $alumni->profile_photo_path = null;
            $alumni->save();
        }
        $this->photo = null;
    }

    public function addKaryaIlmiah()
    {
        $this->validate([
            'newKarya.title' => 'required|string|max:255',
            'newKarya.type' => 'required|string|max:100',
            'newKarya.year' => 'required|numeric|digits:4|min:1900|max:' . (date('Y') + 1),
            'newKarya.link' => 'nullable|url|max:500'
        ], [
            'newKarya.title.required' => 'Judul karya ilmiah wajib diisi',
            'newKarya.type.required' => 'Jenis karya ilmiah wajib diisi',
            'newKarya.year.required' => 'Tahun wajib diisi',
            'newKarya.year.numeric' => 'Tahun harus berupa angka',
            'newKarya.year.digits' => 'Tahun harus 4 digit',
            'newKarya.link.url' => 'Tautan harus berupa URL yang valid'
        ]);

        $this->karyaIlmiah[] = [
            'title' => $this->newKarya['title'],
            'type' => $this->newKarya['type'],
            'year' => $this->newKarya['year'],
            'link' => $this->newKarya['link']
        ];

        // Reset form
        $this->newKarya = [
            'title' => '',
            'type' => '',
            'year' => '',
            'link' => ''
        ];

        $this->resetValidation(['newKarya.title', 'newKarya.type', 'newKarya.year', 'newKarya.link']);
    }

    public function removeKaryaIlmiah($index)
    {
        // If it has an ID, it means it exists in database, so delete it
        if (isset($this->karyaIlmiah[$index]['id'])) {
            $research = Research::find($this->karyaIlmiah[$index]['id']);
            if ($research) {
                $research->delete();
            }
        }

        unset($this->karyaIlmiah[$index]);
        $this->karyaIlmiah = array_values($this->karyaIlmiah); // Re-index array
    }

    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'email_profile' => 'nullable|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:5120',
            'company_name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
        ];

        // Only validate password if it's being changed
        if (!empty($this->password)) {
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        }

        $validated = $this->validate($rules);

        $user = Auth::user();

        // Update User model
        $user->name = $this->name;
        $user->email = $this->email;

        // Update password if provided
        if (!empty($this->password)) {
            $user->password = Hash::make($this->password);
            $this->password = '';
            $this->password_confirmation = '';
        }

        $user->save();

        // Get or create Alumni record
        $alumni = $user->alumni;
        if (!$alumni) {
            $alumni = new Alumni();
            $alumni->user_id = $user->id;
            $alumni->name = $user->name;
        }

        // Update Alumni model
        $alumni->email = $this->email_profile;
        $alumni->phone_number = $this->phone_number;
        $alumni->instagram = $this->instagram;
        $alumni->linkedin = $this->linkedin;
        $alumni->x = $this->twitter;
        $alumni->facebook = $this->facebook;
        $alumni->competency = $this->tags;

        if ($this->photo) {
            $path = $this->photo->store('profile-photos', 'public');
            $alumni->profile_photo_path = $path;
        }

        $alumni->save();

        $profession = $alumni->profession;
        if (!$profession) {
            $profession = new Profession();
            $profession->alumni_id = $alumni->id;
        }

        $profession->company = $this->company_name;
        $profession->profession = $this->position;
        $profession->city = $this->city;
        $profession->province = $this->province;
        $profession->save();

        // Update Research (Karya Ilmiah)
        // Delete all existing research and recreate them
        $alumni->research()->delete();

        foreach ($this->karyaIlmiah as $karya) {
            Research::create([
                'alumni_id' => $alumni->id,
                'title' => $karya['title'],
                'type' => $karya['type'],
                'publication_year' => $karya['year'],
                'publication_link' => $karya['link'] ?? null,
                'publisher' => $karya['publisher'] ?? null,
            ]);
        }

        session()->flash('message', 'Profile updated successfully!');
    }
}; ?>

<div class="min-h-screen bg-gray-50 py-4 sm:py-8 font-noto">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow">
            <!-- Header -->
            <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-200">
                <h2 class="text-lg sm:text-xl font-semibold text-gray-900">Profil</h2>
                <p class="mt-1 text-xs sm:text-sm text-gray-500">Perbarui foto dan detail pribadi Anda di sini.</p>
            </div>

            <!-- Form -->
            <div class="px-4 sm:px-6 py-4 sm:py-6 space-y-6 sm:space-y-10">
                <!-- Full Name -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-8 items-start">
                    <label class="block text-sm font-medium text-gray-700 md:pt-2">
                        Nama lengkap
                    </label>
                    <div class="md:col-span-2">
                        <input type="text" wire:model="name"
                            class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none text-sm">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-8 items-start">
                    <label class="block text-sm font-medium text-gray-700 md:pt-2">
                        Email
                    </label>
                    <div class="md:col-span-2">
                        <input type="email" wire:model="email"
                            class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none text-sm">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-8 items-start">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Email untuk profil
                        </label>
                        <p class="mt-1 text-xs sm:text-xm text-gray-500">Alamat email yang akan ditampilkan di halaman profil anda.
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        <input type="email" wire:model="email_profile"
                            class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none text-sm">
                        @error('email_profile')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-8 items-start">
                    <label class="block text-sm font-medium text-gray-700 md:pt-2">
                        Nomor Telepon
                    </label>
                    <div class="md:col-span-2">
                        <input type="text" wire:model="phone_number"
                            class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none text-sm">
                        @error('phone_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Your photo -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-8 items-start">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Foto profil anda
                        </label>
                        <p class="mt-1 text-xs sm:text-xm text-gray-500">Foto ini akan ditampilkan di profil Anda.</p>
                    </div>
                    <div class="md:col-span-2">
                        <div class="flex items-center space-x-4">
                            <!-- Profile Image -->
                            <div class="flex-shrink-0">
                                @if ($photo)
                                    <img class="h-16 w-16 rounded-full object-cover" src="{{ $photo->temporaryUrl() }}"
                                        alt="Profile photo">
                                @elseif(Auth::user()->alumni && Auth::user()->alumni->profile_photo_path)
                                    <img class="h-16 w-16 rounded-full object-cover"
                                        src="{{ asset('storage/' . Auth::user()->alumni->profile_photo_path) }}"
                                        alt="Profile photo">
                                @else
                                    <img class="h-16 w-16 rounded-full object-cover bg-gray-500"
                                        src="https://ui-avatars.com/api/?name={{ urlencode($name) }}&background=10b981&color=fff&size=128"
                                        alt="Profile photo">
                                @endif
                            </div>
                        </div>

                        @error('photo')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Change Password -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-8 items-start">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Ubah password
                        </label>
                        <p class="mt-1 text-xs sm:text-xm text-gray-500">Perbarui kata sandi Anda untuk menjaga keamanan akun.</p>
                    </div>
                    <div class="md:col-span-2 grid gap-4 md:grid-cols-2" x-data="{ showPassword: false, showConfirmPassword: false }">
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                            <div class="relative">
                                <input :type="showPassword ? 'text' : 'password'" id="password" wire:model="password"
                                    class="w-full h-10 px-3 py-2 pr-10 border border-gray-300 rounded-md focus:outline-none text-sm">
                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700"
                                >
                                    <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5M12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5s5 2.24 5 5s-2.24 5-5 5m0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3s3-1.34 3-3s-1.34-3-3-3"/>
                                    </svg>
                                    <svg x-show="!showPassword" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M14.33 7.17A15.642 15.642 0 0 0 12 7c-4.97 0-9 2.239-9 5c0 1.44 1.096 2.738 2.85 3.65l2.362-2.362a4 4 0 0 1 5.076-5.076zm-3.1 8.756a4 4 0 0 0 4.695-4.695l2.648-2.647C20.078 9.478 21 10.68 21 12c0 2.761-4.03 5-9 5c-.598 0-1.183-.032-1.749-.094zm6.563-10.719a1 1 0 1 1 1.414 1.414L6.48 19.35a1 1 0 1 1-1.414-1.414z"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                                Kata Sandi</label>
                            <div class="relative">
                                <input :type="showConfirmPassword ? 'text' : 'password'" id="password_confirmation" wire:model="password_confirmation"
                                    class="w-full h-10 px-3 py-2 pr-10 border border-gray-300 rounded-md focus:outline-none text-sm">
                                <button
                                    type="button"
                                    @click="showConfirmPassword = !showConfirmPassword"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700"
                                >
                                    <svg x-show="showConfirmPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5M12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5s5 2.24 5 5s-2.24 5-5 5m0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3s3-1.34 3-3s-1.34-3-3-3"/>
                                    </svg>
                                    <svg x-show="!showConfirmPassword" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M14.33 7.17A15.642 15.642 0 0 0 12 7c-4.97 0-9 2.239-9 5c0 1.44 1.096 2.738 2.85 3.65l2.362-2.362a4 4 0 0 1 5.076-5.076zm-3.1 8.756a4 4 0 0 0 4.695-4.695l2.648-2.647C20.078 9.478 21 10.68 21 12c0 2.761-4.03 5-9 5c-.598 0-1.183-.032-1.749-.094zm6.563-10.719a1 1 0 1 1 1.414 1.414L6.48 19.35a1 1 0 1 1-1.414-1.414z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Information -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-8 items-start">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Pekerjaan
                        </label>
                        <p class="mt-1 text-xs sm:text-xm text-gray-500">Informasi tentang pekerjaan dan lokasi Anda saat ini.
                        </p>
                    </div>
                    <div class="md:col-span-2 grid gap-4 md:grid-cols-2 w-full">
                        <div class="space-y-2">
                            <div class="space-y-2">
                                <label for="company_name" class="text-sm font-medium text-gray-700">Nama
                                    Perusahaan</label>
                                <input type="text" id="company_name" wire:model="company_name"
                                    class="w-full h-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none text-sm">
                            </div>
                            <div class="space-y-2">
                                <label for="city" class="text-sm font-medium text-gray-700">Kota</label>
                                <input type="text" id="city" wire:model="city"
                                    class="w-full h-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none text-sm">
                            </div>

                        </div>

                        <div class="space-y-2">
                            <div class="space-y-2">
                                <label for="position" class="text-sm font-medium text-gray-700">Posisi</label>
                                <input type="text" id="position" wire:model="position"
                                    class="w-full h-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none text-sm">
                            </div>


                            <div class="space-y-2">
                                <label for="province" class="text-sm font-medium text-gray-700">Provinsi</label>
                                <input type="text" id="province" wire:model="province"
                                    class="w-full h-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none text-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-8 items-start">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Akun Media Sosial Anda
                        </label>
                        <p class="mt-1 text-[12px] sm:text-[13px] text-gray-500">Tambahkan akun media sosial Anda agar orang lain dapat terhubung
                            dengan Anda.</p>
                    </div>
                    <div class="md:col-span-2 grid gap-4 md:grid-cols-2 w-full">
                        <div class="space-y-2">
                            <div class="space-y-2">
                                <label for="instagram" class="text-sm font-medium text-gray-700">Instagram</label>
                                <div class="flex rounded-md shadow-sm">
                                    <span
                                        class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                        instagram.com/
                                    </span>
                                    <input type="text" id="instagram" wire:model="instagram"
                                        class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md border border-gray-300 focus:outline-none text-sm">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="linkedin" class="text-sm font-medium text-gray-700">Linkedin</label>
                                <div class="flex rounded-md shadow-sm">
                                    <span
                                        class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                        linkedin.com/
                                    </span>
                                    <input type="text" id="linkedin" wire:model="linkedin"
                                        class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md border border-gray-300 focus:outline-none text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="space-y-2">
                                <label for="twitter" class="text-sm font-medium text-gray-700">X (twitter)</label>
                                <div class="flex rounded-md shadow-sm">
                                    <span
                                        class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                        x.com/
                                    </span>
                                    <input type="text" id="twitter" wire:model="twitter"
                                        class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md border border-gray-300 focus:outline-none text-sm">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="facebook" class="text-sm font-medium text-gray-700">Facebook</label>
                                <div class="flex rounded-md shadow-sm">
                                    <span
                                        class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                        facebook.com/
                                    </span>
                                    <input type="text" id="facebook" wire:model="facebook"
                                        class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md border border-gray-300 focus:outline-none text-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-8 items-start">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Kompetensi
                        </label>
                        <p class="mt-1 text-[12px] sm:text-[13px] text-gray-500">Anda bisa menambahkan kompetensi atau kemampuan yang
                            anda miliki.</p>
                    </div>
                    <div class="md:col-span-2" x-data="{
                             tags: @entangle('tags'),
                             tagInput: '',

                             addTag() {
                                 const newTag = this.tagInput.trim();
                                 if (newTag === '') return;

                                 if (!this.tags.includes(newTag)) {
                                     this.tags.push(newTag);
                                 }

                                 this.tagInput = '';

                             },
                             removeTag(index) {
                                 this.tags.splice(index, 1);

                             }
                         }">
                        <div
                            class="flex flex-wrap items-center border border-gray-300 rounded-md p-2 gap-2 min-h-[42px] ">
                            <template x-for="(tag, index) in tags" :key="index">
                                <div
                                    class="flex items-center bg-primary-green-500 text-primary-green-900 px-2 bg-opacity-50 py-1 text-sm font-medium">
                                    <span x-text="tag"></span>
                                    <button type="button" @click="removeTag(index)"
                                        class="ml-2 font-bold text-lg leading-none">
                                        &times;
                                    </button>
                                </div>
                            </template>
                            <input type="text" x-model="tagInput" @keydown.enter.prevent="addTag()"
                                placeholder="Tambahkan tag..."
                                class="flex-1 border-none outline-none focus:ring-0 text-sm min-w-[120px] p-1" />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-8 items-start">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Karya ilmiah
                        </label>
                        <p class="mt-1 text-[12px] sm:text-[13px] text-gray-500">Tambahkan karya ilmiah atau publikasi yang telah Anda buat.</p>
                    </div>
                    <div class="md:col-span-2 space-y-4">
                        @if(count($karyaIlmiah) > 0)
                            <div class="space-y-3">
                                @foreach($karyaIlmiah as $index => $karya)
                                    <div class="border border-gray-200 rounded-md p-4 bg-gray-50">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <h4 class="font-medium text-gray-900 text-sm">{{ $karya['title'] }}</h4>
                                                <p class="text-xs text-gray-600 mt-1">
                                                    {{ $karya['type'] }} • {{ $karya['year'] }}
                                                </p>
                                                @if(!empty($karya['link']))
                                                    <a href="{{ $karya['link'] }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-800 mt-1 inline-block">
                                                        Lihat Publikasi →
                                                    </a>
                                                @endif
                                            </div>
                                            <button
                                                type="button"
                                                wire:click="removeKaryaIlmiah({{ $index }})"
                                                class="text-red-600 hover:text-red-800 ml-4 p-1"
                                                title="Hapus"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="border border-gray-300 rounded-md p-4">
                            <div class="grid gap-4 md:grid-cols-2 w-full">
                                <div class="space-y-2">
                                    <div class="space-y-2">
                                        <label for="karya_title" class="text-sm font-medium text-gray-700">Judul</label>
                                        <input type="text" id="karya_title" wire:model="newKarya.title" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none text-sm">
                                        @error('newKarya.title')
                                            <p class="text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="space-y-2">
                                        <label for="karya_year" class="text-sm font-medium text-gray-700">Tahun</label>
                                        <input type="number" id="karya_year" wire:model="newKarya.year" placeholder="2024" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none text-sm">
                                        @error('newKarya.year')
                                            <p class="text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="space-y-2">
                                        <label for="karya_type" class="text-sm font-medium text-gray-700">Jenis karya ilmiah</label>
                                        <input type="text" id="karya_type" wire:model="newKarya.type" placeholder="Jurnal, Konferensi, dll" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none text-sm">
                                        @error('newKarya.type')
                                            <p class="text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="space-y-2">
                                        <label for="karya_link" class="text-sm font-medium text-gray-700">Tautan (opsional)</label>
                                        <input type="url" id="karya_link" wire:model="newKarya.link" placeholder="https://..." class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none text-sm">
                                        @error('newKarya.link')
                                            <p class="text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end mt-4">
                                <button
                                    type="button"
                                    wire:click="addKaryaIlmiah"
                                    class="inline-flex items-center gap-2 justify-center border-primary-green-800 border-b-2 rounded-md text-sm bg-primary-green-500 py-2 px-4 font-medium text-white transition-all duration-200 hover:bg-primary-green-600 hover:scale-105 active:scale-95"
                                >

                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512" class="transition-transform duration-200">
                                        <path fill="#ffffff" d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zm149.3 277.3c0 11.8-9.5 21.3-21.3 21.3h-85.3V384c0 11.8-9.5 21.3-21.3 21.3h-42.7c-11.8 0-21.3-9.6-21.3-21.3v-85.3H128c-11.8 0-21.3-9.6-21.3-21.3v-42.7c0-11.8 9.5-21.3 21.3-21.3h85.3V128c0-11.8 9.5-21.3 21.3-21.3h42.7c11.8 0 21.3 9.6 21.3 21.3v85.3H384c11.8 0 21.3 9.6 21.3 21.3v42.7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-4 sm:px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-lg flex flex-col sm:flex-row justify-end gap-3 sm:space-x-3">
                <x-button type="button" variant="secondary" onclick="window.history.back()" class="w-full sm:w-auto justify-center">Batal</x-button>
                <x-button type="button" wire:click="save" class="w-full sm:w-auto justify-center">Simpan perubahan</x-button>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="mt-4 bg-green-50 border border-green-200 rounded-md p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">
                            {{ session('message') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
