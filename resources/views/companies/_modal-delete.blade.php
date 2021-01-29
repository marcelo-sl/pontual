<div id="modalDelete_{{ $company->id }}" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="inactivateModalLabel">Tem certeza que deseja excluir esta empresa?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b>Nome:</b>
        <p>{{ $company->trade_name }}</p>
        <hr>
        <b>CNPJ:</b>
        <p>{{ $company->cnpj }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <form action="{{ route('company.destroy', $company->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Deletar</button>
        </form>
      </div>
    </div>
  </div>
</div>