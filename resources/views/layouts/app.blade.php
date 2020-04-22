<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LAN Creator</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Lan Creator
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">LANs</a><!-- Insérer lien vers page listant les LANs-->
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">Contact</a><!-- Insérer lien vers page de contact-->
                            </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
				<li class="nav-item">
								<a class="nav-link" href="{{ route('dashboard') }}"><i class='fa fa-wrench'></i> {{ __('Dashboard') }}</a>
                            </li>
			    @if(Auth::user()->rank_user==1)

		 		<li class="nav-item">
					<a class="nav-link" href="{{ url('/') }}"><i class='fa fa-user'></i> Users</a>
                            </li>
		 		<li class="nav-item">
					<a class="nav-link" href="{{ url('/') }}"><i class='fa fa-gamepad'></i> Games</a>
                            </li>
			    @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/') }}" >
                                        My LANs
                                    </a> <!-- Insérer lien vers page listant les LANs en lien avec l'utilisateur-->
                                    <a class="dropdown-item" href="{{ url('/') }}" >
                                        <i class='fa fa-gamepad'></i> My Games
                                    </a> <!-- Insérer lien vers page listant les jeux en lien avec l'utilisateur-->
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

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
    </div>
    @yield('js_includes')
</body>
</html>
