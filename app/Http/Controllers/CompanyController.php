<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;

use App\Company;
use App\Address;
use App\State;
use App\City;
use App\User;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::orderBy('state')->get();
        $cities = City::orderBy('city')->get();

        return view('companies.create', compact('states', 'cities'));
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

      try {
        /** Dados da Empresa */
        $company = new Company;

        $company->trade_name = $request->input('company.trade_name');
        $company->company_name = $request->input('company.company_name');
        $company->cnpj = $request->input('company.cnpj');
        $company->description = $request->input('company.description');
        $company->user_id = $request->input('company.user_id');
               
        $company->save();
        
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
        
        $user = User::find($request->input('company.user_id'));
        
        $user->roles()->sync([2, 3, 4, 5, 6]);

        DB::commit();

      } catch (\Exception $exception) {
        DB::rollback();

        connectify('error', 'Erro no servidor', 'Erro ao cadastrar empresa.');

        return redirect()->back()->withInput();
      }

      notify()->success('Empresa cadastrada com sucesso!');

      return redirect()->back();


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
        $states = State::orderBy('state')->get();
        $cities = City::orderBy('city')->get();

        return view('companies.edit', compact('company', 'states', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $company = Company::find($id);

        if (isset($company)) {
            DB::beginTransaction();

            try {
                $company->trade_name = $request->input('company.trade_name');
                $company->company_name = $request->input('company.company_name');
                $company->cnpj = $request->input('company.cnpj');
                $company->description = $request->input('company.description');
                    
                $company->save();

                $company->address->cep = $request->input('localization.cep');
                $company->address->address = $request->input('localization.address');
                $company->address->house_number = $request->input('localization.house_number');
                $company->address->district = $request->input('localization.district');
                $company->address->address_complement = $request->input('localization.address_complement');
                $company->address->city_id = $request->input('localization.city_id');
                
                $company->address->save();

                DB::commit();

            } catch (Exception $ex) {
                DB::rollback();

                connectify('error', 'Falha na Edição!', 'Falha ao registrar valores');

                return redirect()->back()->withInput();
            }
            
            notify()->success('Dados da empresa alterados com sucesso!');

            return redirect()->route('company.show', $id);

        } else {
            connectify('error', 'Falha na Edição!', 'Empresa não encontrada');

            return redirect()->back();
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
        //
    }
}
