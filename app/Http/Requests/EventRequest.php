<?php

namespace App\Http\Requests;

use App\Enums\EventCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => 'required|min:5|max:255',
            'category'    => ['required', new Enum(EventCategory::class)],
            'description' => 'nullable|string',
            'image'       => 'nullable',
            'detail.date'         => 'required_if:category,regular|nullable|date',
            'detail.start_at'     => 'required_if:category,regular|nullable|date',
            'detail.end_at'       => 'nullable|date|after_or_equal:detail.start_at',
            'detail.location'     => 'required_if:category,regular|nullable|string|max:255',
            'detail.map_url'      => 'nullable|url',
            'detail.meeting_url'  => 'nullable|url',
            'detail.gallery'      => 'nullable|array',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required'             => 'Judul kegiatan wajib diisi.',
            'detail.date.required_if'    => 'Tanggal wajib diisi untuk kegiatan Reguler.',
            'detail.start_at.required_if'=> 'Waktu mulai wajib diisi untuk kegiatan Reguler.',
            'detail.location.required_if' => 'Lokasi atau Platform wajib diisi untuk kegiatan Reguler.',
            'detail.end_at.after_or_equal' => 'Waktu selesai tidak boleh mendahului waktu mulai.',
            'detail.map_url.url'         => 'Format Link Google Maps tidak valid.',
            'detail.meeting_url.url'     => 'Format Link Meeting tidak valid.',
        ];
    }
}
