@extends('layouts.app')

@section('title', 'Cadastro de Empresas')

@section('css')
  <link href="{{ asset('css/validation-styles.css')}}" rel="stylesheet" />
@endsection

@section('main')
  <main>
    <div class="container-fluid">
      <h1 class="mt-4">Edição de empresa</h1>
      <ol class="breadcrumb mb-1">
        <li class="breadcrumb-item active">Empresas/Edição</li>
      </ol>
      <div class="card-body">
        <form id="companyForm" action="{{ route('company.update', $company->id) }}" method="POST">
          @method('PUT')

          @csrf

          <div class="form-row my-2">
            <div class="col-md-12">
              <span class="advise"> Campos obrigatórios</span><sup>*</sup>
            </div>
          </div>

          <h3 class="mb-4">Sobre a empresa</h3>

          <div class="form-row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="inputCompanyName">Razão social<sup>*</sup></label>
                <input class="form-control" id="inputCompanyName" type="text" name="company[company_name]" value="{{ old('company.company_name') ?? $company->company_name }}" />
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputCnpj">CNPJ<sup>*</sup></label>
                <input class="form-control cnpj" id="inputCnpj" type="text" name="company[cnpj]" value="{{ old('company.cnpj') ?? $company->cnpj }}" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputTradeName">Nome fantasia<sup>*</sup></label>
                <input class="form-control" id="inputTradeName" type="text" name="company[trade_name]" value="{{ old('company.trade_name') ?? $company->trade_name }}" />
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="descriptionArea">Descrição da empresa</label>
                <textarea class="form-control" name="company[description]" id="descriptionArea" rows="4">{{ old('company.description') ?? $company->description }}</textarea>
              </div>
            </div>
          </div>

          <hr>

          <h3 class="my-4">Localização</h3>

          <div class="form-row">
            <div class="col-md-2">
              <div class="form-group">
                <label for="inputCep">CEP<sup>*</sup></label>
                <input class="form-control cep" id="inputCep" type="text" name="localization[cep]" value="{{ old('localization.cep') ?? $company->address->cep }}" />
              </div>
            </div>
            <div class="col-md-9">
              <div class="form-group">
                <label for="inputAddress">Logradouro<sup>*</sup></label>
                <input class="form-control" id="inputAddress" type="text" name="localization[address]" value="{{ old('localization.address') ?? $company->address->address }}" />
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <label for="inputNumber">Nº<sup>*</sup></label>
                <input class="form-control" id="inputNumber" type="text" name="localization[house_number]" value="{{ old('localization.house_number') ?? $company->address->house_number }}" />
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-7">
              <div class="form-group">
                <label for="inputDistrict">Bairro<sup>*</sup></label>
                <input class="form-control" id="inputDistrict" type="text" name="localization[district]" value="{{ old('localization.district') ?? $company->address->district }}" />
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="inputComplement">Complemento</label>
                <input class="form-control" id="inputComplement" type="text" name="localization[address_complement]" value="{{ old('localization.address_complement') ?? $company->address->address_complement }}" />
              </div>
            </div>
          </div>
          
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="inputState">Estado<sup>*</sup></label>
                <select class="form-control" id="inputState" name="localization[uf]">
                  <option disabled selected value="">Selecione o estado...</option>
                  @foreach($states as $state)
                    <option 
                      value="{{$state->uf}}"
                      @if(old('localization.uf'))
                        {{ old('localization.uf') == $state->uf ? 'selected' : '' }}
                      @else
                        {{ $company->address->city->state->uf === $state->uf ? 'selected' : '' }}
                      @endif
                    >{{$state->state}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label for="inputCity">Cidade<sup>*</sup></label>
                <select class="form-control" id="inputCity" name="localization[city_id]">
                  <option disabled selected value="">Selecione a cidade...</option>
                  @foreach($cities as $city)
                    <option 
                      value="{{$city->id}}"
                      @if(old('localization.city_id'))
                        {{ old('localization.city_id') == $city->id ? 'selected' : '' }}
                      @else
                        {{ $company->address->city->id === $city->id ? 'selected' : '' }}
                      @endif
                    >{{$city->city}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-12 d-flex justify-content-center">
              <div class="form-group mt-4 mb-0">
                <button type="submit" class="btn btn-primary">Atualizar dados da empresa</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>				
  </main>
@endsection

@section('js')
  <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('plugins/jquery-mask/jquery.mask.min.js') }}"></script>
  
	<script src="{{ asset('js/company-validation.js') }}"></script>
	<script src="{{ asset('js/validation-messages.js') }}"></script>
	<script src="{{ asset('js/mask-format.js') }}"></script>
	<script src="{{ asset('js/address.js') }}"></script>

@endsection