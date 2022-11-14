<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BayarRequest extends FormRequest
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
            'operator_id' => ['required','max : 255'],
            'tanggal' => ['required','max : 255'],
            'nominal' => ['required','max : 255'],
        ];
    }
}
