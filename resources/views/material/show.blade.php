@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					<h3 class="lead-title">Viewing : {{$material->name_material}}</h3>
				</div>
				
				<div class="card-body">
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Name</label>
						<label class="form-control col-8">{{$material->name_material}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Description of the material</label>
						<label class="form-control col-8">{{$material->desc_material}}</label>
					</div>
					
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Price</label>
						<label class="form-control col-8">{{$material->price_material}}</label>
					</div>
					
					<div class="form-group row text-center">
						<div class="col">
							<a class="btn btn-primary" href="{{ route('material.edit', $task->id) }}"><i class='fa fa-edit'></i> Edit</a>
						</div>
						<div class="col">
								<a class="btn btn-primary" href="{{ route('lan.index') }}"><i class='fa fa-arrow-left'></i> Go back to Lan List</a>
						</div>
					</div>
                </div>
			</div>
        </div>
    </div>
</div>
@endsection
