@extends('layouts.auth')
@section('title', 'Login')

@section('main')
  <main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                      <h3 class="text-center font-weight-light my-4">Entre com seu usuário</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                <input class="form-control py-4" id="inputEmailAddress" type="email" placeholder="Digite seu e-mail" />
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="inputPassword">Senha</label>
                                <input class="form-control py-4" id="inputPassword" type="password" placeholder="Digite sua senha" />
                            </div>
                            <!-- <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                </div>
                            </div> -->
                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="password.html">Esqueci minha senha</a>
                                <a class="btn btn-primary" href="index.html">Entrar</a>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <div class="small"><a href="{{ asset('/register') }}">Ainda não tem uma conta? Cadastre-se já!</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>
@stop