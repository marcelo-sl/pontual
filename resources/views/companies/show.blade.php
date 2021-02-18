@extends('layouts.app')
@section('title', "Company Name")

@section('css')
  <link href="{{ asset('css/company-styles.css')}}" rel="stylesheet" />
@endsection

@section('main')

<main>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card shadow-lg border-0 rounded mt-5 d-flex flex-row p-4">
          <div id="logo-company" class="col-3">
            <img 
              src="https://image.freepik.com/free-vector/generic-arrow-premium-logo-template_9569-147.jpg"
              class="border border-secondary rounded"
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

      <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://images.unsplash.com/photo-1585747860715-2ba37e788b70?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw=&ixlib=rb-1.2.1&auto=format&fit=crop&w=1953&q=80" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1598887142487-3c854d51eabb?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw=&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1596362601603-b74f6ef166e4?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw=&ixlib=rb-1.2.1&auto=format&fit=crop&w=926&q=80" class="d-block w-100" alt="...">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
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
                    Nº {{$company->address->house_number}}  
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