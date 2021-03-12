<div id="layoutSidenav_nav">
  <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
      <div class="nav">

        @if(!Auth::user()->hasRole('Employee'))
          <div class="sb-sidenav-menu-heading"><span class="sidebar-title"><i class="fas fa-calendar"></i> Agendamentos</span></div>
          <a class="nav-link" href="{{ route('customer.index') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
            Home
          </a>
          <a class="nav-link" href="{{ route('user.schedules', Auth::user()->id) }}">
            <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
            Meus agendamentos
          </a>
        @endif

        @if(Auth::user()->hasRole('Employee'))
          <div class="sb-sidenav-menu-heading"><span class="sidebar-title"><i class="fas fa-business-time"></i> Negócio</span></div>
          
          @if(Auth::user()->provider)
            <a class="nav-link" href="{{ route('provider.show', Auth::user()->provider->id) }}">
            <div class="sb-nav-link-icon"><i class="fas fa-store-alt"></i></div>
              Perfil comercial
            </a>
          @endif
          

          @if(Auth::user()->hasRole('Owner'))
            <a
              class="nav-link"
              href="{{ route('company.schedules', Auth::user()->company->id) }}"
            >
              <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
              Agendamentos da empresa
            </a>
          @endif
          @if(Auth::user()->provider)
            <a
              class="nav-link" 
              href="{{ route('provider.schedules', Auth::user()->provider->id) }}"
            >
              <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
              Meus agendamentos
            </a>
          @endif

          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-chart-pie"></i></div>
              Relatórios
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link" href="{{ route('dashboard.company') }}"><i class="fas fa-store mr-2"></i> Empresa</a>
              <a class="nav-link" href="{{ route('dashboard.provider') }}"><i class="fas fa-male mr-2"></i> Prestador de Serviço</a>
            </nav>
          </div>

        @endif
        
        <div class="sb-sidenav-menu-heading"><span class="sidebar-title"><i class="fa fa-cog"></i> Configurações</span></div>
        <a class="nav-link" href="{{ route('user.edit', Auth::id()) }}">
          <div class="sb-nav-link-icon"><i class="fa fa-user-edit"></i></div>
          Editar minha conta
        </a>

        @if(Auth::user()->provider)
          <a class="nav-link" href="{{ route('provider.edit', Auth::user()->provider->id) }}">
            <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
            Editar dados comerciais
          </a>
        @endif
        
               
        @if(Auth::user()->hasRole('Admin'))
          <div class="sb-sidenav-menu-heading"><span class="sidebar-title"><i class="fas fa-user-lock"></i> Administrador</span></div>
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