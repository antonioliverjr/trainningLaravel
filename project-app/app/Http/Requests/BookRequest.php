<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title'=>'required',
            'pages'=>'required',
            'price'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Coloque o nome do Cliente!',
            'pages.required' => 'Coloque o e-mail do Cliente!',
            'price' => 'Digite um e-mail valido',
        ];
    }
}
