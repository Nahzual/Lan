@extends('layouts.dashboard')

@section('title')
{{ __('messages.create_new_material') }}
@endsection

@section('page-title')
{{ __('messages.create_new_material') }}
@endsection


@section('content')
<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

{!! Form::open(['method' => 'post', 'onsubmit'=>'return sendRequest(event);']) !!}
	<div class="form-group">
		{!! Form::label('name_material', __('messages.name')) !!}
		{!! Form::text('name_material', null, ['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('desc_material', __('messages.description')) !!}
		{!! Form::text('desc_material', null, ['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('category_material', __('messages.category')) !!}
		<small class="d-block">{{ __('messages.multiple_cat') }}</small>
		{!! Form::text('category_material', null, ['class' => 'form-control']) !!}
	</div>
	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn btn-outline-success"><i class='fa fa-plus-square'></i> {{ __('messages.add') }}</button>
		</div>

		<div class="col">
			<a class="btn btn-outline-primary" href="{{ route('dashboard.admin') }}"><i class='fa fa-arrow-left'></i> {{ __('messages.back_dashboard') }}</a>
		</div>
	</div>
{!! Form::close() !!}

<script type="text/javascript" src="/js/ajax/material/ajax_create.js" defer></script>
@endsection
