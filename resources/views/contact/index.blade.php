@extends('layouts.app')

@section('content')
<div class="container esp">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card besp">
        <div class="card-header bg-dark ">
				<div class="row">
						<div class="col mt-2">
							<h3 class="text-light" >{{ __('messages.contact_us') }}</h3>
						</div>
				</div>
		</div>
		<div class="card-body">
			<div id="response-success" class ="alert alert-success" style="display:none"></div>
			{!! Form::open(['method' => 'post', 'id' => 'CreateNewContactForm', 'enctype' => 'multipart/form-data']) !!}
				@csrf
				<div class="bg-light">
					@if(isset($logged_user))
						<div class="form-group">
							{!! Form::label('name', __('messages.name'), ['class' => 'display-6']) !!}
							{!! Form::text('name', $logged_user->name, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('lastname', __('messages.lname'), ['class' => 'display-6']) !!}
							{!! Form::text('lastname', $logged_user->lastname, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('email', __('messages.email'), ['class' => 'display-6']) !!}
							{!! Form::text('email', $logged_user->email, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('object', __('messages.object'),['class' => 'display-6']) !!}
							{!! Form::text('object', null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('description', __('messages.description'), ['class' => 'display-6']) !!}
							{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('fichier', __('messages.attachment'), ['class' => 'display-6']) !!}
							<br>
							{!! Form::file('fichier', null, ['class' => 'form-control', 'name' => 'fichier', 'id' => 'fichier']) !!}
						</div>
					@else
						<div class="form-group">
							{!! Form::label('name', __('messages.name'), ['class' => 'display-6']) !!}
							{!! Form::text('name', null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('lastname', __('messages.lname'), ['class' => 'display-6']) !!}
							{!! Form::text('lastname', null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('email', __('messages.email'), ['class' => 'display-6']) !!}
							{!! Form::text('email', null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('object', __('messages.object'),['class' => 'display-6']) !!}
							{!! Form::text('object', null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('description', __('messages.description'), ['class' => 'display-6']) !!}
							{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('fichier', __('messages.attachment'), ['class' => 'display-6']) !!}
							<br>
							{!! Form::file('fichier', null, ['class' => 'form-control', 'name' => 'fichier', 'id' => 'fichier']) !!}
						</div>
					@endif
				</div>

				<div class="form-group row text-center">
					<div class="col text-right">
						<a class="btn  btn-outline-info shadow-sm" href="{{ route('dashboard') }}"><i class='fa fa-arrow-left'></i> Go Back to home</a>
						<button type="submit" class="btn  btn-outline-success shadow-sm" id="AddNewContactSubmit"><i class='fa fa-plus-square'></i>{{ __('messages.send') }}</button>
					</div>
				</div>
			{!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>

<script src=" http://code.jquery.com/jquery-3.3.1.min.js"
					integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
					crossorigin="anonymous">
</script>
<script>
	$(document).ready(function(){
		$('#AddNewContactSubmit').click(function(e){
			e.preventDefault();
			$.ajaxSetup({
				headers:{
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: "{{ route('contact.store') }}",
				method: 'post',
				data: {
					name: $('#name').val(),
					lastname: $('#lastname').val(),
					email: $('#email').val(),
					object: $('#object').val(),
					description: $('#description').val(),
					fichier: $('#fichier').val()
				},
				success: function(result){
					if(result.success!=undefined){
						$('#response-success').show();
						$('#response-success').html(result.success);
					}else{
						$('#response-error').show();
						$('#response-error').html(result.error);
					}
				}
			});
		});
	});
</script>
@endsection
