@extends('layouts.dashboard')

@section('content')
      <div class="card">
        <div class="card-header">
					<h3 >Viewing : {{$activity->name_activity}}</h3>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label class="display-6">Name</label>
						<label class="form-control">{{$activity->name_activity}}</label>
					</div>
					<div class="form-group">
						<label class="display-6">Description</label>
						<textarea class="form-control">{{$activity->desc_activity}}</textarea>
					</div>
					<div class="form-group row text-center">
						@if(isset($userIsLanAdmin) && $userIsLanAdmin)
						<div class="col">
							<a class="btn btn-outline-warning shadow-sm" href="{{ route('activity.edit', array('lan' => $lan->id, 'activity' => $activity->id)) }}"><i class='fa fa-edit'></i> Edit</a>
						</div>
						@endif
						<div class="col">
							<a class="btn btn-outline-info shadow-sm" href="{{ route('lan.show', $lan) }}"><i class='fa fa-arrow-left'></i> Go back to Lan</a>
						</div>
					</div>
        </div>
			</div>
@endsection
