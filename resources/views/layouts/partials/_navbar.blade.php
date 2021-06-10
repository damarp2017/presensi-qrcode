<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                Account&ensp;<i class="far fa-bell"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">Your Account</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">Profiles</a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer"
                        onclick="event.preventDefault(); this.closest('form').submit();"> {{ __('Log Out') }}
                    </a>
                </form>
                {{-- <a href="#" class="dropdown-item dropdown-footer">Logout</a> --}}
            </div>
        </li>
    </ul>
</nav>