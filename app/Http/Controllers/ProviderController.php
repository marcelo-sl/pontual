<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProviderRequest;

use DB;

use App\Provider;
use App\User;
use App\FieldActivity;
use App\WorkingHour;
use App\Address;
use App\State;
use App\City;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        return view('providers.create', compact('fields_activity', 'states', 'cities', 'days'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderRequest $request)
    {
        DB::beginTransaction();

        try {
          $provider = new Provider;
          
          $provider->cpf = $request->input('provider.cpf');
          $provider->nickname = $request->input('provider.nickname');
          $provider->user_id = $request->input('provider.user_id');
          
          $provider->save();
          
          $provider->fieldsActivities()->attach($request->input('provider.activities'));
          
          /** Localização do comércio */
          $address = new Address;
          
          $address->cep = $request->input('localization.cep');
          $address->address = $request->input('localization.address');
          $address->house_number = $request->input('localization.house_number');
          $address->district = $request->input('localization.district');
          $address->address_complement = $request->input('localization.address_complement');
          $address->city_id = $request->input('localization.city_id');
          $address->provider_id = $provider->id;
          
          $address->save();

          /** Horário de Funcionamento */
          $hasBreakTime = $request->input('hours.has_break_time');
          $rangeHour = sprintf('%02d:%02d:00', floor($request->input('hours.range_hour') / 60), ($request->input('hours.range_hour') % 60));
          
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
              
              $workingHour->provider_id = $provider->id;
              $workingHour->save();
            }
          }
          
          $user = User::find($request->input('provider.user_id'));

          if(!$user->hasRole('Employee')) {
            $user->roles()->sync([2, 3, 4, 5, 6]);
          }

          DB::commit();
        } catch (Exception $exception) {
            DB::rollback();

            $error = [
                'msg_title' => 'Erro no servidor',
                'msg_error' => 'Erro ao cadastrar prestador de serviço.'
            ];

            return redirect()->back()->with($error)->withInput();
        }

        $success = [
            'msg_title' => 'Sucesso ao cadastrar',
            'msg_success' => 'Prestador de serviço cadastrado com sucesso!'
        ];

        return redirect()->route('provider.create')->with($success);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
