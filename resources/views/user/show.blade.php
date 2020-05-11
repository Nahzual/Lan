@extends('layouts.dashboard')

@section('content')
      <div class="card">
        <div class="card-header">
					<h3>Viewing user : {{$user->pseudo}}</h3>
				</div>

				<div class="card-body">
					<div class="row d-flex justify-content-center">
						<label class="col-md-2 col-form-label text-md-right">Name</label>
						<label class="h-100 form-control col-8">{{$user->lastname.' '.$user->name}}</label>
					</div>
					<div class="row d-flex justify-content-center">
						<label class="col-md-2 col-form-label text-md-right">Email</label>
						<label class="h-100 form-control col-8">{{$user->email}}</label>
					</div>
					<div class="row d-flex justify-content-center">
						<label class="col-md-2 col-form-label text-md-right">Phone number</label>
						<label class="h-100 form-control col-8">{{$user->tel_user}}</label>
					</div>
					@if($loggedUserIsAdmin)
					<div class="row d-flex justify-content-center">
						<label class="col-md-2 col-form-label text-md-right">Adress</label>
						<label class="h-100 form-control col-8">{{$location->num_street.' '.$street->name_street.' '.$city->zip_city.' '.$city->name_city.', '.$department->name_department.', '.$country->name_country}} </label>
					</div>
					@endif
        </div>
			</div>
@endsection
