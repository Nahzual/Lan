@extends('layouts.dashboard')

@section('title')
Account deletion : {!! $logged_user->name.' '.$logged_user->lastname.' ('.$logged_user->pseudo.')'!!}
@endsection

@section('page-title')
Account deletion
@endsection

@section('content')
<div class="row text-center justify-content-center mb-5">
	<div class="col">
		<h4>Do you really want to delete your account ?</h4>
	</div>
</div>
<div class="row text-center justify-content-center">
	<div class="col">
		<p>You will no longer be able to log in to your account after this operation.</p>
		<p>You have two options to delete your account : you can either disable your account, or permanently delete it.</p>
		<p>In the first case only, you can recover your account by contacting an administrator using the "Contact" page. You will have to remember at least the email address associated with this account.</p>
		<p>Be careful, you will also have to prove that you still have access to this email address.</p>
	</div>
</div>
<div class="row text-center justify-content-center">
	<div class="col">
		<p>Proceed ?</p>
	</div>
</div>
<div class="row justify-content-center">
	<div class="col">
		{!! Form::open(['method'=>'delete','url'=>route('user.destroy',$logged_user->id),'class'=>'float-right']) !!}
			<button type="submit" class="btn btn-warning"><i class="fa fa-times"></i> Disable your account</button>
		{{ Form::close() }}
	</div>
	<div class="col">
		{!! Form::open(['method'=>'delete','url'=>route('user.force_destroy',$logged_user->id)]) !!}
			<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete your account</button>
		{{ Form::close() }}
	</div>
</div>
@endsection
