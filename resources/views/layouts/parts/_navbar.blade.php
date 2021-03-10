<nav class="sb-topnav navbar navbar-expand navbar-dark" id="topnav">
  <!-- <a class="navbar-brand" href="index.html">Pontual</a> -->
  <img src="{{ asset('img/logo-pontual-titulo.png') }}" alt="Pontual"id="logoPontual">
  @if(Auth::user()->hasRole('Customer'))
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
  @endif
  <!-- Navbar Search-->
  <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <!-- <div class="input-group">
          <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
          <div class="input-group-append">
              <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
          </div>
      </div> -->
  </form>
  <!-- Navbar-->
  <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown">
          <a 
            class="nav-link dropdown-toggle d-flex flex-row  align-items-center" 
            id="userDropdown" 
            href="#" 
            role="button" 
            data-toggle="dropdown" 
            aria-haspopup="true" 
            aria-expanded="false"
          >
          {{ Auth::user()->name }}

            @if (Auth::user()->avatar_url == '')
              <i class="fas fa-user-circle"></i>
            @else 
              <img class="rounded-circle w-10 ml-2 mr-1" src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}">
            @endif 
            <!-- <i class="fas fa-user fa-fw"></i> -->
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="{{ route('user.show', Auth::user()->id) }}">Meu perfil</a>
              <a class="dropdown-item" href="#">Activity Log</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="{{ route('auth.logout') }}"><i class="fas fa-sign-out-alt"></i> Sair</a>
          </div>
      </li>
  </ul>
</nav>