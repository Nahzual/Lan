@extends('layouts.dashboard')

@section('title')
Creating new Material
@endsection

@section('page-title')
Creating new Material
@endsection


@section('content')
<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

{!! Form::open(['method' => 'post', 'onsubmit'=>'return sendRequest(event);']) !!}
	<div class="bg-light">
		<div class="form-group">
			{!! Form::label('name_material', 'Name') !!}
			{!! Form::text('name_material', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('desc_material', 'Description of the material') !!}
			{!! Form::text('desc_material', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('category_material', 'Category of the material') !!}
			<small class="d-block">You can enter several categories by spacing them out with a delimiter of your choice (comma, white space...)</small>
			{!! Form::text('category_material', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn btn-outline-success"><i class='fa fa-plus-square'></i> Add</button>
		</div>

		<div class="col">
			<a class="btn btn-outline-primary" href="{{ route('dashboard.admin') }}"><i class='fa fa-arrow-left'></i> Go back to dashboard</a>
		</div>
	</div>
{!! Form::close() !!}

<script type="text/javascript" src="/js/ajax/material/ajax_create.js" defer></script>
@endsection
