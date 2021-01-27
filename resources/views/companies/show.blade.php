@extends('layouts.app')
@section('title', "Company Name")

@section('main')

<main>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card shadow-lg border-0 rounded mt-5 d-flex flex-row p-4">
          <div id="logo-company" class="col-3">
            <img 
              src="https://image.freepik.com/free-vector/generic-arrow-premium-logo-template_9569-147.jpg"
              class="border border-primary rounded"
              alt="Company Logo"
              width="200"
              height="200"
            >
          </div>
          <div id="main-company" class="col-8 ml-4">
            <h2>{{ $company->trade_name }}</h2>
            <hr>
            <h6>Descrição</h6>
            <p class="text-justify">
              {{ $company->description }}
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card shadow-lg border-0 rounded mt-4 d-flex flex-row p-4">
          <div id="localization-company" class="col-11 ml-4">
            <h4>Informações</h4>
            <hr>
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="font-weight-bold">Endereço</label>
                  <p class="text-justify">
                    {{ $company->address->address }}, 
                    Nº {{$company->address->house_number}} - 
                    {{ $company->address->address_complement ?? ''}} -  
                    {{$company->address->district}} - 
                    {{$company->address->city->city}}/{{$company->address->city->state->uf}} - 
                    {{ $company->address->cep }}
                  </p>
                </div>
              </div>
            </div>

            <div class="form-row mt-3">
              <div class="col-md-3">
                <div class="form-group">
                  <label class="font-weight-bold">CNPJ</label>
                  <p>{{$company->cnpj}}</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="font-weight-bold">Razão Social</label>
                  <p>{{$company->company_name}}</p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="font-weight-bold">Cadastrada em</label>
                  <p>{{$company->created_at->format('d/m/Y')}}</p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection