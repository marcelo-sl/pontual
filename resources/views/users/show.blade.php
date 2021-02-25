@extends('layouts.app')
@section('title', 'Perfil')

@section('main')

<main>
  <div class="container-fluid">
      <h1 class="mt-4">Usuários</h1>
      <ol class="breadcrumb">
          <li class="breadcrumb-item active">Usuários</li>
      </ol>
      <div class="card-body d-flex justify-content-center">

        <div class="card" style="width: 38rem;">
          <div class="d-flex justify-content-center my-3">
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
                <a class="ml-2 text-dark" href="{{ route('user.edit', Auth::user()->id) }}"><i class="fas fa-user-edit"></i></a>
              </div>
            </div>
            <ul class="list-group list-group-flush mt-5">
              {{-- Personal Data --}}
              <h5><i class="fas fa-id-card"></i> Dados Pessoais</h5>
              <li class="list-group-item d-flex justify-content-between">
                <h6>E-mail:</h6> {{ $user->email }}
              </li>
              @if ($user->cpf != null)
                <li class="list-group-item d-flex justify-content-between">
                  <h6>CPF:</h6> {{ $user->cpf ?? 'Dado não informado' }}
                </li>
              @endif
              @if ($user->birthday != null)
                <li class="list-group-item d-flex justify-content-between">
                  <h6>Nascimento:</h6> {{ date('d/m/Y', strtotime($user->birthday)) }}
                </li>
              @endif
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

              {{-- Contact --}}
              @if (count($user->contacts()->get()) > 0)
                <h5 class="mt-4"><i class="fas fa-phone-square-alt"></i> Contato</h5>
                <li class="list-group-item">
                  <div class="row">
                    @if (count($user->contacts()->get()) == 1)
                      <div class="col-md-12">
                        <p class="bg-light border p-3 rounded">{{ $user->contacts()->get()[0]->phone_number }}</p>
                      </div>
                    @else
                      @foreach ($user->contacts()->get() as $contact)
                        <div class="col-md-6">
                          <p class="bg-light border p-3 rounded">{{ $contact->phone_number }}</p>
                        </div>
                      @endforeach
                    @endif
                </div>
                </li>
              @endif

              {{-- Account --}}
              <li>
                <h5 class="mt-4"><i class="fas fa-cog"></i> Conta</h5>
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
                <p>{{ $user->created_at->format('d/m/Y H:i:s') }}</p>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <h6>Última atualização:</h6>
                <p>{{ $user->updated_at->format('d/m/Y H:i:s') }}</p>
              </li>
            </ul>
          </div>
        </div>

      </div>
  </div>
</main>

@endsection