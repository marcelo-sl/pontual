@extends('layouts.app')
@section('title', 'Usuários')

@section('main')

<main>
  <div class="container-fluid">
      <h1 class="mt-4"><i class="fas fa-users text-primary"></i> Usuários</h1>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active">Usuários</li>
      </ol>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Tipo</th>
                  <th>Status</th>
                  <th>Data de criação</th>
                  <th>Opções</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
                <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->roles()->orderBy('role_id')->first()->role_name ?? 'Não possui' }}</td>
                  <td>
                    @if($user->inactive)
                        <span class="badge badge-pill badge-danger">Inativo</span>
                    @else
                        <span class="badge badge-pill badge-success">Ativo</span> 
                    @endif
                  </td>
                  <td>{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
                  <td>
                    <a href="{{ route('user.show', $user->id) }}" class="btn btn-info" title="Perfil"><i class="fas fa-id-card"></i></a>
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary" title="Editar"><i class="fas fa-user-edit"></i></a>
                    
                    @if(!$user->inactive)
                      <a 
                        href="#modalInactivate_{{ $user->id }}"
                        class="btn btn-warning {{ Auth::user()->id === $user->id ? 'disabled' : '' }}" 
                        data-toggle="modal"
                        data-tooltip="tooltip" data-placement="top" title="Inativar"                        
                      >
                        <i class="fas fa-user-slash"></i>
                      </a>
                    @else
                      <a 
                        href="#modalInactivate_{{ $user->id }}"
                        class="btn btn-warning disabled" 
                        data-toggle="modal"
                        data-tooltip="tooltip" data-placement="top" title="Reativar"
                      >
                        <i class="fas fa-recycle"></i>
                      </a>
                    @endif

                    @if(!$user->trashed())
                      <a 
                        href="#modalDelete_{{ $user->id }}"
                        class="btn btn-danger {{ Auth::user()->id === $user->id ? 'disabled' : '' }}" 
                        data-toggle="modal"
                        data-tooltip="tooltip" data-placement="top" title="Deletar"
                      >
                        <i class="fas fa-trash"></i>
                      </a>
                    @else
                      <a 
                        href="#modalInactivate_{{ $user->id }}"
                        class="btn btn-danger" 
                        data-toggle="modal"
                        data-tooltip="tooltip" data-placement="top" title="Restaurar"
                      >
                        <i class="fas fa-trash-restore"></i>
                      </a>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        @foreach ($users as $user)

          @if ($user->id !== Auth::user()->id)

            @include('users/_modal-inactivate')
            @include('users/_modal-delete')

          @endif

        @endforeach
      </div>
  </div>
</main>

@endsection

@section('js')

<script src="{{ asset('js/user-datatables.js') }}"></script>

@endsection