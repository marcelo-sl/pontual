@extends('layouts.app')
@section('title', 'Usuários')

@section('css')

<link href="{{ asset('plugins/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" crossorigin="anonymous" />
<link href="{{ asset('plugins/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet" crossorigin="anonymous" />

@endsection

@section('main')

<main>
  <div class="container-fluid">
      <h1 class="mt-4">Usuários</h1>
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
                          <th>Nível</th>
                          <th>Status</th>
                          <th>Data de criação</th>
                          <th>Opções</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                          <th>Nome</th>
                          <th>E-mail</th>
                          <th>Nível</th>
                          <th>Status</th>
                          <th>Data de criação</th>
                          <th>Opções</th>
                      </tr>
                  </tfoot>
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
                          <td>{{ $user->created_at }}</td>
                          <td>
                            <a href="{{ route('user.show', $user->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Perfil"><i class="fas fa-id-card"></i></a>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-user-edit"></i></a>
                            <a href="" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Inativar"><i class="fas fa-user-slash"></i></a>
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</main>

@endsection

@section('js')

<script src="{{ asset('plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/user-datatables.js') }}"></script>

@endsection