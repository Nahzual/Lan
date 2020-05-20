@extends('layouts.dashboard')

@section('title')
{{ __('messages.editing_task') }} : {!!$task->name_task!!}
@endsection

@section('page-title')
{{ __('messages.editing_task') }}
@endsection

@section('content')
<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

{!! Form::model($task, ['method' => 'put', 'onsubmit' => 'return sendRequest(event,'.$lan->id.','.$task->id.')']) !!}
	<div >
		<div class="form-group">
			{!! Form::label('name_task', __('messages.name'), ['class' => '']) !!}
			{!! Form::text('name_task', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('desc_task', __('messages.description'), ['class' => '']) !!}
			{!! Form::text('desc_task', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('deadline_task', __('messages.deadline'), ['class' => '']) !!}
			{!! Form::date('deadline_task', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn btn-outline-warning shadow-sm"><i class='fa fa-edit'></i> {{ __('messages.update') }}</button>
		</div>
		<div class="col">
			<a class="btn btn-outline-info shadow-sm" href="{{ route('task.all') }}"><i class='fa fa-arrow-left'></i> {{ __('messages.back_tasklist') }} </a>
		</div>
	</div>
{!! Form::close() !!}
@endsection

@section('js_includes')
<script src="/js/ajax/task/ajax_edit.js"></script>
@endsection
