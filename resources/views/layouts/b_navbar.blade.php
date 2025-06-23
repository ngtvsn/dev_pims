<nav class="main-header navbar navbar-expand navbar-dark navbar-success">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <!-- <img src="https://assets.infyom.com/logo/blue_logo_150x150.png"
                    class="user-image img-circle elevation-2" alt="User Image"> -->
                <i class="nav-icon fas fa-user"></i>
                <!-- <span class="d-none d-md-inline">{{ Auth::user()->last_name.', '.Auth::user()->first_name }}</span> -->
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-body">
                    <!-- <img src="https://assets.infyom.com/logo/blue_logo_150x150.png"
                        class="img-circle elevation-2" alt="User Image"> -->
                    <p>
                        {{ Auth::user()->last_name.', '.Auth::user()->first_name }}
                        <br><small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="#" class="btn btn-default btn-flat"><i class="nav-icon fas fa-user mr-2"></i>Profile</a>
                    <a href="#" class="btn btn-default btn-flat float-right" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="nav-icon fas fa-sign-out-alt mr-1"></i> 
                       Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>