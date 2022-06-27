<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
    <!-- Authentication Links -->
    @guest
    @else
    <li data-step="1" data-intro="Silahkan lengkapi data pribadi terlebih dahulu di Menu Profile!" class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <figure class="avatar mr-2 avatar-sm">
            @if(!empty(Auth::user()->profile->avatar))
            <img src="{{ url('storage/users/'.Auth::user()->profile->avatar) }}" alt="image">
            @else
            <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="image">
            @endif
            @if(Auth::user()->isOnline())
            <i class="avatar-presence online"></i>
            @else
            <i class="avatar-presence offline"></i>
            @endif
        </figure>
        <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>
        <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-title">Anda sedang
            @if(Auth::user()->isOnline())
            <i class="avatar-presence online"></i>
                Online
            @else
            <i class="avatar-presence offline"></i>
                Offline
            @endif
        </div>
          <a href="{{ route('profiles.index') }}" class="dropdown-item has-icon">
            <i class="far fa-user"></i> Profile
          </a>
        <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
                <i class="fas fa-sign-out-alt"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
    @endguest
    </ul>
  </nav>
