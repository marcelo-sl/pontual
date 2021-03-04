<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'gender' => ['required', 'max:1']
        ];
    }

    public function attributes()
    {
        return [
          'name' => 'Nome',
          'email' => 'E-mail',
          'password' => 'Senha',
          'gender' => 'Sexo'
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