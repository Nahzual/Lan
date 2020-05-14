@extends('layouts.dashboard')

@section('title')
Editing Task : {!!$task->name_task!!}
@endsection

@section('page-title')
Editing Task
@endsection

@section('content')
<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

{!! Form::model($task, ['method' => 'put', 'onsubmit' => 'return sendRequest(event,'.$lan->id.','.$task->id.')']) !!}
	<div >
		<div class="form-group">
			{!! Form::label('name_task', 'Name', ['class' => '']) !!}
			{!! Form::text('name_task', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('desc_task', 'Description of the task', ['class' => '']) !!}
			{!! Form::text('desc_task', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('deadline_task', 'Deadline of the task', ['class' => '']) !!}
			{!! Form::date('deadline_task', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn btn-outline-warning shadow-sm"><i class='fa fa-edit'></i> Update</button>
		</div>
		<div class="col">
			<a class="btn btn-outline-info shadow-sm" href="{{ route('task.all') }}"><i class='fa fa-arrow-left'></i> To your tasklist</a>
		</div>
	</div>
{!! Form::close() !!}
@endsection

@section('js_includes')
<script src="/js/ajax/task/ajax_edit.js"></script>
@endsection
