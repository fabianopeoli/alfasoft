<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class UserRequest extends FormRequest
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
            'name' => 'required|string|min:5|max:128',
            'contact' => 'required|size:9',
            'email' => 'required|email',
        ];
    }

    /**
     * Get the personalized messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório!',
            'name.string' => 'O nome precisa ser uma string!',
            'name.min' => 'O nome precisa ter no mínimo 5 caracteres!',
            'name.max' => 'O nome precisa ter no máximo 128 caracteres!',

            'contact.unique' => 'Contato existente. Tente outro!',
            'contact.required' => 'O contato é obrigatório!',
            'contact.size' => 'O contato precisa ter 9 dígitos!',

            'email.unique' => 'O email já foi registrado anteriormente!',
            'email.required' => 'O email é obrigatório!',
            'email.email' => 'O email precisa ser um email válido!',
        ];
    }
}
