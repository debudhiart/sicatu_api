<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JadwalPelangganRequest extends FormRequest
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
            'shift_id' => ['required','max : 255'],
            'pelanggan_id' => ['required','max : 255'],
            'desa_id' => ['required','max : 255'],
            'hari' => ['required','max : 255'],
        ];
    }
}
