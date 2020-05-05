<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard - LAN Creator</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Styles -->
    @yield('css_includes')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">	
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('/') }}/css/dashboard-styles.css" rel="stylesheet" />

</head>

    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('dashboard') }}">LAN Creator</a>

            <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('user.edit',Auth::id()) }}" onclick="event.preventDefault();
                                                     document.getElementById('edit-profile-form').submit();"><i class="fa fa-wrench"></i> Settings</a>
			
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                    <form id="edit-profile-form" action="{{ route('user.edit',Auth::id()) }}" method="GET" style="display: none;">
                                        @csrf
                                    </form>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Navigation</div>
                            <a class="nav-link" href="{{ route('dashboard') }}"
                                ><div class="sb-nav-link-icon"><i class="fa fa-tachometer"></i></div>
                               Dashboard</a
                            >
                            <a class="nav-link" href="{{ route('home') }}"
                                ><div class="sb-nav-link-icon"><i class="fa fa-home"></i></div>
                               Home</a
                            >
                            <div class="sb-sidenav-menu-heading">LAN</div>
                            <a class="nav-link" href="{{ url('/lans') }}">My LANs</a>
                            <a class="nav-link" href="{{ route('task.all') }}">My Tasks</a>
			    <div class="sb-sidenav-menu-heading">Games</div>
                            <a class="nav-link" href="{{ url('/game') }}">All games</a>
                            <a class="nav-link" href="{{ route('game.favourite') }}">My games</a>
			    @if(Auth::user()->rank_user > 0)
			    <div class="sb-sidenav-menu-heading">ADM</div>
                            <a class="nav-link" href="{{ url('/users') }}">All Users</a>
                            <a class="nav-link" href="{{ route('all_lans') }}">All LANs</a>
			    <a class="nav-link" href="{{ route('task.all') }}">All Tournaments</a>
			    @endif
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{Auth::user()->name}} {{Auth::user()->lastname}}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
          <!-- Success message -->
          <div class="container alert alert-dismissible alert-success show mt-2" style="<?php  echo (!session('success')) ? 'display:none' : ''; ?>" role="alert">
            <?php echo (session('success')) ? session('success') : ''; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <!-- Error message -->
          <div class="container alert alert-dismissible alert-danger show mt-2" style="<?php  echo (!session('error')) ? 'display:none' : ''; ?>" role="alert">
            <?php echo (session('error')) ? session('error') : ''; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          @yield('content')
        </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; LAN Creator 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
	@yield('js_includes')
	 <script src="js/dashboard-scripts.js"></script>
    </body>
</html>
