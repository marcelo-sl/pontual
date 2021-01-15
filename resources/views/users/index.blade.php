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
      <div class="card mb-4">
          <div class="card-header">
              <i class="fas fa-table mr-1"></i>
              DataTable Example
          </div>
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                              <th>Nome</th>
                              <th>E-mail</th>
                              <th>Sexo</th>
                              <th>Nível</th>
                              <th>Data de criação</th>
                              <th>Última atualização</th>
                          </tr>
                      </thead>
                      <tfoot>
                          <tr>
                              <th>Nome</th>
                              <th>E-mail</th>
                              <th>Sexo</th>
                              <th>Nível</th>
                              <th>Data de criação</th>
                              <th>Última atualização</th>
                          </tr>
                      </tfoot>
                      <tbody>
                        @foreach($users as $user)
                          <tr>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>{{ $user->gender }}</td>
                              <td>{{ $user->roles()->orderBy('role_id')->first()->role_name ?? 'Não possui' }}</td>
                              <td>{{ $user->created_at }}</td>
                              <td>{{ $user->updated_at }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</main>

@endsection

@section('js')

<script src="{{ asset('plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/user-datatables.js') }}"></script>

@endsection