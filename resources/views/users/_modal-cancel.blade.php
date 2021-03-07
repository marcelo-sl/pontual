<div id="modalCancel_{{ $schedule->id }}" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="inactivateModalLabel">Tem certeza que deseja cancelar este agendamento?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="mb-4"><small>
          Uma vez cancelado o agendamento não voltará mais ser ativado
          <br>
          Os agendamentos só podem ser cancelados 48 horas antes da data marcada
        </small></p>

        <b>Agendamento para o dia:</b>
        <p>{{ $schedule->date_time->format('d/m/Y à\s H:i') }}</p>
        <hr>
        <b>Agendado com:</b>
        <p>{{ $schedule->provider->nickname ?? $schedule->company->trade_name }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não cancelar</button>
        <form action="{{ route('schedule.cancel', $schedule->id) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-danger">Sim, tenho certeza</button>
        </form>
      </div>
    </div>
  </div>
</div>