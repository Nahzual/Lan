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
		<p>You can always recover your account by contacting an administrator using the "Contact" page. In this case, you will have to remember at least the email address associated with this account.</p>
		<p>Be careful, you will also have to prove that you still have access to this email address.</p>
	</div>
</div>
<div class="row text-center justify-content-center">
	<div class="col">
		<p>Proceed ?</p>
		{!! Form::open(['method'=>'delete','url'=>route('user.destroy',$logged_user->id)]) !!}
			<button type="submit" class="btn btn-danger">Delete your account</button>
		{{ Form::close() }}
	</div>
</div>
@endsection
