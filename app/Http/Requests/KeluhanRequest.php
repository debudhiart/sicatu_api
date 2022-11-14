<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeluhanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'desa_id' => ['required','max : 255'],
            'pelanggan_id' => ['required','max : 255'],
            'keluhan' => ['required','max : 255'],
            'status_keluhan' => ['required','max : 255'],
            'respon' => ['max : 255'],
            'before_photo' => ['max : 255'],
            'after_photo' => ['max : 255'],
            'lat' => ['max : 255'],
            'lng' => ['max : 255'],
        ];
    }
}
