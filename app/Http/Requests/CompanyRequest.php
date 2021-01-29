<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company.trade_name' => ['required', 'max:45'],
            'company.company_name' => ['required', 'max:80'],
            'company.cnpj' => ['required', 'max:18'],
            'company.description' => ['max:65530'],
            'company.user_id' => ['numeric'],
            'localization.cep' => ['required', 'max:9'],
            'localization.address' => ['required', 'max:255'],
            'localization.house_number' => ['required', 'max:5'],
            'localization.district' => ['required', 'max:60'],
            'localization.address_complement' => ['max:45'],
            'localization.city_id' => ['required', 'numeric'],
        ];
    }

    public function attributes()
    {
        return [
            'company.trade_name' => 'Nome fantasia',
            'company.company_name' => 'Razão Social',
            'company.cnpj' => 'CNPJ',
            'company.description' => 'Descrição',
            'company.user_id' => 'Identificação do usuário',
            'localization.cep' => 'CEP',
            'localization.address' => 'Logradouro',
            'localization.house_number' => 'Nº da casa',
            'localization.district' => 'Bairro',
            'localization.address_complement' => 'Complemento',
            'localization.city_id' => 'Cidade',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'Já existe um registro com o valor informado em :attribute.',
            'min' => 'O campo :attribute deve possuir no mínimo :min caracteres.',
            'max' => 'O campo :attribute deve possuir no máximo :max caracteres.',
            'confirmed' => 'A confirmação do campo :attribute não é válida.'
        ];
    }
}