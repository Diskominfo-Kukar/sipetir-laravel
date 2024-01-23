<aside class="sidebar-wrapper">
    <div class="iconmenu">
      <div class="nav-toggle-box">
        <div class="nav-toggle-icon">
          <i class="bi bi-list"></i>
        </div>
      </div>
      <ul class="nav nav-pills flex-column">
       
        <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboards">
          <button
            class="nav-link"
            data-bs-toggle="pill"
            data-bs-target="#pills-dashboards"
            type="button"
          >
            <i class="bi bi-house-door-fill"></i>
          </button>
        </li>
        @role('superadmin|admin')
        <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Data Master">
          <button
            class="nav-link"
            data-bs-toggle="pill"
            data-bs-target="#pills-data-master"
            type="button"
          >
            <i class="bi bi-grid-fill"></i>
          </button>
        </li>
        @endrole
        @role('superadmin|admin')
        <li  class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Menu Utama">
          <button
            class="nav-link"
            data-bs-toggle="pill"
            data-bs-target="#pills-data-main"
            type="button"
          >
            <i class="bi bi-blockquote-right"></i>
          </button>
        </li>
        @endrole
        
        <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Akun">
          <button
            class="nav-link"
            data-bs-toggle="pill"
            data-bs-target="#pills-akun"
            type="button"
          >
            <i class="bx bx-user-circle font-22"></i>
          </button>
        </li>
      </ul>
    </div>
    <div class="textmenu">
      <div class="brand-logo" style="filter: none !important;">
        <img src="{{ asset('/images/logo.png') }}" width="110" alt />
      </div>
      <div class="tab-content">
        <div class="tab-pane fade" id="pills-dashboards">
          <div class="list-group list-group-flush">
            <div class="list-group-item">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-0">Dashboards</h5>
              </div>
              <small class="mb-0">Halaman Utama Aplikasi</small>
            </div>
            <a href="{{ route('dashboard') }}" class="list-group-item">
              <i class="bi bi-house"></i> Dashboard
            </a>            
          </div>
        </div>

        @role('superadmin|admin')
        <div  class="tab-pane fade" id="pills-data-master">
          <div class="list-group list-group-flush">
            <div class="list-group-item">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-0">Master</h5>
              </div>
              <small class="mb-0">Data Master Aplikasi</small>
            </div>
          
            <a href="{{ route('user.index') }}" class="list-group-item">
              <i class="lni lni-users"></i> Users
            </a>
            
          </div>
        </div>
        @endrole

        <div class="tab-pane fade" id="pills-data-main">
          <div class="list-group list-group-flush">
            <div class="list-group-item">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-0">Main Menu</h5>
              </div>
              <small class="mb-0">Menu Utama Aplikasi</small>
            </div>
            <a href="'test'" class="list-group-item">
              <i class="lni lni-comments-alt"></i> Test Menu
            </a>
            
          </div>
        </div>

        <div class="tab-pane fade" id="pills-akun">
          <div class="list-group list-group-flush">
            <div class="list-group-item">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-0">Akun</h5>
              </div>
              <small class="mb-0">Akun Login Anda</small>
            </div>
            <a href="{{ route('akun.index') }}" class="list-group-item">
              <i class="lni lni-cog"></i> Pengaturan
            </a>
            <form method="POST" action="{{ route('logout') }}">
            @csrf
                <a class="list-group-item" href="{{ route('logout') }}" method="post" as="button" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="bx bx-power-off"></i> Keluar
                </a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </aside>