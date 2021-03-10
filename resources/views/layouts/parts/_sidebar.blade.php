<div id="layoutSidenav_nav">
  <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
      <div class="nav">
      
        <div class="sb-sidenav-menu-heading"><i class="fas fa-calendar"></i> Agendamentos</div>
        <a class="nav-link" href="{{ route('customer.index') }}">
          <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
          Home
        </a>
        <a class="nav-link" href="{{ route('user.schedules', Auth::user()->id) }}">
          <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
          Meus agendamentos
        </a>
        
        <div class="sb-sidenav-menu-heading"><i class="fa fa-cog"></i> Configurações</div>
          <a class="nav-link" href="{{ route('dashboard.index') }}">
            <div class="sb-nav-link-icon"><i class="fa fa-user-edit"></i></div>
            Editar minha conta
          </a>

        @if(Auth::user()->hasRole('Employee'))
          <div class="sb-sidenav-menu-heading">Negócio</div>
          <a class="nav-link" href="{{ route('dashboard.index') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-chart-pie"></i></div>
            Relatórios
          </a>

          @if(Auth::user()->hasRole('Owner'))
            <a 
              class="nav-link" 
              href="{{ route('company.schedules', Auth::user()->company->id) }}"
            >
              <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
              Agendamentos da empresa
            </a>
          @else
            <a 
              class="nav-link" 
              href="{{ route('provider.schedules', Auth::user()->provider->id) }}"
            >
              <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
              Meus agendamentos
            </a>
          @endif
        @endif
               
        @if(Auth::user()->hasRole('Admin'))
          <div class="sb-sidenav-menu-heading">Administrador</div>
            <a class="nav-link" href="{{ route('user.index') }}">
              <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
              Usuários
            </a>
            <a class="nav-link" href="{{ route('provider.index') }}">
              <div class="sb-nav-link-icon"><i class="fas fa-male"></i></div>
              Prestadores de serviços
            </a>
            <a class="nav-link" href="{{ route('company.index') }}">
              <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
              Empresas
            </a>
          </div>
        @endif
    </div>
    <!-- <div class="sb-sidenav-footer"> -->
      <!-- <div class="small">Logado como:</div> -->
      {{-- Auth::user()->name --}}
    <!-- </div> -->
  </nav>
</div>