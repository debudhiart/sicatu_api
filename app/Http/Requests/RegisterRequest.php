<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'nama' => ['required','max : 255'] ,
            // 'roles_id' => ['required','max : 255'],
            // 'desa_id' => ['required','max : 255'],
            'email' => ['required', 'unique:users',],
            'password' => ['required','max : 255'] ,
            // 'password_confirmed' => ['required','same:password'],
            'address' => ['required'], 
        ];
    }
}
