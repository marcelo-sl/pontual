@extends('layouts.app')
@section('title', 'Usuários')

@section('css')

<link href="{{ asset('plugins/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" crossorigin="anonymous" />
<link href="{{ asset('plugins/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet" crossorigin="anonymous" />

@endsection

@section('main')

<main>
  <div class="container-fluid">
      <h1 class="mt-4"><i class="fas fa-calendar-alt text-primary"></i> Agendamentos</h1>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table dataTable" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                  <th>Prestador de serviços / Empresa</th>
                  <th>Para o dia</th>
                  <th>Status</th>
                  <th>Realizado em</th>
                  <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach($schedules as $schedule)
                <tr>
                  <td>{{ $schedule->provider->nickname ?? $schedule->company->trade_name }}</td>
                  <td>{{ $schedule->date_time->format('d/m/Y à\s H:i') }}</td>
                  <td>
                    @switch($schedule->status_id)
                      @case(1)
                        <span class="badge badge-pill badge-info">
                        @break
                      @case(2)
                        <span class="badge badge-pill badge-warning">
                        @break
                      @case(3)
                        <span class="badge badge-pill badge-success">
                        @break
                      @case(4)
                        <span class="badge badge-pill badge-danger">
                        @break
                      @case(5)
                        <span class="badge badge-pill badge-dark">
                        @break
                      @default
                        <span class="badge badge-pill badge-secondary">
                    @endswitch
                    {{ $schedule->status->status }}</span>
                  </td>
                  <td>{{ $schedule->created_at->format('d/m/Y H:i:s') }}</td>
                  <td>
                    @if($schedule->status_id !== 4)
                      <a 
                        href="#modalCancel_{{ $schedule->id }}"
                        class="btn btn-danger" 
                        data-toggle="modal"
                        data-tooltip="tooltip" data-placement="top" title="Cancelar agendamento"                        
                      >
                        <i class="fas fa-calendar-times"></i>
                      </a>
                      <button
                        onclick="rate({{ $schedule->id }})"
                        class="btn btn-primary" 
                        data-tooltip="tooltip" data-placement="top" title="Avaliar agendamento"                        
                      >
                        <i class="fas fa-thumbs-up"></i>
                    </button>
                    @endif                  
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        @foreach ($schedules as $schedule)

          @if ($schedule->status_id !== 4)
            @include('users/_modal-cancel')
          @endif

        @endforeach

      </div>
  </div>
</main>

@endsection

@section('js')

<script src="{{ asset('plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/user-datatables.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  function rate(schedule_id) {
    $.ajax({
      method: "GET",
      url: `http://192.168.100.51/?schedule_id=${schedule_id}`
    }).done(function(){
      swal({
        title: "Muito obrigado!",
        text: "Agradecemos por avaliar nosso atendimento, assim podemos sempre melhorar!",
        icon: "success"
      });
    });
  }
</script>

@endsection