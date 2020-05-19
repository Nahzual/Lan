@extends('layouts.dashboard')

@section('title')
{{ __('messages.edit_activity') }} : {!!$activity->name!!}
@endsection

@section('page-title')
{{ __('messages.edit_activity') }}
@endsection

@section('content')

<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

{!! Form::model($activity, ['method' => 'put', 'onsubmit' => 'return sendRequest(event,'.$lan->id.','.$activity->id.')']) !!}
	<div>
		<div class="form-group">
			{!! Form::label('name_activity', {{ __('messages.name') }}, ['class' => 'display-6']) !!}
			{!! Form::text('name_activity', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('desc_activity', {{ __('messages.description') }}, ['class' => 'display-6']) !!}
			{!! Form::textarea('desc_activity', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn btn-outline-warning shadow-sm"><i class='fa fa-edit'></i> {{ __('messages.update') }}</button>
		</div>
		<div class="col">
			<a class="btn btn-outline-info shadow-sm" href="{{ route('lan.show', $lan) }}"><i class='fa fa-arrow-left'></i> {{ __('messages.back_lan') }}</a>
		</div>
	</div>
{!! Form::close() !!}
@endsection

@section('js_includes')
<script src="/js/ajax/activity/ajax_edit.js"></script>
@endsection
