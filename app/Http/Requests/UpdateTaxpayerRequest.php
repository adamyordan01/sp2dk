<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaxpayerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'npwp' => ['required','min:15', 'max:15', 'numeric', Rule::unique('taxpayers', 'npwp')->ignore($this->taxpayer()->id)],
            'nama' => ['required'],
            'user_id' => ['required'],
            'kasi_id' => ['required']
        ];
    }
}
