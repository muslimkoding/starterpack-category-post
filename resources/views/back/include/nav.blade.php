<header class="header header-sticky p-0 mb-4">
    <div class="container-fluid px-4 border-bottom">
      <button class="header-toggler" type="button"
        onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"
        style="margin-inline-start: -14px">
        <div class="icon icon-lg">
          <i class="fa-solid fa-bars"></i>
        </div>
      </button>
      <ul class="header-nav d-none d-md-flex ms-auto">

      </ul>
      <ul class="header-nav ms-auto ms-md-0">
        <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#"
            role="button" aria-haspopup="true" aria-expanded="false">
            {{-- <div class="avatar avatar-md">
                @if (Auth::user()->photo != '')
                <img class="avatar-img" src="{{ asset('storage/back/user/'.Auth::user()->photo) }}" alt="">
                @else
                <img class="avatar-img" src="{{ asset('storage/images/default.png') }}" alt="">    
                @endif
            </div> --}}
            <div class="rounded-circle overflow-hidden" style="width: 40px; height: 40px;">
              {{-- @if (Auth::user()->photo != '')
                <img class="h-100 w-100 object-fit-cover" src="{{ asset('storage/back/user/' . Auth::user()->photo) }}"
                  alt="User photo">
              @else --}}
                <img class="h-100 w-100 object-fit-cover" src="{{ asset('storage/images/default.png') }}"
                  alt="Default photo">
              {{-- @endif --}}
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end pt-0">
            <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2"
              data-coreui-i18n="account">Account</div>
            <a class="dropdown-item" href="#user_profile">
              <div class="icon me-2">
                <i class="fa-solid fa-user-gear"></i>

              </div><span>Darul</span>
            </a>

            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#logout"
              onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
              <div class="icon me-2">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
              </div><span data-coreui-i18n="logout">Logout</span>
            </a>
            <form id="logout-form" action="#logout" method="POST" class="d-none">
              @csrf
            </form>

          </div>
        </li>
      </ul>
    </div>
    @yield('breadcrumb')
  </header>
