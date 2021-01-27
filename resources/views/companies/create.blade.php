@extends('layouts.app')

@section('title', 'Cadastro de Empresas')

@section('css')
  <link href="{{ asset('css/validation-styles.css')}}" rel="stylesheet" />
@endsection

@section('main')
  <main>
    <div class="container-fluid">
      <h1 class="mt-4">Cadastro de empresa</h1>
      <ol class="breadcrumb mb-1">
        <li class="breadcrumb-item active">Empresas/Cadastro</li>
      </ol>
      <div class="card-body">
        <form id="companyForm" action="{{ route('company.store') }}" method="POST">
          
          @csrf

          <input type="hidden" name="company[user_id]" value="{{ Auth::user()->id }}" />

          <h3 class="mb-4">Sobre a empresa</h3>

          <div class="form-row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="inputCompanyName">Razão social</label>
                <input class="form-control" id="inputCompanyName" type="text" name="company[company_name]" />
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputCnpj">CNPJ</label>
                <input class="form-control" id="inputCnpj" type="text" name="company[cnpj]" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputTradeName">Nome fantasia</label>
                <input class="form-control" id="inputTradeName" type="text" name="company[trade_name]" />
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="descriptionArea">Descrição da empresa</label>
                <textarea class="form-control" name="company[description]" id="descriptionArea" rows="4"></textarea>
              </div>
            </div>
          </div>

          <hr>

          <h3 class="my-4">Localização</h3>

          <div class="form-row">
            <div class="col-md-2">
              <div class="form-group">
                <label for="inputCep">CEP</label>
                <input class="form-control" id="inputCep" type="text" name="localization[cep]" />
              </div>
            </div>
            <div class="col-md-9">
              <div class="form-group">
                <label for="inputAddress">Logradouro</label>
                <input class="form-control" id="inputAddress" type="text" name="localization[address]" />
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <label for="inputNumber">Nº</label>
                <input class="form-control" id="inputNumber" type="text" name="localization[house_number]" />
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-7">
              <div class="form-group">
                <label for="inputDistrict">Bairro</label>
                <input class="form-control" id="inputDistrict" type="text" name="localization[district]" />
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="inputComplement">Complemento</label>
                <input class="form-control" id="inputComplement" type="text" name="localization[address_complement]" />
              </div>
            </div>
          </div>
          
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="inputState">Estado</label>
                <select class="form-control" id="inputState" name="localization[state_id]">
                  <option disabled selected value="">Selecione o estado...</option>
                  @foreach($states as $state)
                    <option value="{{$state->uf}}">{{$state->state}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label for="inputCity">Cidade</label>
                <select class="form-control" id="inputCity" name="localization[city_id]">
                  <option disabled selected value="">Selecione a cidade...</option>
                  @foreach($cities as $city)
                    <option value="{{$city->id}}">{{$city->city}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          
          <div class="form-group mt-4 mb-0"><button type="submit" class="btn btn-primary">Cadastrar empresa</button></div>
        </form>
      </div>
    </div>				
  </main>
@endsection

@section('js')

	<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('js/company-validation.js') }}"></script>
	<script src="{{ asset('js/validation-messages.js') }}"></script>

@endsection