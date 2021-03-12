@extends('layouts.app')
@section('title', 'Editar conta')

@section('main')
  <main>
    <div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7">
					<div class="card shadow-lg border-0 rounded-lg mt-5">
						<div class="card-header">
							<h3 class="text-center font-weight-light my-4"><i class="fas fa-user-edit"></i> Edite sua conta</h3>
						</div>
						<div class="card-body">
							<form id="userForm" action="{{ route('user.update', $user->id) }}" method="POST"  enctype="multipart/form-data">
								
								@csrf
								@method('PUT')

								

								<h5><i class="fas fa-id-card"></i> Dados Pessoais</h5>

								<div class="form-group">
									<label class="small mb-1" for="inputEmail">Foto de perfil</label>
									<br>
									<input type="file" class="form-control-file" id="avatar" name="avatar" accept="image/png, image/jpeg">
								</div>
								
								<div class="form-group">
									<label class="small mb-1" for="inputEmail">Email</label>
									<input class="form-control py-4" id="inputEmail" type="email" name="email" aria-describedby="emailHelp" placeholder="Digite seu e-mail" value="{{ $user->email }}" readonly/>
								</div>

								<div class="row">
									<div class="form-group col-md-6">
										<label class="small mb-1" for="inputName">Nome</label>
										<input class="form-control py-4" id="inputName" type="text" name="name" placeholder="Digite seu nome" value="{{ $user->name }}" />
									</div>
									
									<div class="form-group col-md-6">
										<label class="small mb-1" for="inputEmail">CPF</label>
										<input class="form-control py-4 cpf" id="inputCpf" type="text" name="cpf" value="{{ $user->cpf ?? '' }}"/>
									</div>
								</div>

								<div class="form-group">
									<label class="small mb-1" for="inputName">Nascimento</label>
									<input class="form-control py-4" id="inputBirthday" type="date" name="birthday" placeholder="Digite seu nome" value="{{ old('nascimento') ?? $user->birthday }}" />
								</div>

								<div class="form-row">
									<div class="col-md-12">
										<div class="form-group" id="checkSexo">
											<label class="small mb-1" for="genderTitle">Sexo</label>
											<div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="gender" id="maleRadio" value="M" {{ ($user->gender == 'M') ? 'checked' : '' }}>
													<label class="form-check-label" for="maleRadio">Masculino</label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="F" {{ ($user->gender == 'F') ? 'checked' : '' }}>
													<label class="form-check-label" for="femaleRadio">Feminino</label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="gender" id="otherRadio" value="O" {{ ($user->gender == 'O') ? 'checked' : '' }}>
													<label class="form-check-label" for="otherRadio">Outro</label>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<hr>
								<h5><i class="fas fa-phone-square-alt"></i> Contato</h5>
								
								@forelse ($user->contacts as $contact)
								
									<div id="contacts">
										<div id="contacts-place">
											<div class="row contact-row">
											<div class="col-md-12">
												<div class="form-inline d-flex justify-content-between my-1">
												<label class="mr-2">Contato</label>
												<div>
													<input 
														type="text" 
														name="contacts[]" 
														class="form-control sp_celphones" 
														value="{{ old('contacts') ?? $contact->phone_number }}">
													<a class="btn btn-danger ml-2 removePhone"><i class="fas fa-trash"></i></a>
												</div>
												</div>
											</div>
											</div>
										</div>
									</div>
								
								@empty

									<div id="contacts">
										<div id="contacts-place">
											<div class="row contact-row">
											<div class="col-md-12">
												<div class="form-inline d-flex justify-content-between my-1">
												<label class="mr-2">Contato</label>
												<div>
													<input 
														type="text" 
														name="contacts[]" 
														class="form-control sp_celphones" 
														value="{{ old('contacts') }}">
													<a class="btn btn-danger ml-2 removePhone"><i class="fas fa-trash"></i></a>
												</div>
												</div>
											</div>
											</div>
										</div>
									</div>
									
								@endforelse

								<div class="row my-3" id="addContactDiv">
									<div class="col-4 d-flex justify-content-start">
									<a class="btn btn-success" id="addPhone">
										<i class="fas fa-plus"></i>
										Adicionar contato
									</a>
									</div>
								</div>

								<hr>

								<h5><i class="fas fa-cog"></i> Conta</h5>

								<div class="form-row">
									<div class="col-md-12">
										<div class="form-group">
											<div class="custom-control custom-switch">
												<input id="checkChangePass" type="checkbox" aria-label="Alterar senha" class="custom-control-input" name="changePassword">
												<label class="custom-control-label" for="checkChangePass"><i class="fas fa-key"></i> Alterar senha</label>
											</div>
										</div>
									</div>
								</div>

								<div id="pass" class="d-none">
									<div class="form-row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="small mb-1" for="inputCurrentlyPassword">Senha atual</label>
												<input class="form-control py-4" id="inputCurrentlyPassword" name="currentlyPassword" type="password" placeholder="Digite sua senha atual" />
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="small mb-1" for="inputPassword">Nova senha</label>
												<input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Digite sua nova senha" />
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="small mb-1" for="password_confirmation">Confirmar senha</label>
												<input class="form-control py-4" id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirme sua senha" />
											</div>
										</div>
									</div>
								</div>
								<div class="form-group mt-4 mb-0"><button type="submit" class="btn btn-primary btn-block">Editar conta</button></div>
							</form>
						</div>
					</div>
				</div>
			</div>
    </div>
  </main>
@endsection

@section('js')

	<script src="{{ asset('plugins/jquery-mask/jquery.mask.min.js') }}"></script>
	<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('js/user-validation.js') }}"></script>
	<script src="{{ asset('js/validation-messages.js') }}"></script>
	<script src="{{ asset('js/validate-methods.js') }}"></script>
	<script src="{{ asset('js/mask-format.js') }}"></script>
	<script src="{{ asset('js/multiple-contacts.js') }}"></script>
	<script>
		$('#checkChangePass').change(function() {
			if ($('#checkChangePass').is(':checked')) {
				$('#pass').removeClass('d-none');
			} else {
				$('#pass').addClass('d-none');
			}
		});
	</script>

@endsection