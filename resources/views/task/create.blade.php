@extends('layouts.dashboard')

@section('title')
LAN {!!$lan->name!!}<small>#{{$lan->id}} : {{ __('messages.create_new_task') }}
@endsection

@section('page-title')
{{ __('messages.create_new_task') }}
@endsection

@section('content')
<div id="response-success" class="alert alert-success" style="display:none"></div>
<div id="response-error" class="alert alert-danger" style="display:none"></div>

{!! Form::open(['method' => 'post', 'onsubmit'=>'return sendRequest(event,'.$lan->id.')']) !!}
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
			<button type="submit" class="btn btn-outline-success shadow-sm"><i class='fa fa-plus-square'></i> {{ __('messages.add') }}</button>
		</div>

		<div class="col">
			<a class="btn btn-outline-info shadow-sm" href="{{ route('task.all') }}"><i class='fa fa-arrow-left'></i> {{ __('messages.back_tasklist') }}</a>
		</div>
	</div>
{!! Form::close() !!}
@endsection

@section('js_includes')
<script src="/js/ajax/task/ajax_create.js" defer></script>
@endsection
