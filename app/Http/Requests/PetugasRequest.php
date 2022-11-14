<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetugasRequest extends FormRequest
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
            'users_id' => ['required','max : 255'],
            'desa_id' => ['required','max : 255'],
            'nama_petugas' => ['required','unique:petugas'] ,
            'alamat' => ['required', 'max : 255'],
            'hp' => ['required','max : 13','unique:petugas'],
        ];
    }
}
