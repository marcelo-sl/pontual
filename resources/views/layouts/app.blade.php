<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>Pontual - @yield('title')</title>
      <link href="{{ asset('plugins/start-bootstrap/css/styles.css') }}" rel="stylesheet" />
      <link href="{{ asset('css/app-styles.css') }}" rel="stylesheet" />
      
      @yield('css')
      
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed {{ Auth::user()->hasRole('Customer') ? '' : 'sb-sidenav-toggled' }}">
      
      @include('layouts/parts/_navbar')

      <div id="layoutSidenav">
        @include('layouts/parts/_sidebar')
        
        <div id="layoutSidenav_content">
            
          @yield('main')

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
      
      @yield('js')
    </body>
</html>
