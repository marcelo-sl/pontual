@extends('layouts.app')

@section('title', 'Cadastro de Empresas')

@section('css')
  <link href="{{ asset('css/company-styles.css')}}" rel="stylesheet" />
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

          <div class="form-row my-2">
            <div class="col-md-12">
              <span class="advise"> Campos obrigatórios</span><sup>*</sup>
            </div>
          </div>

          <input type="hidden" name="company[user_id]" value="{{ Auth::user()->id }}" />

          <h3 class="mb-4">Sobre a empresa</h3>

          <div class="form-row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="inputCompanyName">Razão social<sup>*</sup></label>
                <input class="form-control" id="inputCompanyName" type="text" name="company[company_name]" value="{{ old('company.company_name') }}" />
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputCnpj">CNPJ<sup>*</sup></label>
                <input class="form-control cnpj" id="inputCnpj" type="text" name="company[cnpj]" value="{{ old('company.cnpj') }}" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputTradeName">Nome fantasia<sup>*</sup></label>
                <input class="form-control" id="inputTradeName" type="text" name="company[trade_name]" value="{{ old('company.trade_name') }}" />
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="descriptionArea">Descrição da empresa</label>
                <textarea class="form-control" name="company[description]" id="descriptionArea" rows="4">{{ old('company.description') }}</textarea>
              </div>
            </div>
          </div>
          
          <hr>

          <h3 class="my-4">Contatos</h3>
          
          <div id="contacts">

            <div id="contacts-place">
              <div class="row contact-row">
                <div class="col-4">
                  <div class="form-inline d-flex justify-content-between week-days my-1">
                    <label>Telefone</label>
                    <div>
                      <input type="text" name="contacts[]" class="form-control sp_celphones">
                      <a class="btn btn-danger ml-2 removePhone"><i class="fas fa-trash"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row mt-2" id="addContactDiv">
              <div class="col-4 d-flex justify-content-center">
                <a class="btn btn-success" id="addPhone">
                  <i class="fas fa-plus"></i>
                  Adicionar contato
                </a>
              </div>
            </div>
          </div>

          <hr>

          <h3 class="my-4">Localização</h3>

          <div class="form-row">
            <div class="col-md-2">
              <div class="form-group">
                <label for="inputCep">CEP<sup>*</sup></label>
                <input class="form-control cep" id="inputCep" type="text" name="localization[cep]" value="{{ old('localization.cep') }}" />
              </div>
            </div>
            <div class="col-md-9">
              <div class="form-group">
                <label for="inputAddress">Logradouro<sup>*</sup></label>
                <input class="form-control" id="inputAddress" type="text" name="localization[address]" value="{{ old('localization.address') }}" />
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <label for="inputNumber">Nº<sup>*</sup></label>
                <input class="form-control" id="inputNumber" type="text" name="localization[house_number]" value="{{ old('localization.house_number') }}" />
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-7">
              <div class="form-group">
                <label for="inputDistrict">Bairro<sup>*</sup></label>
                <input class="form-control" id="inputDistrict" type="text" name="localization[district]" value="{{ old('localization.district') }}" />
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="inputComplement">Complemento</label>
                <input class="form-control" id="inputComplement" type="text" name="localization[address_complement]" value="{{ old('localization.address_complement') }}" />
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
                    <option value="{{$state->uf}}" {{ old('localization.uf') == $state->uf ? 'selected' : '' }}>{{$state->state}}</option>
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
                    <option value="{{$city->id}}" {{ old('localization.city_id') == $city->id ? 'selected' : '' }}>{{$city->city}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <hr>

          <h3 class="my-4">Horário de Funcionamento</h3>

          @for ($i = 0; $i < 7; $i++)
            <div class="form-inline d-flex justify-content-around week-days my-1">
              <div class="col-2 d-flex justify-center">
                <b>{{ $days[$i] }}</b>
              </div>

              <div class="form-check">
                <label class="form-check-label mr-1" for="isClosed">
                  Fechado:
                </label>
                <input class="form-check-input" type="checkbox" name="day_hours[{{$i}}][is_closed]" id="isClosed">
              </div>

              <div class="form-group working-hour hour-day-{{$i}}">
                <label class="my-1 mr-2" for="startHour">Entrada:</label>
                <input type="time" name="day_hours[{{$i}}][start_hour]" class="form-control workHour" id="startHour">
              </div>
              <div class="form-group working-hour hour-day-{{$i}}">
                <label class="my-1 mr-2" for="endHour">Saída:</label>
                <input type="time" name="day_hours[{{$i}}][end_hour]" class="form-control workHour" id="endHour" >
              </div>
              
            </div>
          @endfor

          <div class="row mt-3">
            <div class="col-6">
              <div class="form-group">
                <label class="my-1 mr-2" for="rangeHour">
                  Tempo entre atendimentos (em minutos): 
                </label>
                <input type="number" name="hours[range_hour]" class="form-control col-3" min="15" max="120" id="rangeHour" value="{{ old('hours.range_hour') }}">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-check">
                <input class="form-check-input" name="hours[has_break_time]" id="hasBreakTime" type="checkbox">
                <label class="form-check-label mr-1" for="hasBreakTime" value="{{ old('hours.has_break_time') }}">
                  Possui parada de almoço
                </label>
              </div>

              <div class="form-row break-time-content">
                <div class="col-2">
                  <label class="my-1 mr-2" for="startBreak">Início</label>
                  <input type="time" name="hours[start_break]" class="form-control my-1 mr-sm-2" id="startBreak" value="{{ old('hours.start_break') }}">
                </div>

                <div class="col-2">                
                  <label class="my-1 mr-2" for="endBreak">Fim</label>
                  <input type="time" name="hours[end_break]" class="form-control my-1 mr-sm-2" id="endBreak" value="{{ old('hours.end_break') }}">
                </div>
              </div>
            </div>
          </div>
          
          <div class="form-group mt-4 mb-0 d-flex justify-center">
            <button type="submit" class="btn btn-primary">Cadastrar empresa</button>
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
	<script src="{{ asset('js/company.js') }}"></script>
	<script src="{{ asset('js/multiple-contacts.js') }}"></script>

@endsection