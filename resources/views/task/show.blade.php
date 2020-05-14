@extends('layouts.dashboard')

@section('title')
Viewing task "{!!$task->name_task!!}" of LAN {!!$lan->name!!}
@endsection

@section('page-title')
Task page
@endsection

@section('content')
<div class="row">
	<label class=" col-3 mt-1 text-center">Task</label>
	<label class="form-control col-8">{!!$task->name_task!!}</label>
</div>
<div class="row">
	<label class=" col-3 mt-1 text-center">Description of the task</label>
	<label class="form-control col-8">{!!$task->desc_task!!}</label>
</div>

<div class="row">
	<label class=" col-3 mt-1 text-center">Deadline</label>
	<label class="form-control col-8">{{date_format(date_create($task->deadline_task),config('display.DATE_FORMAT'))}}</label>
</div>

<div class="form-group row text-center">
	<div class="col">
		<a class="btn btn-primary" href="{{ route('task.edit',[$lan->id,$task->id]) }}"><i class='fa fa-edit'></i> Edit</a>
	</div>
	@if($userIsLanAdmin)
	<div class="col">
		<form method="GET" action="{{ route('task.add_helper',[$lan->id,$task->id]) }}">
			@csrf
			<button type="submit" class="btn btn-primary"><i class='fa fa-plus-square'></i> Assign to an helper</button>
		</form>
	</div>
	<div class="col">
		{!! Form::open(['method'=>'DELETE','onsubmit'=>'return deleteShow(event,'.$lan->id.','.$task->id.')']) !!}
		@csrf
		<button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> Delete</button>
		{{ Form::close() }}
	</div>
	@endif
	<div class="col">
		<a class="btn btn-primary" href="{{ route('task.all') }}"><i class='fa fa-arrow-left'></i> Go to your tasklist</a>
	</div>
</div>

<div id="response-success" class="container alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="container alert alert-danger mt-2" style="display:none"></div>

<div class="card mt-5">
	<div class="card-header">
		<div class="row">
			<div class="col mt-1">
				<h3 class="">Helpers in charge of this task :</h3>
			</div>
			<div class="col mt-1">
				<button class="btn btn-outline-dark shadow-sm float-right" data-toggle="collapse" data-target="#task-helpers" aria-expanded="false" aria-controls="task-helpers">Show/hide</button>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="table-responsive esp collapse" id="task-helpers">
				<table class="table card-table table-bordered box_shadow text-center">
					<thead>
						<th scope="col">#</th>
						<th scope="col">Name</th>
						<th scope="col">Username</th>
						@if($userIsLanAdmin) <th scope="col">Actions</th> @endif
					</thead>

					<tbody>
						@if(count($users)==0)
						<tr>
							<td colspan="{{ $userIsLanAdmin ? 4 : 3 }}"><h3>No helpers to show</h3></td>
						</tr>
						@endif
						@foreach($users as $user)
						<tr id="task-helper-{{$user->id}}">
							<th class="text-center">{{$user->id}}</th>
							<td class="text-center">{!!$user->name.' '.$user->lastname!!}</td>
							<td class="text-center">{!!$user->pseudo!!}</td>
							@if($userIsLanAdmin)
							<td class="text-center">
								{!! Form::open(['method' => 'delete', 'onsubmit' => 'return unassign(event,'.$lan->id.','.$task->id.','.$user->id.')']) !!}
								{{ Form::button('<i class="fa fa-times" aria-hidden="true"></i> Unassign', ['class' => 'btn btn-warning', 'type' => 'submit']) }}
								{{ Form::close() }}
							</td>
							@endif
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js_includes')
<script src="/js/ajax/task/ajax_add_helper.js"></script>
<script src="/js/ajax/task/ajax_delete.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
