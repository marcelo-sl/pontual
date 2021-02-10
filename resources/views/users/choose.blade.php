@extends('layouts.app')
@section('title', 'Tipo de perfil')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/user-styles.css') }}">
@endsection

@section('main')

<main>
  <div class="container-fluid">
    <div class="d-flex justify-content-center" id="choose-title">
      <h1 class="mt-4">Escolha seu tipo de perfil:</h1>
    </div>

    <div id="choose-content" class="d-flex justify-content-around mt-5">
      <a href="" class="card text-white p-4" id="customer-card">
        <img src="{{ asset('img/choose-customer.svg') }}" class="card-img" alt="Cliente">
        <div class="card-content mt-4">
          <h3 class="card-title">Sou um cliente</h3>
          <p class="card-text">Gostaria de encontrar uma grande variedade de salões de cabelereiro, salões de beleza, barbeiros, etc.</p>
        </div>
      </a>
      
      <a href="{{ route('provider.create') }}" class="card text-white p-4" id="provider-card">
        <img src="{{ asset('img/choose-provider.svg') }}" class="card-img" alt="Prestador de serviços">
        <div class="card-content mt-4">
          <h3 class="card-title">Sou um prestador de serviços</h3>
          <p class="card-text">Gostaria de me cadastrar como prestador de serviços e ter maior controle sobre meus horários de atendimento.</p>
        </div>
      </a>

      <a href="{{ route('company.create') }}" class="card p-4" id="owner-card">
        <img src="{{ asset('img/choose-owner.svg') }}" class="card-img" alt="Proprietário">
        <div class="card-content mt-4">
          <h3 class="card-title">Sou um proprietário</h3>
          <p class="card-text">Gostaria de cadastrar meu negócio e ter maior controle sobre meus horários de atendimento.</p>
        </div>
      </a>
    </div>
  </div>
</main>

@endsection