@extends('layouts.auth')

@section('title', 'Cadastro')

@section('css')
	<link href="{{ asset('css/auth-styles.css')}}" rel="stylesheet" />
@endsection

@section('main')
  <main>
    <div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7">
					<div class="card shadow-lg border-0 rounded-lg mt-5">
						<div class="card-header">
							<h3 class="text-center font-weight-light my-4">Crie sua conta</h3>
						</div>
						<div class="card-body">
							<form id="userForm" action="{{ route('user.store') }}" method="POST">
								
								@csrf

								<div class="form-row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="small mb-1" for="inputName">Nome</label>
											<input class="form-control py-4" id="inputName" type="text" name="name" placeholder="Digite seu nome" />
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="small mb-1" for="inputEmail">Email</label>
									<input class="form-control py-4" id="inputEmail" type="email" name="email" aria-describedby="emailHelp" placeholder="Digite seu e-mail" />
								</div>

								<div class="form-row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="small mb-1" for="genderTitle">Sexo</label>
											<div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="gender" id="maleRadio" value="M">
													<label class="form-check-label" for="maleRadio">Masculino</label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="F">
													<label class="form-check-label" for="femaleRadio">Feminino</label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="gender" id="otherRadio" value="O">
													<label class="form-check-label" for="otherRadio">Outro</label>
												</div>
											</div>
										</div>
									</div>
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
											<label class="small mb-1" for="password_confirmation">Confirmar senha</label>
											<input class="form-control py-4" id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirme sua senha" />
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

@section('js')

	<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('js/user-validation.js') }}"></script>
	<script src="{{ asset('js/validation-messages.js') }}"></script>

@endsection