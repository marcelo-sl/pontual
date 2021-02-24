@extends('layouts.app')
@section('title', 'Completar cadastro')

@section('css')
	<link href="{{ asset('css/user-styles.css')}}" rel="stylesheet" />
	<link href="{{ asset('css/validation-styles.css')}}" rel="stylesheet" />
@endsection

@section('main')
  <main>
    <div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7">
					<div class="card shadow-lg border-0 rounded-lg mt-5">
						<div class="card-header">
							<h3 class="text-center font-weight-light my-4"><i class="fas fa-shopping-bag"></i> Complete seu cadastro</h3>
                            <p class="mx-auto text-center text-secondary">Para se tornar um cliente primeiro você precisará completar seu cadastro</p>
						</div>
						<div class="card-body">
							<form id="userForm" action="{{ route('user.completeData', Auth::id()) }}" method="POST">
								
								@csrf
								@method('PUT')

                                <h3 class="my-3">Dados Pessoais</h3>

								<div class="form-row">
									<div class="col-md-12">
										<div class="form-group">
                                            <label for="inputCpf">CPF</label>
                                            <br>
                                            <input 
                                              type="text" 
                                              name="cpf" 
                                              value="{{old('cpf')}}"
                                              class="form-control cpf" 
                                              id="inputCpf" 
                                              placeholder="000.000.000-00" 
                                            />
                                          </div>
									</div>
								</div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="inputBirthday">Nascimento</label>
                                            <input type="date" name="birthday" id="inputBirthday" class="form-control" value="{{ old('birthday') }}">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h3 class="my-3">Contatos</h3>

                                <div id="contacts">

                                    <div id="contacts-place">
                                      <div class="row contact-row">
                                        <div class="col-md-12">
                                          <div class="form-inline d-flex justify-content-between my-1">
                                            <label class="mr-2">Contato</label>
                                            <div>
                                              <input type="text" name="contacts[]" class="form-control sp_celphones" value="{{ old('contacts') }}">
                                              <a class="btn btn-danger ml-2 removePhone"><i class="fas fa-trash"></i></a>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    
                                    <div class="row my-3" id="addContactDiv">
                                      <div class="col-4 d-flex justify-content-start">
                                        <a class="btn btn-success" id="addPhone">
                                          <i class="fas fa-plus"></i>
                                          Adicionar contato
                                        </a>
                                      </div>
                                    </div>
                                  </div>
								
								<div class="form-group mt-4 mb-0"><button type="submit" class="btn btn-primary btn-block"><i class="fas fa-check-circle"></i> Completar cadastro</button></div>
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
@endsection