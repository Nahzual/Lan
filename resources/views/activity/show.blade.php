@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					<h3 class="lead-title">Viewing : {{$activity->name_activity}}</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Name</label>
						<label class="form-control col-8">{{$activity->name_activity}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Description</label>
						<label class="form-control col-8">{{$activity->desc_activity}}</label>
					</div>
					<div class="form-group row text-center">
						<div class="col">
							<a class="btn btn-primary" href="{{ route('activity.edit', $lan->id) }}"><i class='fa fa-edit'></i> Edit</a>
						</div>
						<div class="col">
							<a class="btn btn-primary" href="{{ route('activity.index') }}"><i class='fa fa-arrow-left'></i> Go back to Lan List</a>
						</div>
					</div>
                </div>
			</div>
        </div>
    </div>
</div>
@endsection
