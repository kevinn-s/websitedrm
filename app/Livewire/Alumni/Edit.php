<?php

namespace App\Livewire\Alumni;

use Livewire\Component;
use App\Models\Alumni;
class Edit extends Component
{
    public Alumni $alumni;


    public $name = '';

    public $phone_number = '';

    public $instagram = '';
    public $x = '';
    public $facebook = '';

    public $linkedin = '';

    public $research = [];

    public $competency = [];

    public function mount($alumni)
    {

        $this->alumni = $alumni;

        $this->name = $alumni->name;

        $this->instagram = $alumni->instagram ?? '';
        $this->linkedin = $alumni->linkedin ?? '';


        $this->research = $alumni->research
            ->map(function ($r) {
                return [
                    'id' => $r->id ?? null,
                    'title' => $r->title ?? '',
                    'type' => $r->type ?? '',
                    'publication_year' => $r->publication_year ?? date('Y'),
                    'publisher' => $r->publisher ?? '',
                    'publication_link' => $r->publication_link ?? '',
                ];
            })->toArray();

        if (empty($this->research)) {
            $this->research = [];
        }
        $this->competency = $alumni->competency ?? [];


    }
    public function render()
    {
        return view('livewire.alumni.edit');
    }

    public function save()
    {

        $this->alumni->update([
            'name' => $this->name,
            'instagram' => $this->instagram,
            'x' => $this->x,
            'facebook' => $this->facebook,
            'linkedin' => $this->linkedin,
            'competency' => $this->competency
        ]);
        $incomingIds = collect($this->research)
            ->pluck('id')
            ->filter()
            ->toArray();

        $this->alumni->research()
            ->whereNotIn('id', $incomingIds)
            ->delete();


        foreach ($this->research as $data) {
            if (isset($data['id'])) {
                $this->alumni->research()
                    ->where('id', $data['id'])
                    ->update($data);
            } else {
                if (!empty($data['title'])) {
                    $this->alumni->research()->create($data);
                }
            }
        }
        return redirect()->route('alumni.profile', $this->alumni->id);
    }
}
