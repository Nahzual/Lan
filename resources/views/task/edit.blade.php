@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
					<div class="row">
						<div class="col mt-2">
							<h3 class="lead-title">Editing Task : {{$task->name_task}}</h3>
						</div>
					</div>
				</div>

				<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
				<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

				<div class="card-body">
					{!! Form::model($task, ['method' => 'put', 'onsubmit' => 'return sendRequest(event,'.$lan->id.','.$task->id.')']) !!}
						<div class="bg-light">
							<div class="form-group">
								{!! Form::label('name_task', 'Name', ['class' => 'lead']) !!}
								{!! Form::text('name_task', null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('desc_task', 'Description of the task', ['class' => 'lead']) !!}
								{!! Form::text('desc_task', null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('deadline_task', 'Deadline of the task', ['class' => 'lead']) !!}
								{!! Form::date('deadline_task', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group row text-center">
							<div class="col">
								<button type="submit" class="btn btn-primary"><i class='fa fa-edit'></i> Update</button>
							</div>
							<div class="col">
								<a class="btn btn-primary" href="{{ route('task.all') }}"><i class='fa fa-arrow-left'></i> To your tasklist</a>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js_includes')
<script src="/js/ajax/task/ajax_edit.js"></script>
@endsection
