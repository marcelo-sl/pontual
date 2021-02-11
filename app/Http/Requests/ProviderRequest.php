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
      $rules = [
        'provider.cpf' => ['required', 'unique:providers,cpf', new Cpf],
        'provider.nickname' => ['required'],
        'provider.activities' => ['required'],
        'provider.user_id' => ['required'],
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
        $attributes = [
          'provider.cpf' => 'CPF',
          'provider.nickname' => 'Nome comercial',
          'provider.activities' => 'Ramo(s) de Atividade(s)',
          'localization.cep' => 'CEP',
          'localization.address' => 'Logradouro',
          'localization.house_number' => 'Nº da casa',
          'localization.district' => 'Bairro',
          'localization.address_complement' => 'Complemento',
          'localization.city_id' => 'Cidade',
          'hours.range_hour' => 'Tempo de atendimento',
          'hours.start_break' => 'Início do almoço',
          'hours.end_break' => 'Fim do almoço',
          'hours.end_break' => 'Fim do almoço',
        ];

        $days = [
          'Domingo', 
          'Segunda-feira', 
          'Terça-feira', 
          'Quarta-feira',
          'Quinta-feira',
          'Sexta-feira',
          'Sábado',
        ];

        if ($this->request->get('day_hours')) {
          foreach($this->request->get('day_hours') as $d => $dayHour)
          {
            $attributes['day_hours.'.$d.'.start_hour'] = 'horário de entrada de '.$days[$d];
            $attributes['day_hours.'.$d.'.end_hour'] = 'horário de saída de '.$days[$d];
          }
        }
  
        return $attributes;
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