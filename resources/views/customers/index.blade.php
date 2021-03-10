@extends('layouts.app')
@section('title', 'Encontre o negócio certo')

@section('css')
  <link href="{{ asset('css/customer-styles.css') }}" rel="stylesheet" />
@endsection

@section('main')
<main>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6">
        <form action="{{ route('customer.search') }}" method="post">
          @csrf
          <div class="input-group mt-4">
                <input 
                  type="text" 
                  class="form-control"
                  name="search"
                  id="customer-search-text"
                  placeholder="Pesquisar uma empresa ou prestador de serviço..."
                >
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit" id="customer-search-button">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
          </div>
        </form>
      </div>

      <div class="col-12">
        <div class="card shadow-lg border-0 rounded-lg mt-5 p-5">
          @foreach($list as $item)
            <a 
              href="{{ 
                $item->nickname 
                ? route('provider.show', $item->id) 
                : route('company.show', $item->id) 
              }}" 
              class="card mb-3 col-12"
            >
              <div class="row no-gutters py-2">
                <div class="col-md-2">
                  <img 
                    class="rounded-circle border" 
                    src="{{
                      $item->nickname 
                      ? $item->user->avatar_url 
                      : $item->logo_url
                    }}" 
                    alt="Card image cap"
                  >
                </div>
                <div class="col-md-10">
                  <div class="card-body">
                    <h5 class="card-title mb-1">{{ $item->nickname ?? $item->trade_name }}</h5>

                    @forelse($item->fieldsActivities as $fieldActivity)
                      <span class="badge badge-pill badge-light border">{{$fieldActivity->field}}</span>
                    @empty
                      <span class="badge badge-pill badge-light">{{ 'Nenhum' }}</span>
                    @endforelse
                    
                    <p class="card-text text-justify mt-2">
                      <b>Endereço: </b>
                      {{ $item->address->address }}, 
                      Nº {{$item->address->house_number}}  
                      {{ $item->address->address_complement ?? ''}} -  
                      {{$item->address->district}} - 
                      {{$item->address->city->city}}/{{$item->address->city->state->uf}} - 
                      {{ $item->address->cep }}
                    </p>

                    <p><small>
                      <b>Avaliações: </b>                      
                      <i class="fas fa-star"></i>
                      4.5/5</small>
                    </p>
                    <!-- <p class="card-text text-justify" >{{
                      $item->address ?? ''
                    }}</p> -->
                  </div>
                </div>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</main>

@endsection

@section('js')

<script src="{{ asset('js/customer.js') }}"></script>

@endsection