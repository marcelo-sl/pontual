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
      @notifyCss
      <link href="{{ asset('plugins/start-bootstrap/css/styles.css') }}" rel="stylesheet" />
      <link href="{{ asset('css/app-styles.css') }}" rel="stylesheet" />

      {{-- Datatable --}}
      <link rel="stylesheet" href="{{ asset('plugins/datatables/DataTables-1.10.24/css/dataTables.bootstrap4.min.css') }}">

      @yield('css')
      
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed {{ Auth::user()->hasRole('Customer') ? '' : 'sb-sidenav-toggled' }}">
     
      
      @include('layouts/parts/_navbar')

      <div id="layoutSidenav">
        @include('layouts/parts/_sidebar')
        
        <div id="layoutSidenav_content">
          @if ($errors->any())
          <div class="alert alert-warning alert-dismissible fade show w-50 mt-3 mx-auto" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
          </div>
          @endif

          @if(session()->has('msg_error'))
              
            <div class="alert alert-danger alert-dismissible fade show w-50 mt-3 mx-auto" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="fas fa-exclamation-circle"></i>
                <strong>{{ session()->get('msg_title') }}</strong>
                <hr>
                <p>{{ session()->get('msg_error') }}</p>
            </div>
                  
          @endif

          @if(session()->has('msg_success'))
              
            <div class="alert alert-success alert-dismissible fade show w-50 mt-3 mx-auto" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="fas fa-check-circle"></i>
                <strong>{{ session()->get('msg_title') }}</strong>
                <hr>
                <p>{{ session()->get('msg_success') }}</p>
            </div>
                  
          @endif
          
          @yield('main')

          <footer class="py-4 bg-light mt-4">
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
      <!-- Datatables -->
      <script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>
      <script src="{{ asset('plugins/datatables/Buttons-1.7.0/js/dataTables.buttons.min.js') }}"></script>
      <script src="{{ asset('plugins/datatables/JSZip-2.5.0/jszip.min.js') }}"></script>
      <script scr="{{ asset('plugins/datatables/pdfmake-0.1.36/pdfmake.min.js') }}"></script>
      <script scr="{{ asset('plugins/datatables/pdfmake-0.1.36/vfs_fonts.js') }}"></script>
      <script scr="{{ asset('plugins/datatables/Buttons-1.7.0/js/buttons.html5.min.js') }}"></script>

      <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('plugins/start-bootstrap/js/scripts.js') }}"></script>
      @notifyJs
      <x:notify-messages />
      
      @yield('js')
    </body>
</html>
