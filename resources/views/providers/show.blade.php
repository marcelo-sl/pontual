@extends('layouts.app')
@section('title', $provider->nickname)

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
              src="{{ url('storage/'.$provider->user->avatar_url) }}" alt="{{ $provider->nickname }}"
              class="border border-secondary rounded"
              alt="Prestador de Serviços Logo"
              width="200"
              height="200"
            >

            <h6 class="mt-4"><i class="fas fa-phone-square"></i> Contatos</h6>
            <ul>
              @forelse($provider->user->contacts as $contact)
                <li>{{ $contact->phone_number }}</li>
              @empty
                <li>Não possui contatos</li>
              @endforelse
            </ul>
            

          </div>
          <div id="main-provider" class="col-8 ml-4">
            <h2>{{ $provider->nickname }}</h2>
            <hr>
            <h6>Avaliações</h6>
            <p>
              <i class="fas fa-star"></i>
              4.5/5
            </p>
            <h6>Descrição</h6>
            <p class="text-justify">
              {{ $provider->description }}
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card shadow-lg border-0 rounded mt-2 p-4">
          <h4>Agende seu horário</h4>
          <hr>

          <div class="d-flex flex-row">
            <div id="calendar-provider" class="col-lg-4">
              
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

            <div id="hours-provider" class="col-lg-8">
              <label class="font-weight-bold">Selecione o horário</label>
              <br>
              <div id="working-hours-group" class="btn-group-toggle row" data-toggle="buttons">
                <!-- <label class="btn btn-outline-secondary disabled col-md-2 m-1" disabled>
                  <input type="radio" name="options" id="option2">08:00
                </label>
                <label class="btn btn-outline-primary col-md-2 m-1 active">
                  <input type="radio" name="options" id="option1">09:00
                </label>
                <label class="btn btn-outline-primary col-md-2 m-1">
                  <input type="radio" name="options" id="option3">10:00
                </label> -->
              </div>
            </div>
          </div>

          <form 
            method="POST" 
            action="{{ route('schedule.store') }}" 
            id="schedule"
            class="d-flex justify-content-center mt-3"
          >
            @csrf
            
            <input type="hidden" name="provider_id" value="{{$provider->id}}">
            <input type="hidden" name="customer_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="schedule_date" id="schedule-date" value="">
            <input type="hidden" name="schedule_hour" id="schedule-hour" value="">

            <button type="submit" class="btn btn-success" id="schedule-submit" disabled>
              <i class="fas fa-calendar-check"></i> 
              <b> Realizar agendamento</b>
            </button>
          </form>
        </div>
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