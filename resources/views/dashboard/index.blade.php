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
							<form method="GET" action="{{ route('lan.create') }}">
							@csrf
							@method('GET')
								<button type="submit" class="btn btn-primary float-right"><i class='fa fa-edit'></i> Edit My Profile</button>
							</form>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Name</label>
						<label class="form-control col-8">{{$user->name}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Last Name</label>
						<label class="form-control col-8">{{$user->lastname}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Pseudo</label>
						<label class="form-control col-8">{{$user->pseudo}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Email</label>
						<label class="form-control col-8">{{$user->email}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Tel</label>
						<label class="form-control col-8">{{$user->tel_user}}</label>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
        					<div class="row">
        						<div class="col mt-2">
        							<h3 class="lead-title">List My Lans</h3>
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
                    <div class="col">#</div>
                    <div class="col">Name</div>
                    <div class="col">Participants</div>
                    <div class="col">State</div>
                    <div class="col">View</div>
                    <div class="col">Edit</div>
                    <div class="col">Delete</div>
                  </div>
                </div>

                <div class="card-body text-center">
                  <div class="card-body text-center">
                    @each('lan.my_lans',$lans,'lan')
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
