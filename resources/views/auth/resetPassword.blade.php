@extends('layouts.auth')
@section('title', 'Reset Password')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth-styles.css') }}">
@endsection
@section('main')
  <main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                      <h3 class="text-center font-weight-light my-4">Informe seu endereço de e-mail</h3>
                      <span class="text-secondary">Nós enviaremos um código de alteração de senha para o e-mail informado.</span>
                    </div>
                    <div class="card-body">
                        <form id="userForm" action="#" method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                <input class="form-control py-4" id="inputEmailAddress" type="email" name="email" placeholder="Digite seu e-mail" required />
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                <button type="submit" class="btn btn-primary" href="#">Enviar código</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <div class="small"><a href="{{ asset('/login') }}">Voltar para página de login</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>
@stop

@section('js')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/user-validation.js') }}"></script>
    <script src="{{ asset('js/validation-messages.js') }}"></script>
@endsection