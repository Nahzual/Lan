<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title') - {{ __('messages.lan_creator') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue" rel="stylesheet">

    <!-- Styles -->
    @yield('css_includes')
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="{{ url('/img/favicon/favicon.png') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @if(Auth::user()->theme == 0)
    <link href="{{ url('/') }}/css/dashboard-styles.css" rel="stylesheet" />
    @else
	@if(Auth::user()->theme == 1)
		<link href="{{ url('/') }}/css/dashboard-styles-dark.css" rel="stylesheet" />
	@else
		@if(Auth::user()->theme != 3)
		<link href="{{ url('/') }}/css/dashboard-styles-darkblue.css" rel="stylesheet" />
		@else
		<link href="https://fonts.googleapis.com/css?family=Happy+Monkey" rel="stylesheet">
		<link href="{{ url('/') }}/css/dashboard-styles-s.css" rel="stylesheet" />
		@endif
	@endif
    @endif

</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
		<button type="button" id="sidebarToggle" class="btn  @if(Auth::user()->theme == 0) btn-info  @else
	@if(Auth::user()->theme == 1) btn-primary @else btn-info @endif @endif ml-2">
			<i class="fa fa-align-left"></i>
		</button>
    <a class="navbar-brand title-bebas bebas-size-1" href="{{ route('dashboard') }}">{{ __('messages.lan_creator') }}</a>

    <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i></a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
					<a class="dropdown-item" href="{{ route('user.updateTheme', $logged_user->id) }}"><i class="fa fa-paint-brush"></i> {{ __('messages.chtheme') }}</a>
          <a class="dropdown-item" href="{{ route('user.edit',$logged_user->id) }}" onclick="event.preventDefault(); document.getElementById('edit-profile-form').submit();"><i class="fa fa-wrench"></i> {{ __('messages.settings') }}</a>
					<a class="dropdown-item" href="{{ route('user.confirmDestroy',$logged_user->id) }}"><i class="fa fa-trash"></i> {{ __('messages.delete_account') }}</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="{{ route('user.updateLanguage', $logged_user->id) }}"><i class="fa fa-language"></i>{{ __('messages.chln') }}</a>


          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> {{ __('messages.logout') }}</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>

          <form id="edit-profile-form" action="{{ route('user.edit',$logged_user->id) }}" method="GET" style="display: none;">
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
            <div class="sb-sidenav-menu-heading">{{ __('messages.navigation') }}</div>
            <a class="nav-link" href="{{ route('dashboard') }}"><div class="sb-nav-link-icon"><i class="fa fa-tachometer"></i></div>{{ __('messages.dashboard') }}</a>
            <a class="nav-link" href="{{ route('home') }}"><div class="sb-nav-link-icon"><i class="fa fa-home"></i></div>{{ __('messages.home') }}</a>

						<div class="sb-sidenav-menu-heading">{{ __('messages.lan') }}</div>
						<a class="nav-link" href="{{ route('all_lans') }}">{{ __('messages.all_lans') }}</a>
            <a class="nav-link" href="{{ route('task.all') }}">{{ __('messages.my_tasks') }}</a>

						<div class="sb-sidenav-menu-heading">{{ __('messages.games') }}</div>
            <a class="nav-link" href="{{ url('/game') }}"><div class="sb-nav-link-icon"><i class="fa fa-list"></i></div>{{ __('messages.all_games') }}</a>
            <a class="nav-link" href="{{ route('game.favourite') }}"><div class="sb-nav-link-icon"><i class="fa fa-heart"></i></div>{{ __('messages.my_games') }}</a>

						@if($logged_user->isSiteAdmin())
			    	<div class="sb-sidenav-menu-heading">{{ __('messages.admin') }}</div>
						<a class="nav-link" href="{{ url('/dashboard/admin') }}">{{ __('messages.admin_dashboard') }}</a>
						<a class="nav-link" href="{{ url('/adm/users') }}"><div class="sb-nav-link-icon"><i class="fa fa-users"></i></div>{{ __('messages.all_users') }}</a>
			    	<a class="nav-link" href="{{ route('admin.tournaments') }}">{{ __('messages.all_tournaments') }}</a>
						<a class="nav-link" href="{{ url('/adm/materials') }}"><div class="sb-nav-link-icon"><i class="fa fa-cutlery"></i></div>{{ __('messages.all_materials') }}</a>
			    	@endif
          </div>
        </div>
      	<div class="sb-sidenav-footer">
          <div class="small">{{ __('messages.logged_as') }}</div>
          {!!$logged_user->name!!} {!!$logged_user->lastname!!}
        </div>
      </nav>
    </div>

		<div id="layoutSidenav_content">
      <main>

				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col">
								<h2>@yield('title')</h2>
							</div>
							@yield('title-buttons')
						</div>
					</div>

					@yield('toolbar')
					<div class="card-body">

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
					</div>
				</div>
@if(Auth::user()->theme == 3)
  <audio autoplay loop>
	<source src="http://angom8.net/dl/media/megalovania.mp3" type="audio/mpeg">
       comic sans
    </audio>
@endif
      </main>
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; LAN Creator 2020</div>
            <div class="footerlinks">
              <a href="{{ url('/privacy') }}">Privacy Policy</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

	@yield('js_includes')
	<script src="{{ asset('js/dashboard-scripts.js') }}" defer></script>
</body>
</html>
