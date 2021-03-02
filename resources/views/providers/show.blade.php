@extends('layouts.app')
@section('title', "Provider Name")

@section('css')
  <link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" />
  <link href="{{ asset('css/company-styles.css')}}" rel="stylesheet" />
@endsection

@section('main')

<main>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card shadow-lg border-0 rounded mt-5 d-flex flex-row p-4">
          <div id="logo-provider" class="col-3">
            <img 
              src="{{ $provider->user->avatar_url }}"
              class="border border-secondary rounded"
              alt="Prestador de Serviços Logo"
              width="200"
              height="200"
            >
          </div>
          <div id="main-provider" class="col-8 ml-4">
            <h2>{{ $provider->nickname }}</h2>
            <hr>
            <h6>Avaliações</h6>
            <p>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
              4.5/5
            </p>
            <h6>Descrição</h6>
            <p class="text-justify">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card shadow-lg border-0 rounded mt-2 d-flex flex-row p-4">
          <div id="localization-provider" class="col-11 ml-4">
            <h4>Agende seu horário</h4>
            <hr>
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="font-weight-bold">Selecione a data</label>
                  <!-- <input type='text' class="form-control" id='datepicker' style='width: 300px;' > -->
                  <div id="datepicker"></div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center mt-2">

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
          <div id="localization-provider" class="col-11 ml-4">
            <h4>Informações</h4>
            <hr>
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="font-weight-bold">Endereço</label>
                  <p class="text-justify">
                    {{ $provider->address->address }}, 
                    Nº {{$provider->address->house_number}}  
                    {{ $provider->address->address_complement ?? ''}} -  
                    {{$provider->address->district}} - 
                    {{$provider->address->city->city}}/{{$provider->address->city->state->uf}} - 
                    {{ $provider->address->cep }}
                  </p>
                </div>
              </div>
            </div>

            <div class="form-row mt-3">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="font-weight-bold">Nome Comercial</label>
                  <p>{{$provider->nickname}}</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="font-weight-bold">Cadastrado em</label>
                  <p>{{$provider->created_at->format('d/m/Y')}}</p>
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

@section('js')
  <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{ asset('plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js')}}"></script>

  <script src="{{ asset('js/datepicker.js')}}"></script>
@endsection