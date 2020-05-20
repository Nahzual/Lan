@extends('layouts.dashboard')

@section('title')
{{ __('messages.account_deletion') }} : {!! $logged_user->name.' '.$logged_user->lastname.' ('.$logged_user->pseudo.')'!!}
@endsection

@section('page-title')
{{ __('messages.account_deletion') }}
@endsection

@section('content')
<div class="row text-center justify-content-center mb-5">
	<div class="col">
		<h4>{{ __('messages.confirm_wish_delete') }}</h4>
	</div>
</div>
<div class="row text-center justify-content-center">
	<div class="col">
		<p>{{ __('messages.deletion_consequence') }}</p>
		<p>{{ __('messages.deletion_option') }}</p>
		<p>{{ __('messages.deletion_option_explanation') }}</p>
		<p>{{ __('messages.deletion_recovery') }}</p>
	</div>
</div>
<div class="row text-center justify-content-center">
	<div class="col">
		<p> {{ __('messages.proceed') }}</p>
	</div>
</div>
<div class="row justify-content-center">
	<div class="col">
		{!! Form::open(['method'=>'delete','url'=>route('user.destroy',$logged_user->id),'class'=>'float-right']) !!}
			<button type="submit" class="btn btn-warning"><i class="fa fa-times"></i> {{ __('messages.disable_account') }}</button>
		{{ Form::close() }}
	</div>
	<div class="col">
		{!! Form::open(['method'=>'delete','url'=>route('user.force_destroy',$logged_user->id)]) !!}
			<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> {{ __('messages.delete_account') }}</button>
		{{ Form::close() }}
	</div>
</div>
@endsection
