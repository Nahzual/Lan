@extends('layouts.dashboard')

@section('title')
Editing Shopping : {!!$material->name_material!!}
@endsection

@section('page-title')
Editing Shopping
@endsection

@section('content')
<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

{!! Form::model($shopping, ['method' => 'put', 'onsubmit' => 'return sendRequest(event,'.$lan->id.','.$shopping->id.')']) !!}
	<div>
		<div class="form-group">
			{!! Form::label('cost_shopping', 'Price', ['class' => 'display-6']) !!}
			{!! Form::number('cost_shopping', null, ['step'=>'0.01','min'=>'0','class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('quantity_shopping', 'Quantity', ['class' => 'display-6']) !!}
			{!! Form::number('quantity_shopping', null, ['min'=>'0','class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn btn-outline-warning shadow-sm"><i class='fa fa-edit'></i> Update</button>
		</div>
		<div class="col">
			<a class="btn btn-outline-info shadow-sm" href="{{ route('lan.show', $lan) }}"><i class='fa fa-arrow-left'></i> Go Back to Lan</a>
		</div>
	</div>
{!! Form::close() !!}
@endsection

@section('js_includes')
<script src="/js/ajax/shopping/ajax_edit.js"></script>
@endsection
