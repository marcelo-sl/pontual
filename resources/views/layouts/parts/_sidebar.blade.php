<div id="layoutSidenav_nav">
  <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
      <div class="nav">
      
        <a class="nav-link" href="{{ route('customer.index') }}">
          <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
          Home
        </a>
        <a class="nav-link" href="{{ route('user.schedules', Auth::user()->id) }}">
          <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
          Meus agendamentos
        </a>
        <div class="sb-sidenav-menu-heading">Negócio</div>
        <a class="nav-link" href="{{ route('dashboard.index') }}">
          <div class="sb-nav-link-icon"><i class="fas fa-chart-pie"></i></div>
          Relatórios
        </a>
        <div class="sb-sidenav-menu-heading">Exemplos Título</div>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
          <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
          Multi Exemplos
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="">Exemplo 1</a>
            <a class="nav-link" href="">Exemplo 2</a>
          </nav>
        </div>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
          <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
          Empresas
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
              Authentication
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
              <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="login.html">Login</a>
                  <a class="nav-link" href="register.html">Register</a>
                  <a class="nav-link" href="password.html">Forgot Password</a>
              </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
              Error
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="401.html">401 Page</a>
                <a class="nav-link" href="404.html">404 Page</a>
                <a class="nav-link" href="500.html">500 Page</a>
              </nav>
            </div>
          </nav>
        </div>
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
    </div>
    <div class="sb-sidenav-footer">
      <div class="small">Logado como:</div>
      {{ Auth::user()->name }}
    </div>
  </nav>
</div>