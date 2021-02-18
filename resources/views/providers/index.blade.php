@extends('layouts.app')
@section('title', 'Prestadores de serviços')

@section('css')

<link href="{{ asset('plugins/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" crossorigin="anonymous" />
<link href="{{ asset('plugins/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet" crossorigin="anonymous" />

@endsection

@section('main')

<main>
  <div class="container-fluid">
      <h1 class="mt-4">Prestadores de serviços</h1>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active">Prestadores de serviços</li>
      </ol>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                  <th>Nome comercial</th>
                  <th>CPF</th>
                  <th>E-mail do responsável</th>
                  <th>Status</th>
                  <th>Data de criação</th>
                  <th>Opções</th>
              </tr>
            </thead>
            <tbody>
              @foreach($providers as $provider)
                <tr>
                  <td>{{ $provider->nickname }}</td>
                  <td>{{ $provider->cpf }}</td>
                  <td>{{ $provider->user->email }}</td>
                  <td>
                    @if($provider->inactive)
                        <span class="badge badge-pill badge-danger">Inativo</span>
                    @else
                        <span class="badge badge-pill badge-success">Ativo</span> 
                    @endif
                  </td>
                  <td>{{ $provider->created_at->format('d/m/Y H:i:s') }}</td>
                  <td>
                    <a href="{{ route('provider.show', $provider->id) }}" class="btn btn-info" title="Perfil"><i class="fas fa-id-card"></i></a>
                    <a href="{{ route('provider.edit', $provider->id) }}" class="btn btn-primary" title="Editar"><i class="fas fa-user-edit"></i></a>

                    @if(!$provider->inactive)
                      <a 
                        href="#modalInactivate_{{ $provider->id }}"
                        class="btn btn-warning {{-- Auth::user()->id === $user->id ? 'disabled' : '' --}}" 
                        data-toggle="modal"
                        data-tooltip="tooltip" data-placement="top" title="Inativar"                        
                      >
                        <i class="fas fa-user-slash"></i>
                      </a>
                    @else
                      <a 
                        href="#modalInactivate_{{ $provider->id }}"
                        class="btn btn-warning disabled" 
                        data-toggle="modal"
                        data-tooltip="tooltip" data-placement="top" title="Reativar"
                      >
                        <i class="fas fa-recycle"></i>
                      </a>
                    @endif

                    @if(!$provider->trashed())
                      <a 
                        href="#modalDelete_{{ $provider->id }}"
                        class="btn btn-danger {{-- Auth::user()->id === $user->id ? 'disabled' : '' --}}" 
                        data-toggle="modal"
                        data-tooltip="tooltip" data-placement="top" title="Deletar"
                      >
                        <i class="fas fa-trash"></i>
                      </a>
                    @else
                      <a 
                        href="#modalInactivate_{{ $provider->id }}"
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

        @foreach ($providers as $provider)

          {{-- @if ($provider->id !== Auth::user()->id) --}}

            @include('providers/_modal-inactivate')
            @include('providers/_modal-delete')

          {{-- @endif --}}

        @endforeach

      </div>
      
  </div>
</main>

@endsection

@section('js')

<script src="{{ asset('plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/user-datatables.js') }}"></script>

@endsection