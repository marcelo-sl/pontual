@extends('layouts.app')

@section('title', 'Cadastro de Empresas')

@section('css')
  <link href="{{ asset('css/company-styles.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/validation-styles.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('main')
  <main>
    <div class="container-fluid">
      <h1 class="mt-4">Cadastro de prestadores de serviços</h1>
      <ol class="breadcrumb mb-1">
        <li class="breadcrumb-item active">Prestadores de serviços/Cadastro</li>
      </ol>
      <div class="card-body">
        <form id="providerForm" action="{{ route('provider.store') }}" method="POST">
          @csrf

          <div class="form-row my-2">
            <div class="col-md-12">
              <span class="advise"> Campos obrigatórios</span><sup>*</sup>
            </div>
          </div>

          <input type="hidden" name="provider[user_id]" value="{{ Auth::user()->id }}" />

          <h3 class="mb-4">Sobre o prestador</h3>

          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="inputNickname">Nome comercial<sup>*</sup></label>
                <br>
                <input 
                  type="text" 
                  name="provider[nickname]" 
                  value="{{old('provider.nickname')}}"
                  class="form-control" 
                  id="inputNickname" 
                  placeholder="Ex: Cabeleireira Leila, Barbearia do João..." 
                />
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="inputCpf">CPF<sup>*</sup></label>
                <br>
                <input 
                  type="text" 
                  name="provider[cpf]" 
                  value="{{old('provider.cpf')}}"
                  class="form-control cpf" 
                  id="inputCpf" 
                  placeholder="000.000.000-00" 
                />
              </div>
            </div>
          </div>

          <div class="row d-flex justify-center">
            <div class="col-12">
              <div class="form-group">
                <label for="inputFieldActivity">Ramo(s) de atividade(s)<sup>*</sup></label>
                <br>
                <select class="form-control select-multiple" id="inputFieldActivity" name="provider[activities][]" multiple="multiple">
                  @foreach($fields_activity as $activity)
                    <option value="{{$activity->id}}">{{ $activity->field }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>


          <div class="form-group mt-4 mb-0 d-flex justify-center">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
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

  <script src="{{ asset('js/provider-validation.js') }}"></script>
	<script src="{{ asset('js/validation-messages.js') }}"></script>
	<script src="{{ asset('js/validate-methods.js') }}"></script>
  <script src="{{ asset('js/mask-format.js') }}"></script>
  <script src="{{ asset('js/select2.js') }}"></script>
  <script src="{{ asset('js/company.js') }}"></script>
@endsection