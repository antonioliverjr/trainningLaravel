<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required|email:rfc,dns',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Coloque o nome do Cliente!',
            'email.required' => 'Coloque o e-mail do Cliente!',
            'email' => 'Digite um e-mail valido',
        ];
    }
}
