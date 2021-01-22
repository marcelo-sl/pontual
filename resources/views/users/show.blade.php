@extends('layouts.app')
@section('title', 'Perfil')

@section('main')

<main>
  <div class="container-fluid">
      <h1 class="mt-4">Usuários</h1>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active">Usuários</li>
      </ol>
      <div class="card-body d-flex justify-content-center">

        <div class="card" style="width: 38rem;">
          <div class="text-center my-3">
            @if ($user->avatar_url == '')
              <i class="fas fa-user-circle fa-9x"></i>
            @else 
              <img class="rounded-circle w-50 border" src="{{ $user->avatar_url }}" alt="{{ $user->name }}">
            @endif                
          </div>
          <div class="card-body">
            <div class="row justify-content-center">
              <h5 class="card-title">{{ $user->name }}</h5>
              <div>
                <a class="ml-2 text-dark" href="#"><i class="fas fa-user-edit"></i></a>
              </div>
            </div>
            <ul class="list-group list-group-flush mt-5">
              <li class="list-group-item d-flex justify-content-between">
                <h6>E-mail:</h6> {{ $user->email }}
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <h6>Sexo:</h6>
                <p>
                  @switch($user->gender)
                    @case("M")
                      Masculino
                      @break

                    @case("F")
                      Feminino
                      @break

                    @case("O")
                      Outro
                      @break

                    @default
                      Não definido
                  @endswitch
                </p>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <h6>Tipo:</h6>
                <p>{{ $user->roles()->orderBy('role_id')->first()->role_name ?? 'Não possui' }}</p>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <h6>Status:</h6>
                @if($user->inactive)
                  <span class="badge badge-pill badge-danger">Inativo</span>
                @else
                  <span class="badge badge-pill badge-success">Ativo</span> 
                @endif
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <h6>Data de criação:</h6>
                <p>{{ $user->created_at }}</p>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <h6>Última atualização:</h6>
                <p>{{ $user->updated_at }}</p>
              </li>
            </ul>
          </div>
        </div>

      </div>
  </div>
</main>

@endsection