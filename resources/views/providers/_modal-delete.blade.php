<div id="modalDelete_{{ $provider->id }}" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="inactivateModalLabel">Tem certeza que deseja excluir  prestador de serviços?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b>Nome comercial:</b>
        <p>{{ $provider->nickname }}</p>
        <hr>
        <b>CPF:</b>
        <p>{{ $provider->cpf }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <form action="{{ route('provider.destroy', $provider->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Deletar</button>
        </form>
      </div>
    </div>
  </div>
</div>