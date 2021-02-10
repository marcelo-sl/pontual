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
        $rules = [
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
            'hours.range_hour' => ['required', 'numeric'],
            'hours.start_break' => ['required_with:hours.has_break_time', 'nullable', 'regex:/([01]?[0-9]|2[0-3]):[0-5][0-9]/'],
            'hours.end_break' => ['required_with:hours.has_break_time', 'nullable', 'regex:/([01]?[0-9]|2[0-3]):[0-5][0-9]/'],
        ];

        if ($this->request->get('day_hours')) {
            foreach($this->request->get('day_hours') as $key => $dayHour)
            {
              $rules['day_hours.'.$key.'.start_hour'] = 'required_without:day_hours.'.$key.'.is_closed';
              $rules['day_hours.'.$key.'.end_hour'] = 'required_without:day_hours.'.$key.'.is_closed';
            }
        }

        return $rules;
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
            'hours.range_hour' => 'Tempo de atendimento',
            'hours.start_break' => 'Início do almoço',
            'hours.end_break' => 'Fim do almoço',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'required_with' => 'O campo :attribute é obrigatório se o "Parada de almoço" estiver preenchido.',
            'required_without' => 'O campo :attribute é obrigatório se o campo "Fechado" não estiver preenchido.',
            'unique' => 'Já existe um registro com o valor informado em :attribute.',
            'min' => 'O campo :attribute deve possuir no mínimo :min caracteres.',
            'max' => 'O campo :attribute deve possuir no máximo :max caracteres.',
            'confirmed' => 'A confirmação do campo :attribute não é válida.',
            'regex' => 'O formato do campo :attribute é inválido.'
        ];
    }
}