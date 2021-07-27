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
            'title' => 'required',
            'description' => 'required',
            'pages' => 'required',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Coloque o nome do Livro!',
            'description.required' => 'Informe uma descrição do Livro!',
            'pages.required' => 'Informe a quantidade de paginas do Livro',
            'price.required' => 'Informe o preço do Livro',
        ];
    }
}
