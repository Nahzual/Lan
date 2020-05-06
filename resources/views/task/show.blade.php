@extends('layouts.dashboard')

@section('content')
      <div class="card">
        <div class="card-header">
					<h3 class="">Viewing task "{{$task->name_task}}" of LAN {{$lan->name}}</h3>
				</div>

				<div class="card-body">
					<div class="row">
						<label class=" col-3 mt-1 text-center">Task</label>
						<label class="form-control col-8">{{$task->name_task}}</label>
					</div>
					<div class="row">
						<label class=" col-3 mt-1 text-center">Description of the task</label>
						<label class="form-control col-8">{{$task->desc_task}}</label>
					</div>

					<div class="row">
						<label class=" col-3 mt-1 text-center">Deadline</label>
						<label class="form-control col-8">{{date_format(date_create($task->deadline_task),config('display.DATE_FORMAT'))}}</label>
					</div>

					<div class="form-group row text-center">
						<div class="col">
							<a class="btn btn-primary" href="{{ route('task.edit',[$lan->id,$task->id]) }}"><i class='fa fa-edit'></i> Edit</a>
						</div>
						<div class="col">
								<a class="btn btn-primary" href="{{ route('task.all') }}"><i class='fa fa-arrow-left'></i> Go to your tasklist</a>
						</div>
					</div>
        </div>
			</div>

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
							<table class="table card-table table-bordered box_shadow">
								<thead class="text-center">
									<th scope="col">#</th>
									<th scope="col">Name</th>
									<th scope="col">Username</th>
									<th scope="col">Actions</th>
								</thead>

								<tbody>
									@foreach($users as $user)
									<tr>
										<th class="text-center">{{$user->id}}</th>
										<td class="text-center">{{$user->name.' '.$user->lastname}}</td>
										<td class="text-center">{{$user->pseudo}}</td>
										<td class="text-center">
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
