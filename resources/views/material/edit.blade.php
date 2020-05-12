@extends('layouts.dashboard')

@section('content')
<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col mt-2">
				<h3>Editing Material : {!! $material->name_material !!}</h3>
			</div>
		</div>
	</div>
	<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
	<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>
	<div class="card-body">
		{!! Form::model($material, ['method' => 'put', 'onsubmit' => 'return sendRequest(event,'.$material->id.')']) !!}
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
				{!! Form::text('category_material', null, ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group row text-center">
			<div class="col">
				<button type="submit" class="btn btn-primary"><i class='fa fa-edit'></i> Update</button>
			</div>
			<div class="col">
				<a class="btn btn-primary" href="{{ route('dashboard.admin') }}"><i class='fa fa-arrow-left'></i> Go back to dashboard</a>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection

@section('js_includes')
<script src="/js/ajax/material/ajax_edit.js"></script>
@endsection
