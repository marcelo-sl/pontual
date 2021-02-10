<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProviderRequest;

use DB;

use App\Provider;
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
