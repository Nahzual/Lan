@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					<div class="row">
						<div class="col mt-2">
							<h3 class="lead-title">Dashboard</h3>
						</div>
						<div class="col mt-1">
							<form method="GET" action="{{ route('user.edit',$user->id) }}">
							@csrf
							@method('GET')
								<button type="submit" class="btn btn-primary float-right"><i class='fa fa-edit'></i> Edit My Profile</button>
							</form>
						</div>
					</div>
				</div>
				<div class="card-body">

          <div class="row d-flex justify-content-center">
            <label class="col-md-2 col-form-label text-md-right">Name</label>
            <label class="mx-2 form-control col-8">{{$user->name}}</label>
					</div>

          <div class="row d-flex justify-content-center">
            <label class="col-md-2 col-form-label text-md-right">Last Name</label>
            <label class="mx-2 form-control col-8">{{$user->lastname}}</label>
					</div>

          <div class="row d-flex justify-content-center">
            <label class="col-md-2 col-form-label text-md-right">Pseudo</label>
						<label class="mx-2 form-control col-8">{{$user->pseudo}}</label>
					</div>

          <div class="row d-flex justify-content-center">
            <label class="col-md-2 col-form-label text-md-right">Email</label>
						<label class="mx-2 form-control col-8">{{$user->email}}</label>
					</div>

          <div class="row d-flex justify-content-center">
            <label class="col-md-2 col-form-label text-md-right">Tel</label>
						<label class="mx-2 form-control col-8">{{$user->tel_user}}</label>
					</div>
        </div>
      </div>
    </div>
  </div>
</div>

@yield('admin_section')

<br><br>

<!-- Admin LANs -->
<div id="response-success-delete" class="container alert alert-success mt-2" style="display:none"></div>
<div id="response-error-delete" class="container alert alert-danger mt-2" style="display:none"></div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
        					<div class="row">
        						<div class="col mt-2">
        							<h3 class="lead-title">My LANs</h3>
        						</div>
        						<div class="col mt-1">
        							<form method="GET" action="{{ route('lan.create') }}">
        							@csrf
        							@method('GET')
        								<button type="submit" class="btn btn-primary float-right"><i class='fa fa-plus-square'></i> Create New Lan</button>
        							</form>
        						</div>
        					</div>
        				</div>

                <div class="card-header text-center">
                  <div class="row lead">
                    <div class="col hideOnSmallScreens">#</div>
                    <div class="col">Name</div>
                    <div class="col">Participants</div>
                    <div class="col">State</div>
                    <div class="col">View</div>
                    <div class="col hideOnSmallScreens">Edit</div>
                    <div class="col hideOnVerySmallScreens">Delete</div>
                  </div>
                </div>

                <div class="card-body text-center">
                  <div class="card-body text-center">
                    @each('lan.my_lans',$admin_lans,'lan')
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br>

<!-- Helper LANs -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
        					<div class="row">
        						<div class="col mt-2">
        							<h3 class="lead-title">LANs on which I am helper</h3>
        						</div>
        					</div>
        				</div>

                <div class="card-header text-center">
                  <div class="row lead">
                    <div class="col hideOnVerySmallScreens">#</div>
                    <div class="col">Name</div>
                    <div class="col hideOnVerySmallScreens">Participants</div>
                    <div class="col">State</div>
                    <div class="col">View</div>
                  </div>
                </div>

                <div class="card-body text-center">
                  <div class="card-body text-center">
                    @each('lan.helper_lans',$helper_lans,'lan')
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br>

<!-- Player LANs -->

<div id="response-success-player" class="container alert alert-success mt-2" style="display:none"></div>
<div id="response-error-player" class="container alert alert-danger mt-2" style="display:none"></div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
        					<div class="row">
        						<div class="col mt-2">
        							<h3 class="lead-title">LANs on which I am player</h3>
        						</div>
        					</div>
        				</div>

                <div class="card-header text-center">
                  <div class="row lead">
                    <div class="col hideOnVerySmallScreens">#</div>
                    <div class="col">Name</div>
                    <div class="col hideOnVerySmallScreens">Participants</div>
                    <div class="col hideOnVerySmallScreens">View</div>
                    <div class="col">Quit</div>
                  </div>
                </div>

                <div class="card-body text-center">
                  <div class="card-body text-center">
                    @each('lan.player_lans',$player_lans,'lan')
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js_includes')
<script src="/js/ajax/lan/ajax_participate.js"></script>
<script src="/js/ajax/lan/ajax_delete.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/dashboard/user-dashboard.css') }}" rel="stylesheet">
@endsection
