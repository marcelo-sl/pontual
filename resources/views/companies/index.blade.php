@extends('layouts.app')
@section('title', 'Empresas')

@section('css')

<link href="{{ asset('plugins/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" crossorigin="anonymous" />
<link href="{{ asset('plugins/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet" crossorigin="anonymous" />

@endsection

@section('main')

<main>
  <div class="container-fluid">
      <h1 class="mt-4">Empresas</h1>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active">Empresas</li>
      </ol>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                  <th>Nome Fantasia</th>
                  <th>CNPJ</th>
                  <th>Razão Social</th>
                  <th>Status</th>
                  <th>Data de criação</th>
                  <th>Opções</th>
              </tr>
            </thead>
            <tbody>
              @foreach($companies as $company)
                <tr>
                  <td>{{ $company->trade_name }}</td>
                  <td>{{ $company->cnpj }}</td>
                  <td>{{ $company->company_name }}</td>
                  <td>
                    @if($company->inactive)
                        <span class="badge badge-pill badge-danger">Inativo</span>
                    @else
                        <span class="badge badge-pill badge-success">Ativo</span> 
                    @endif
                  </td>
                  <td>{{ $company->created_at->format('d/m/Y H:i:s') }}</td>
                  <td>
                    <a href="{{ route('company.show', $company->id) }}" class="btn btn-info" title="Perfil"><i class="fas fa-id-card"></i></a>
                    <a href="{{-- route('company.edit', $company->id) --}}" class="btn btn-primary" title="Editar"><i class="fas fa-user-edit"></i></a>
                    {{-- 
                    @if(!$company->inactive)
                      <a 
                        href="#modalInactivate_{{ $company->id }}"
                        class="btn btn-warning" 
                        data-toggle="modal"
                        data-tooltip="tooltip" data-placement="top" title="Inativar"                        
                      >
                        <i class="fas fa-user-slash"></i>
                      </a>
                    @else
                      <a 
                        href="#modalInactivate_{{ $company->id }}"
                        class="btn btn-warning disabled" 
                        data-toggle="modal"
                        data-tooltip="tooltip" data-placement="top" title="Reativar"
                      >
                        <i class="fas fa-recycle"></i>
                      </a>
                    @endif

                    @if(!$company->trashed())
                      <a 
                        href="#modalDelete_{{ $company->id }}"
                        class="btn btn-danger" 
                        data-toggle="modal"
                        data-tooltip="tooltip" data-placement="top" title="Deletar"
                      >
                        <i class="fas fa-trash"></i>
                      </a>
                    @else
                      <a 
                        href="#modalInactivate_{{ $company->id }}"
                        class="btn btn-danger" 
                        data-toggle="modal"
                        data-tooltip="tooltip" data-placement="top" title="Restaurar"
                      >
                        <i class="fas fa-trash-restore"></i>
                      </a>
                    @endif
                    --}}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        @foreach ($companies as $company)

          @include('companies/_modal-inactivate')
          @include('companies/_modal-delete')

        @endforeach
      </div>
  </div>
</main>

@endsection

@section('js')

<script src="{{ asset('plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/user-datatables.js') }}"></script>

@endsection