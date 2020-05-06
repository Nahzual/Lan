@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					<h3 class="lead-title">Viewing : {{$task->name_task}}</h3>
				</div>

				<div class="card-body">
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Task</label>
						<label class="form-control col-8">{{$task->name_task}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Description of the task</label>
						<label class="form-control col-8">{{$task->desc_task}}</label>
					</div>

					<div class="row">
						<label class="lead col-3 mt-1 text-center">Deadline</label>
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
        </div>
    </div>
</div>
@endsection
