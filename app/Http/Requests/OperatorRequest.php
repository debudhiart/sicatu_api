<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperatorRequest extends FormRequest
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
            'users_id' => ['required','max : 255'],
            'jabatan_id' => ['required','max : 255'],
            'nama_operator' => ['required','unique:operator'] ,
            'alamat' => ['required', 'max : 255'],
            'hp' => ['required','max : 13','unique:operator'],
        ];
    }
}
