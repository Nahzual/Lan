@extends('layouts.dashboard')

@section('title')
{{$lan->name}} : {{ __('messages.create_new_shopping') }}
@endsection

@section('page-title')
{{ __('messages.create_new_shopping') }}
@endsection

@section('content')
<div id="response-success" class ="alert alert-success" style="display:none"></div>
<div id="response-error" class ="alert alert-danger" style="display:none"></div>

{!! Form::open(['method' => 'put', 'onsubmit'=>'return sendRequest(event,'.$lan->id.')']) !!}
	<div class="form-group">
		{!! Form::label('cost_shopping', __('messages.price'), ['class' => 'display-6']) !!}
		{!! Form::number('cost_shopping', null, ['step'=>'0.01','min'=>'0','class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('quantity_shopping', __('messages.quantity'), ['class' => 'display-6']) !!}
		{!! Form::number('quantity_shopping', null, ['min'=>'0','class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('material_id', __('messages.choose_material'), ['class' => 'display-6']) !!}
		{!! Form::select('material_id', $materials_array, null, ['class' => 'form-control']) !!}
	</div>
	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn btn-outline-success shadow-sm"><i class='fa fa-plus-square'></i> {{ __('messages.add') }}</button>
		</div>

		<div class="col">
			<a class="btn btn-outline-info shadow-sm" href="{{ route('lan.show', $lan) }}"><i class='fa fa-arrow-left'></i> {{ __('messages.back_lan') }}</a>
		</div>
	</div>
{!! Form::close() !!}
@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/shopping/ajax_create.js" defer></script>
@endsection
