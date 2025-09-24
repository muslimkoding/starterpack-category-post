<div class="sidebar sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header border-bottom">
      <div class="sidebar-brand">
        <div class="sidebar-brand-full" width="110" height="32" alt="CoreUI Logo">
          <img src="{{ asset('storage/images/logo upg injourney.png') }}" class="" height="32">
        </div>
        <div class="sidebar-brand-narrow" width="32" height="32" alt="CoreUI Logo">
          <img src="{{ asset('storage/images/logo upg injourney.png') }}" class="" height="18">
        </div>
      </div>
      <button class="btn-close d-lg-none" type="button" aria-label="Close"
        onclick="coreui.Sidebar.getInstance(document.querySelector(&quot;#sidebar&quot;)).toggle()"></button>
    </div>
    <ul class="sidebar-nav" data-simplebar="">
      <li class="nav-item"><a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}"
          href="{{ route('dashboard') }}">
          <div class="nav-icon">
            <i class="fa-solid fa-gauge"></i>
          </div><span>Dashboard</span>
        </a></li>
      <li class="nav-title">Operation</li>
     
        <li class="nav-item"><a class="nav-link {{ Route::is('category.index') ? 'active' : '' }} {{ Request::is('admin/category/*') ? 'active' : '' }}"
            href="{{ route('category.index') }}">
            <div class="nav-icon">
              <i class="fa-solid fa-arrows-down-to-people"></i>
            </div><span>Category</span>
          </a></li>
        {{-- <li class="nav-item"><a class="nav-link {{ Request::is('category/*') ? 'active' : '' }}"
            href="{{ route('category.index') }}">
            <div class="nav-icon">
              <i class="fa-solid fa-arrows-down-to-people"></i>
            </div><span>Category</span>
          </a></li> --}}

        <li class="nav-item"><a class="nav-link {{ Route::is('post.index') ? 'active' : '' }} {{ Request::is('admin/post/*') ? 'active' : '' }}"
            href="{{ route('post.index') }}">
            <div class="nav-icon">
              <i class="fa-solid fa-image"></i>
            </div><span>Posts</span>
          </a></li>


  {{-- <li class="nav-divider"></li> --}}

    </ul>
    {{-- <div class="sidebar-footer border-top d-none d-lg-flex">
      <button class="sidebar-toggler" type="button"></button>
    </div> --}}
  </div>
