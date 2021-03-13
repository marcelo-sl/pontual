<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Storage;

use App\{
  Company,
  WorkingHour,
  Schedule,
  Address,
  State,
  City,
  User,
  Contact,
  FieldActivity
};

use DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();

        return view('companies.index', compact('companies'));
    }

     /**
     * Get the days of week that the company is not working
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id = company identification
     * @return \Illuminate\Http\Response
     */
    public function getDaysOfWeekDisabled(Request $request, $id) 
    {
      $daysOfWeek = [0, 1, 2, 3, 4, 5, 6];

      $workingDays = WorkingHour::where('company_id', $id)->pluck('week_day')->toArray();
      $daysOfWeekDisabled = array_values(array_diff($daysOfWeek, $workingDays));

      return $daysOfWeekDisabled;
    }

     /**
     * Get the hours available in according of the date
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id = company or provider identification
     * @return \Illuminate\Http\Response
     */
    public function getAvailableHours(Request $request, $id, $date) 
    {
      $dayofweek = date('w', strtotime($date));
      $dateFormatted = date("Y-m-d", strtotime($date));
      $schedules = Schedule::where('company_id', $id)->select('date_time')->get()->toArray();

      $workingHour = WorkingHour::where('company_id', $id)
                      ->where('week_day', $dayofweek)
                      ->select(
                        'start_hour',
                        'end_hour',
                        'range_hour',
                        'start_break',
                        'end_break'
                      )->first();

      // Convertendo hora para minutos
      $startHour = idate('H', strtotime($workingHour['start_hour']));
      $startMin = idate('i', strtotime($workingHour['start_hour']));
      $startInt = $startHour * 60 + $startMin;
      
      $endHour = idate('H', strtotime($workingHour['end_hour']));
      $endMin = idate('i', strtotime($workingHour['end_hour']));
      $endInt = $endHour * 60 + $endMin;
      
      $startBreakHour = idate('H', strtotime($workingHour['start_break']));
      $startBreakMin = idate('i', strtotime($workingHour['start_break']));
      $startBreakInt = $startBreakHour * 60 + $startBreakMin;
      
      $endBreakHour = idate('H', strtotime($workingHour['end_break']));
      $endBreakMin = idate('i', strtotime($workingHour['end_break']));
      $endBreakInt = $endBreakHour * 60 + $endBreakMin;

      $availableHours = [];
      $i = 0;
    
      for (
        $hour = $startInt; 
        ($hour + $workingHour['range_hour']) < $endInt;
        $hour += $workingHour['range_hour']
      ) { 
        $availableHours[$i]['hour'] = date("H:i", $hour * 60);

        if (
          ($hour + $workingHour['range_hour']) >= $startBreakInt 
          && $hour < $endBreakInt
        ) {
          $availableHours[$i]['available'] = false;
        } 
        else 
        {
          $hourFormatted = date('H:i:s' , $hour * 60);
          $datetimeString = $dateFormatted." ".$hourFormatted;
          $datetimeFormatted = date("Y-m-d H:i:s", strtotime($datetimeString));
          $datetimeRegistered = in_array($datetimeFormatted, $schedules);
          
          foreach ($schedules as $schedule) {
            if ($datetimeFormatted === $schedule['date_time']) {
              $datetimeRegistered = true;
            }
          }

          if ($datetimeRegistered) {
            $availableHours[$i]['available'] = false;
          } else {
            $availableHours[$i]['available'] = true;
          }
        }

        $i++;
      }

      return json_encode($availableHours);
    }

    public function getSchedules($id)
    {
      $schedules = Company::findOrFail($id)->schedules()->orderBy('date_time', 'ASC')->get();

      return view('users.schedules', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $fields_activity = FieldActivity::all();
      $states = State::orderBy('state')->get();
      $cities = City::orderBy('city')->get();
      $days = [
        'Domingo', 
        'Segunda-feira', 
        'Terça-feira', 
        'Quarta-feira',
        'Quinta-feira',
        'Sexta-feira',
        'Sábado',
      ];

      return view('companies.create', compact('states', 'cities', 'days', 'fields_activity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
      DB::beginTransaction();
      
      // dd($request->input());
      try {
        /** Dados da Empresa */
        $company = new Company;

        $company->trade_name = $request->input('company.trade_name');
        $company->company_name = $request->input('company.company_name');
        $company->cnpj = $request->input('company.cnpj');
        $company->description = $request->input('company.description');
        $company->user_id = $request->input('company.user_id');
               
        $company->save();

        $company->fieldsActivities()->attach($request->input('company.activities'));
        
        /** Localização da Empresa */
        $address = new Address;
        
        $address->cep = $request->input('localization.cep');
        $address->address = $request->input('localization.address');
        $address->house_number = $request->input('localization.house_number');
        $address->district = $request->input('localization.district');
        $address->address_complement = $request->input('localization.address_complement');
        $address->city_id = $request->input('localization.city_id');
        $address->company_id = $company->id;
        
        $address->save();

        /** Contatos */
        foreach($request->input('contacts') as $phone_number)
        {
          Contact::create([
            'phone_number' => $phone_number,
            'company_id' => $company->id,
          ]);
        }

        /** Horário de Funcionamento */
        $hasBreakTime = $request->input('hours.has_break_time');
        $rangeHour = $request->input('hours.range_hour');
        
        if ($hasBreakTime === "on") {
          $startBreak = date("H:i:s", strtotime($request->input('hours.start_break')));
          $endBreak = date("H:i:s", strtotime($request->input('hours.end_break')));
        }
        
        foreach ($request->input('day_hours') as $weekday => $day_hours) 
        {
          if (!isset($day_hours['is_closed'])) {
            $workingHour = new WorkingHour;
            
            $workingHour->week_day = $weekday;
            $workingHour->range_hour = $rangeHour;
            $workingHour->start_hour = date("H:i:s", strtotime($day_hours['start_hour']));
            $workingHour->end_hour = date("H:i:s", strtotime($day_hours['end_hour']));

            if ($hasBreakTime === "on") {
              $workingHour->start_break = $startBreak;
              $workingHour->end_break = $endBreak;
            }
            
            $workingHour->company_id = $company->id;
            $workingHour->save();
          }
        }

        if ($request->hasFile('logo') && $request->logo->isValid()) {          
          $logoUrl = $request->logo->store('companies');
          
          $company->logo_url = $logoUrl;
          $company->save();
        }
        
        $user = User::find($request->input('company.user_id'));

        if(!$user->hasRole('Owner')) {
          $user->roles()->sync([2, 3, 4, 5, 6]);
        }

        DB::commit();

      } catch (Exception $exception) {
        DB::rollback();

        $error = [
          'msg_title' => 'Erro no servidor',
          'msg_error' => 'Erro ao cadastrar empresa.'
        ];
        return redirect()->back()->with($error)->withInput();
      }

      $success = [
        'msg_title' => 'Empresa cadastrada!',
        'msg_success' => 'Empresa cadastrada com sucesso'
      ];

      return redirect()->back()->with($success);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);

        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $company = Company::findOrFail($id);

      $workingHour = array(7);
      for ($i = 0; $i < 7; $i++)
      {
        for ($j = 0; $j < count($company->workingHours); $j++)
        {
          if ($company->workingHours[$j]->week_day == $i)
          {
            $workingHour[$i] = $company->workingHours[$j];
            break;
          } else {
            $workingHour[$i] = null;
          }
        }
      }
      
      $fields_activity = FieldActivity::all();
      $states = State::orderBy('state')->get();
      $cities = City::orderBy('city')->get();
      $contacts = Contact::where('company_id', $id)->get();

      $days = [
        'Domingo', 
        'Segunda-feira', 
        'Terça-feira', 
        'Quarta-feira',
        'Quinta-feira',
        'Sexta-feira',
        'Sábado',
      ];

      return view('companies.edit', compact('company', 'fields_activity', 'states', 'cities', 'contacts', 'workingHour','days'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    // public function update(Request $request, $id)
    {
        $company = Company::find($id);

        if (isset($company)) {
          DB::beginTransaction();

          try {
            /** Dados da Empresa */
            $company->trade_name = $request->input('company.trade_name');
            $company->company_name = $request->input('company.company_name');
            $company->cnpj = $request->input('company.cnpj');
            $company->description = $request->input('company.description');
                
            $company->save();

            $company->fieldsActivities()->sync($request->input('company.activities'));
            
            /** Localização */
            $company->address->cep = $request->input('localization.cep');
            $company->address->address = $request->input('localization.address');
            $company->address->house_number = $request->input('localization.house_number');
            $company->address->district = $request->input('localization.district');
            $company->address->address_complement = $request->input('localization.address_complement');
            $company->address->city_id = $request->input('localization.city_id');
            
            $company->address->save();

            /** Contatos */
            $dbContactsIds = $company->contacts->pluck('id')->toArray();
            $inputsContactsIds = array_column($request->input('contacts'), 'id');
            
            $contactsIdsToDelete = array_diff($dbContactsIds, $inputsContactsIds);

            if (!empty($contactsIdsToDelete)) {
              Contact::destroy($contactsIdsToDelete);
            }
            
            foreach($request->input('contacts') as $phone)
            {
              if(isset($phone['id'])) {
                $contact = Contact::find($phone['id']);
                $contact->phone_number = $phone['phone_number'];
                $contact->save();
              } else {
                Contact::create([
                  'phone_number' => $phone['phone_number'],
                  'company_id' => $company->id,
                ]);
              }
            }

            /** Horário de Funcionamento */
            $hasBreakTime = $request->input('hours.has_break_time');
            $rangeHour = $request->input('hours.range_hour');
            
            if ($hasBreakTime === "on") {
              $startBreak = date("H:i:s", strtotime($request->input('hours.start_break')));
              $endBreak = date("H:i:s", strtotime($request->input('hours.end_break')));
            }
            
            foreach ($request->input('day_hours') as $weekday => $day_hours) 
            {
              if (!isset($day_hours['is_closed'])) {
                $wh = WorkingHour::updateOrInsert(
                    ['company_id' => $company->id, 'week_day' => $weekday],
                    [
                      'range_hour' => $rangeHour,
                      'start_hour' => date("H:i:s", strtotime($day_hours['start_hour'])),
                      'end_hour' => date("H:i:s", strtotime($day_hours['end_hour'])),
                      'created_at' => \Carbon\Carbon::now(),
                      'updated_at' => \Carbon\Carbon::now()
                    ]
                  );
                
                if ($hasBreakTime === "on") {
                  WorkingHour::updateOrInsert(
                    ['company_id' => $company->id, 'week_day' => $weekday],
                    [
                      'start_break' => $startBreak,
                      'end_break' => $endBreak,
                      'created_at' => \Carbon\Carbon::now(),
                      'updated_at' => \Carbon\Carbon::now()
                    ]
                  );
                } else {
                  $company->workingHours()->update(['start_break' => null, 'end_break' => null]);
                }
              } else {
                $company->workingHours()->where('week_day', $weekday)->delete();
              }
              
            }

            if ($request->hasFile('logo') && $request->logo->isValid()) {
                  
              if ($company->logo_url && Storage::exists($company->logo_url)) {
                Storage::delete($company->logo_url);                    
              }
              
              $logoUrl = $request->logo->store('companies');
              
              $company->logo_url = $logoUrl;
              $company->save();
            }

            DB::commit();

          } catch (Exception $ex) {
            DB::rollback();

            $error = [
              'msg_title' => 'Falha na Edição!',
              'msg_error' => 'Falha ao registrar valores'
            ];

            return redirect()->back()->with($error)->withInput();
          }
          
          $success = [
            'msg_title' => 'Sucesso na alteração!',
            'msg_success' => 'Dados da empresa alterados com sucesso!'
          ];

          return redirect()->route('company.show', $id)->with($success);

        } else {
          $error = [
            'msg_title' => 'Falha na Edição!',
            'msg_error' => 'Empresa não encontrada'
          ];

          return redirect()->back()->with($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->inactive = 1;
        $company->delete();

        $success = [
          'msg_title' => 'Sucesso ao excluir',
          'msg_success' => 'Empresa apagado com sucesso!'
        ];

        return back()->with($success);
    }

    public function inactivate($id)
    {
      $company = Company::find($id);
      $company->inactive = 1;
      $company->save();

      $success = [
        'msg_title' => 'Sucesso ao inativar',
        'msg_success' => 'Empresa inativada com sucesso!'
      ];

      return back()->with($success);
    }
}
