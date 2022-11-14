<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PelangganRequest extends FormRequest
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
            'users_id' => ['max : 255'],
            'desa_id' => ['max : 255'],
            'nama_pelanggan' => ['unique:pelanggan'] ,
            'alamat' => ['max : 255'],
            'hp' => ['max : 13','unique:pelanggan'],
            'lat' => ['max : 13'],
            'lng' => ['max : 13'],
        ];
    }
}
