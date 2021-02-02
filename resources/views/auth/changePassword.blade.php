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
                            <img src="{{ asset('img/newPassword.svg') }}" class="card-img w-25 mx-auto" alt="Create Password">
							<h3 class="text-center font-weight-light my-4">Alterar senha</h3>
						</div>
						<div class="card-body">
							<form id="userForm" action="{{ route('auth.changePassword', $user->id) }}" method="POST">
								
								@csrf

                                <div class="form-group">
                                    <label class="small mb-1" for="inputPassword">Senha</label>
                                    <input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Digite sua senha" />
                                </div>                            
                            
                                <div class="form-group">
                                    <label class="small mb-1" for="password_confirmation">Confirmar senha</label>
                                    <input class="form-control py-4" id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirme sua senha" />
                                </div>

								<div class="form-group mt-4 mb-0"><button type="submit" class="btn btn-primary">Alterar</button></div>
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