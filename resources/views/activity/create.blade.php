@extends('layouts.dashboard')

@section('title')
{{$lan->name}} : {{ __('messages.create_activity') }}
@endsection

@section('page-title')
{{ __('messages.create_activity') }}
@endsection

@section('content')
<div id="response-success" class ="alert alert-success" style="display:none"></div>
<div id="response-error" class ="alert alert-danger" style="display:none"></div>

{!! Form::open(['method' => 'put', 'onsubmit'=>'return sendRequest(event,'.$lan->id.')']) !!}
	<div>
		<div class="form-group">
			{!! Form::label('name_activity', {{ __('messages.name') }}, ['class' => 'display-6']) !!}
			{!! Form::text('name_activity', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('desc_activity', {{ __('messages.description') }}, ['class' => 'display-6']) !!}
			{!! Form::textarea('desc_activity', null, ['class' => 'form-control','size'=>'30x5']) !!}
		</div>
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
<script type="text/javascript" src="/js/ajax/activity/ajax_create.js" defer></script>
@endsection
