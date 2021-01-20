<div id="modalInactivate_{{ $user->id }}" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="inactivateModalLabel">Tem certeza que deseja inativar usuário?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b>Nome:</b>
        <p>{{ $user->name }}</p>
        <hr>
        <b>Email:</b>
        <p>{{ $user->email }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <form action="{{ route('user.inactivate', $user->id) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-warning">Inativar</button>
        </form>
      </div>
    </div>
  </div>
</div>