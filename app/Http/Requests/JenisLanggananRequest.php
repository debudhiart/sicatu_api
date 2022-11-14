<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenisLanggananRequest extends FormRequest
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
            'nama_jenis_langganan' => ['required','max : 255'],
            'harga' => ['required','max : 255'],
        ];
    }
}
