<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestCliente extends FormRequest
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

        if($this->method() == "PUT"){
            return [
                'nome' => ['required', 'string', 'max:255','regex:/^([a-zA-Zà-úÀ-Ú]|-|_|\s)+$/'],
                'cpf' => ['required', 'string', 'regex:/^([0-9]|-|-|-|.|\s)+$/'],
                'telefone' => ['required', 'string', 'regex:/^([0-9]|-|-|-|.|\s)+$/'],
                'nascimento' => ['required', 'date'],
                'email' => ['required', 'string', 'max:255']
            ];
        }

        if($this->method() == "POST"){
            return [
                'nome' => ['required', 'string', 'max:255','regex:/^([a-zA-Zà-úÀ-Ú]|-|_|\s)+$/'],
                'cpf' => ['required', 'string', 'regex:/^([0-9]|-|-|-|.|\s)+$/'],
                'telefone' => ['required', 'string', 'regex:/^([0-9]|-|-|-|.|\s)+$/'],
                'nascimento' => ['required', 'date'],
                'email' => ['required', 'string', 'max:255']
            ];
        }
    }

    public function attributes(){
        return [
            'nome' => "Nome Completo",
            'cpf' => "CPF",
            'telefone' => "Telefone",
            'nascimento' => "Data de Nascimento",
            'email' => "E-mail"
            //
        ];
    }
}
