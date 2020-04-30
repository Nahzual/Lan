@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
			<h3 class="lead-title">Contact</h3>
		</div>
		<div class="card-body">
			<div id="response-success" class ="alert alert-success" style="display:none"></div>
			<p class="text-muted">If you having trouble with this service, please <a href="">ask for help</a></p>
			{!! Form::open(['method' => 'put', 'id' => 'CreateNewContactForm']) !!}
				<div class="bg-light">
					<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
						{!! Form::label('name', 'Name', ['class' => 'lead']) !!}
						{!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
						@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
						{!! Form::label('lastname', 'Last Name', ['class' => 'lead']) !!}
						{!! Form::text('lastname', $user->lastname, ['class' => 'form-control']) !!}
						{!! $errors->first('lastname', '<span class="help-block">:message</span>') !!}
					</div>
					<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
						{!! Form::label('email', 'Email', ['class' => 'lead']) !!}
						{!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
						{!! $errors->first('email', '<span class="help-block">:message</span>') !!}
					</div>
					<div class="form-group {{ $errors->has('object') ? 'has-error' : '' }}">
						{!! Form::label('object', 'Object', ['class' => 'lead']) !!}
						{!! Form::text('object', null, ['class' => 'form-control']) !!}
						{!! $errors->first('object', '<span class="help-block">:message</span>') !!}
					</div>
					<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
						{!! Form::label('description', 'Description', ['class' => 'lead']) !!}
						{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
						{!! $errors->first('description', '<span class="help-block">:message</span>') !!}
					</div>
				</div>
				<div class="form-group row text-center">
					<div class="col">
						<button type="submit" class="btn btn-primary" id="AddNewContactSubmit"><i class='fa fa-plus-square'></i> Send</button>
					</div>

					<div class="col">
						<a class="btn btn-primary" href="{{ route('lan.index') }}"><i class='fa fa-arrow-left'></i> Go Back to home</a>
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
					description: $('#description').val()
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
