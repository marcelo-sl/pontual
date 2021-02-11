@extends('layouts.auth')
@section('title', 'Fill Token')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth-styles.css') }}">
@endsection
@section('main')
  <main>

    @if(isset($error))
        <div class="row mt-4">
            <div class="col-6 m-auto">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="fas fa-exclamation-circle"></i>
                    <strong>{{ $error['msg_title'] }}</strong>
                    <hr>
                    <p>{{ $error['msg_error'] }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(isset($success))
        <div class="row mt-4">
            <div class="col-6 m-auto">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="fas fa-check-circle"></i>
                    <strong>{{ $success['msg_title'] }}</strong>
                    <hr>
                    <p>{{ $success['msg_success'] }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                      <img src="{{ asset('img/sendMail.svg') }}" class="card-img w-50 mx-auto" alt="Mail">
                      <h3 class="text-center font-weight-light my-4">Estamos quase lá, verifique seu e-mail!</h3>
                      <span class="text-secondary">Insira o código enviado ao e-mail: <span class="text-primary">{{ $user->email }}</span></span>
                    </div>
                    <div class="card-body">
                        <form id="tokenForm" action="{{ route('auth.checkToken', $user->id) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="small mb-1" for="inputToken">Código</label>
                                <input class="form-control py-4" id="inputToken" type="text" name="token" value="{{ old('token') }}" placeholder="Digite o código" required />
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                <button type="submit" class="btn btn-primary" href="#">Validar Código</button>
                                <a class="btn btn-secondary" href="{{ route('auth.generateNewToken', $user->id)}}">Gerar um novo Código</a>
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