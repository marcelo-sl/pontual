<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Cpf;

class ProviderRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
      return [
        'provider.cpf' => ['required', 'unique:providers,cpf', new Cpf],
        'provider.nickname' => ['required'],
        'provider.activities' => ['required'],
        'provider.user_id' => ['required'],
      ];
    }

    public function attributes()
    {
        return [
          'provider.cpf' => 'CPF',
          'provider.nickname' => 'Nome comercial',
          'provider.activities' => 'Ramo(s) de Atividade(s)',
        ];
    }

    public function messages()
    {
        return [
          'required' => 'O campo :attribute é obrigatório.',
          'email' => 'Informe um e-mail válido.',
          'unique' => 'Já existe um registro com o valor informado em :attribute.',
          'min' => 'O campo :attribute deve possuir no mínimo :min caracteres.',
          'max' => 'O campo :attribute deve possuir no máximo :max caracteres.',
          'confirmed' => 'A confirmação do campo :attribute não é válida.'
        ];
    }
}