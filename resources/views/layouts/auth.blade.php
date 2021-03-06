<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="icon" type="image/svg+xml" href="{{ asset('img/favicon.svg') }}">

        <title>Pontual - @yield('title')</title>
        
        <link href="{{ asset('plugins/start-bootstrap/css/styles.css')}}" rel="stylesheet" />
        @notifyCss
        
        @yield('css')
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="layoutAuthentication">
            <div class="col-12">
                @if($errors->any())
                    <div class="row mb-2">
                        <div class="col-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if(session()->has('msg_error'))
                    <div class="row mt-4">
                        <div class="col-6 m-auto">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <i class="fas fa-exclamation-circle"></i>
                                <strong>{{ session()->get('msg_title') }}</strong>
                                <hr>
                                <p>{{ session()->get('msg_error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session()->has('msg_success'))
                    <div class="row mt-4">
                        <div class="col-6 m-auto">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <i class="fas fa-check-circle"></i>
                                <strong>{{ session()->get('msg_title') }}</strong>
                                <hr>
                                <p>{{ session()->get('msg_success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            
            <div id="layoutAuthentication_content">
              
              @yield('main')

            </div>
            <div class="mt-3" id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Pontual 2021</div>
                            <div>
                                <a href="#">Política de Privacidade</a>
                                &middot;
                                <a href="#">Termos &amp; Condições</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('plugins/jquery/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('plugins/start-bootstrap/js/scripts.js') }}"></script>
        @notifyJs
        <x:notify-messages />

        @yield('js')
        
    </body>
</html>
