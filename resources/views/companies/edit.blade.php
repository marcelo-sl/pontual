@extends('layouts.app')

@section('title', 'Cadastro de Empresas')

@section('css')
  <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/company-styles.css') }}" rel="stylesheet" />
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
        <form id="companyForm" action="{{ route('company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
          @method('PUT')

          @csrf

          <div class="form-row my-2">
            <div class="col-md-12">
              <span class="advise"> Campos obrigatórios</span><sup>*</sup>
            </div>
          </div>

          <h3 class="mb-4">Sobre a empresa</h3>

          <div class="form-group">
            <label class="small mb-1" for="inputEmail">Logotipo da empresa</label>
            <br>
            <input type="file" class="form-control-file" id="logo" name="logo" accept="image/png, image/jpeg">
          </div>

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

          <div class="row d-flex justify-center">
            <div class="col-12">
              <div class="form-group">
                <label for="inputFieldActivity">Ramo(s) de atividade(s)<sup>*</sup></label>
                <br>
                <select class="form-control select-multiple" id="inputFieldActivity" name="company[activities][]" multiple="multiple">
                  @foreach($fields_activity as $activity)
                    <option value="{{$activity->id}}" 
                        @if (old('company.activities')) 
                            
                            @foreach (old('company.activities') as $item) 
                                {{ ($item == $activity->id) ? 'selected' : '' }}    
                            @endforeach
                        
                        @else        
                        
                            @foreach ($company->fieldsActivities as $item) 
                                {{ ($item->field === $activity->field) ? 'selected' : '' }}
                            @endforeach

                        @endif
                    >{{ $activity->field }}</option>
                  @endforeach
                </select>
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

          <hr>

          <h3 class="my-4">Contatos</h3>
          
          <div id="contacts">

            <div id="contacts-place">
              @forelse($contacts as $i => $contact)
                <div class="row contact-row">
                  <div class="col-4">
                    <div class="form-inline d-flex justify-content-between week-days my-1">
                      <label>Telefone</label>
                      <div>
                        <input type="hidden" name="contacts[{{$i}}][id]" value="{{$contact->id}}">
                        <input type="text" name="contacts[{{$i}}][phone_number]" class="form-control sp_celphones" value="{{$contact->phone_number}}">
                        <a class="btn btn-danger ml-2 removePhone"><i class="fas fa-trash"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              @empty
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
              @endforelse
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

          <h3 class="my-4">Horário de Funcionamento</h3>

          @for ($i = 0; $i < 7; $i++)
            <div class="form-inline d-flex justify-content-around week-days my-1">
              <div class="col-2 d-flex justify-center">
                <b>{{ $days[$i] }}</b>
              </div>

              <div class="form-check">
                <label class="form-check-label mr-1">
                  Fechado:
                </label>
                <input class="form-check-input isClosed" type="checkbox" name="day_hours[{{$i}}][is_closed]" id="isClosed" 
                    @if(old('day_hours.'.$i.'.is_closed'))
                        {{ old('day_hours.'.$i.'.is_closed') == 'on' ? 'checked' : ''  }}
                    @else
                      @if($workingHour[$i] != null && $workingHour[$i]->week_day == $i)
                        {{ '' }}
                      @else
                        {{ 'checked' }}
                      @endif
                        
                    @endif 
                >
              </div>

              <div class="form-group working-hour hour-day-{{$i}}">
                <label class="my-1 mr-2" for="startHour">Entrada:<sup>*</sup></label>
                <input type="time" name="day_hours[{{$i}}][start_hour]" class="form-control workHour" id="startHour" 
                   @if(old('day_hours.'.$i.'.start_hour'))
                      value={{ old('day_hours.'.$i.'.start_hour') }}
                   @else 
                      
                    value={{$workingHour[$i] != null ? $workingHour[$i]->start_hour : ''}}
                      
                   @endif 
                >
              </div>
              <div class="form-group working-hour hour-day-{{$i}}">
                <label class="my-1 mr-2" for="endHour">Saída:<sup>*</sup></label>
                <input type="time" name="day_hours[{{$i}}][end_hour]" class="form-control workHour" id="endHour" 
                  @if(old('day_hours.'.$i.'.end_hour'))
                    value={{ old('day_hours.'.$i.'.end_hour') }}
                  @else
                  value={{$workingHour[$i] != null ? $workingHour[$i]->end_hour : ''}}
                  @endif
                >
              </div>
              
            </div>
          @endfor

          <div class="row mt-3">
            <div class="col-6">
              <div class="form-group">
                <label class="my-1 mr-2" for="rangeHour">
                  Duração dos atendimentos (em minutos):<sup>*</sup> 
                </label>
                <input type="number" name="hours[range_hour]" class="form-control col-3" min="15" max="120" id="rangeHour" value="{{ old('hours.range_hour') ?? $company->workingHours[0]->range_hour }}">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-check">
                <input class="form-check-input" name="hours[has_break_time]" id="hasBreakTime" type="checkbox"
                  @if($company->workingHours[0]->start_break != null)
                    {{'checked'}}
                  @else
                    {{''}}
                  @endif
                >
                <label class="form-check-label mr-1" for="hasBreakTime" value="{{ old('hours.has_break_time') }}">
                  Possui parada de almoço
                </label>
              </div>

              <div class="form-row break-time-content">
                <div class="col-2">
                  <label class="my-1 mr-2" for="startBreak">Início</label>
                  <input type="time" name="hours[start_break]" class="form-control my-1 mr-sm-2" id="startBreak" value="{{ old('hours.start_break') ?? $company->workingHours[0]->start_break }}">
                </div>

                <div class="col-2">                
                  <label class="my-1 mr-2" for="endBreak">Fim</label>
                  <input type="time" name="hours[end_break]" class="form-control my-1 mr-sm-2" id="endBreak" value="{{ old('hours.end_break') ?? $company->workingHours[0]->end_break }}">
                </div>
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
  <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
  <script src="{{ asset('plugins/jquery-mask/jquery.mask.min.js') }}"></script>
  
  <script src="{{ asset('js/select2.js') }}"></script>
	<script src="{{ asset('js/validate-methods.js') }}"></script>
	<script src="{{ asset('js/company-validation.js') }}"></script>
	<script src="{{ asset('js/validation-messages.js') }}"></script>
	<script src="{{ asset('js/mask-format.js') }}"></script>
	<script src="{{ asset('js/address.js') }}"></script>
	<script src="{{ asset('js/multiple-contacts.js') }}"></script>
	<script src="{{ asset('js/company.js') }}"></script>

@endsection