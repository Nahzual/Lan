@extends('layouts.dashboard')

@section('title')
Adding admin to Lan : {!!$lan->name!!}
@endsection

@section('page-title')
Adding admin to Lan
@endsection

@section('content')

<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

{!! Form::open(['method' => 'post','onsubmit'=>'searchAdmin(event,'.$lan->id.')']) !!}
	<div>
		<h4>{{ __('messages.admin_name') }}</h4>
		<div class="form-group">
			{!! Form::hidden('view_path', 'user.admin.show_add') !!}
			{!! Form::text('pseudo', null, ['required'=>'', 'class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn btn-outline-info shadow-sm"><i class='fa fa-search'></i>{{ __('messages.search') }}</button>
		</div>
	</div>
{!! Form::close() !!}
<div id="requestResult"></div>

<div class="col text-right">
	<a class="btn btn-outline-info shadow-sm" href="{{ route('lan.show', $lan) }}"><i class='fa fa-arrow-left'></i>{{ __('messages.back_lan') }}</a>
</div>
@endsection

@section('js_includes')
<script src="/js/ajax/lan/ajax_add_admin.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
