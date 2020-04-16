@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					<h3 class="lead-title">Viewing: {{$boat->name}}</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Name</label>
						<label class="form-control col-8">{{$boat->name}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Model</label>
						<label class="form-control col-8">{{$boat->modele}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Length</label>
						<label class="form-control col-8">{{$boat->length}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Width</label>
						<label class="form-control col-8">{{$boat->width}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Date Construction</label>
						<label class="form-control col-8">{{$boat->date_construction}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Registration Number</label>
						<label class="form-control col-8">{{$boat->registration_nb}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Max Number Places</label>
						<label class="form-control col-8">{{$boat->max_nb_places}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Category</label>
						<label class="form-control col-8">{{$category->name}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Is Valid</label>
						@if($boat->valid)
							<div class="col">
								<img border="0" src="/boat/resources/images/valid.png" height="30">
							</div>
						@else
							<div class="col">
								<img border="0" src="/boat/resources/images/invalid.png" width="30" height="30">
							</div>
						@endif
					</div>
					<div class="form-group row text-center">
						<div class="col">
							<a class="btn btn-primary" href="{{ route('boat.edit', $boat->id) }}"><i class='fa fa-edit'></i> Edit</a>
						</div>
						<div class="col">
								<a class="btn btn-primary" href="{{ route('boat.index') }}"><i class='fa fa-arrow-left'></i> Go back to Boat List</a>
						</div>
					</div>
                </div>
				<div class="card-header">
					<h3 class="lead-title">List of Motors</h3>
				</div>
				<div class="card-header text-center">
					<div class="row lead">
						<div class="col">Name</div>
						<div class="col">View</div>
						<div class="col">Edit</div>
						<div class="col">Delete</div>
					</div>
				</div>
				<div class="card-body text-center">
					@foreach($moteurs as $moteur)
						<div class="row">
							<label class="col mt-2 lead-text">{{$moteur->name}}</label>
							<div class="col">
								<a class="btn btn-success" href="{{ route('moteur.show', $moteur->id) }}"><i class='fa fa-eye'></i> View</a>
							</div>
							<div class="col">
								<a class="btn btn-warning" href="{{ route('moteur.edit', $moteur->id) }}"><i class='fa fa-edit'></i> Edit</a>
							</div>
							<div class="col">
								{{ Form::open([ 'method'  => 'delete', 'route' => [ 'moteur.destroy', $moteur->id ] ]) }}
									{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Delete', ['class' => 'btn btn-danger', 'type' => 'submit']) }}
								{{ Form::close() }}
							</div>
						</div>
						<br>
					@endforeach
				</div>
				<div class="card-header">
					<h3 class="lead-title">List of Equipments</h3>
				</div>
				<div class="card-header text-center">
					<div class="row lead">
						<div class="col">Name</div>
						<div class="col">View</div>
						<div class="col">Edit</div>
						<div class="col">Delete</div>
					</div>
				</div>
				<div class="card-body text-center">
					@foreach($equipements as $equipement)
						<div class="row">
							<label class="col mt-2 lead-text">{{$equipement->name}}</label>
							<div class="col">
								<a class="btn btn-success" href="{{ route('equipement.show', $equipement->id) }}"><i class='fa fa-eye'></i> View</a>
							</div>
							<div class="col">
								<a class="btn btn-warning" href="{{ route('equipement.edit', $equipement->id) }}"><i class='fa fa-edit'></i> Edit</a>
							</div>
							<div class="col">
								{{ Form::open([ 'method'  => 'delete', 'route' => [ 'equipement.destroy', $equipement->id ] ]) }}
									{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Delete', ['class' => 'btn btn-danger', 'type' => 'submit']) }}
								{{ Form::close() }}
							</div>
						</div>
						<br>
					@endforeach
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
