@extends('layouts.app')

@section('content')

$lan


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
						<div class="col">Price</div>
						<div class="col">Quantity</div>
						<div class="col">View</div>
						<div class="col">Edit</div>
						<div class="col">Add</div>
						<div class="col">Remove</div>
						<div class="col">Delete</div>
					</div>
				</div>

				<div class="card-body text-center">
					@foreach($materials as $material)
					<div class="row">
						<div class="col mt-2 lead-text">{{$lan->id}}</div>
						<div class="col mt-2 lead-text">{{$lan->name}}</div>
						<div class="col mt-2 lead-text">1/{{$lan->max_num_registrants}}</div>
						<?php if($lan->waiting_lan==1){ ?>
						<div class="col mt-2 lead-text"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
						<?php }else if($lan->waiting_lan==0){ ?>
						<div class="col mt-2 lead-text"><i class="fa fa-check success" aria-hidden="true"></i></div>
						<?php }else{?>
						<div class="col mt-2 lead-text"><i class="fa fa-times danger" aria-hidden="true"></i></div>
						<?php } ?>
						<div class="col">
							<a class="btn btn-success" href="{{ route('material.show', $material->id) }}"><i class='fa fa-eye'></i> View</a>
						</div>
						<div class="col">
							<a class="btn btn-warning" href="{{ route('material.edit', $material->id) }}"><i class='fa fa-edit'></i> Edit</a>
						</div>
						<div class="col">
							<a class="btn btn-success" href="{{ route('material.show', $material->id) }}"><i class='fa fa-eye'></i>add</a>
						</div>
						<div class="col">
							<a class="btn btn-success" href="{{ route('material.show', $material->id) }}"><i class='fa fa-eye'></i>remove</a>
						</div>
						<div class="col">
							{{ Form::open([ 'method'  => 'delete', 'route' => [ 'material.destroy', $material->id ] ]) }}
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
