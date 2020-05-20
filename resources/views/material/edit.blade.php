@extends('layouts.dashboard')

@section('title')
{{ __('messages.edit_material') }} : {!! $material->name_material !!}
@endsection

@section('page-title')
{{ __('messages.edit_material') }}
@endsection



@section('content')
<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

{!! Form::model($material, ['method' => 'put', 'onsubmit' => 'return sendRequest(event,'.$material->id.')']) !!}
	<div>
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
			{!! Form::text('category_material', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn btn-primary"><i class='fa fa-edit'></i> {{ __('messages.update') }}</button>
		</div>
		<div class="col">
			<a class="btn btn-primary" href="{{ route('dashboard.admin') }}"><i class='fa fa-arrow-left'></i> {{ __('messages.back_dashboard') }}</a>
		</div>
	</div>
{!! Form::close() !!}
@endsection

@section('js_includes')
<script src="/js/ajax/material/ajax_edit.js"></script>
@endsection
