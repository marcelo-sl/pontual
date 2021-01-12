@extends('layouts.auth')
@section('title', 'Cadastro')

@section('main')
  <main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Crie sua conta</h3></div>
                    <div class="card-body">
                        <form action="{{ route('user.store') }}" method="POST">
                          
                        @csrf

                          <div class="form-row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="small mb-1" for="inputFirstName">Nome</label>
                                      <input class="form-control py-4" id="inputFirstName" type="text" name="name" placeholder="Digite seu nome" />
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="small mb-1" for="inputLastName">Sexo</label>
                                      <div>
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="M">
                                          <label class="form-check-label" for="inlineRadio1">Masculino</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="F">
                                          <label class="form-check-label" for="inlineRadio2">Feminino</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="O">
                                          <label class="form-check-label" for="inlineRadio2">Outro</label>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="small mb-1" for="inputEmailAddress">Email</label>
                              <input class="form-control py-4" id="inputEmailAddress" type="email" name="email" aria-describedby="emailHelp" placeholder="Digite seu e-mail" />
                          </div>
                          <div class="form-row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="small mb-1" for="inputPassword">Senha</label>
                                      <input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Digite sua senha" />
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="small mb-1" for="inputConfirmPassword">Confirmar senha</label>
                                      <input class="form-control py-4" id="inputConfirmPassword" name="password_confirmation" type="password" placeholder="Confirme sua senha" />
                                  </div>
                              </div>
                          </div>
                          <div class="form-group mt-4 mb-0"><button type="submit" class="btn btn-primary btn-block">Criar conta</button></div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <div class="small"><a href="{{ asset('/login') }}">Já possui uma conta? Entre já</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>
@endsection