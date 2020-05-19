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
			{!! Form::open(['method' => 'post', 'onsubmit'=>'return sendRequest(event);', 'enctype' => 'multipart/form-data']) !!}
				@csrf
				<div class="bg-light">
					<div class="form-group">
						{!! Form::label('name', __('messages.name'), ['class' => 'display-6']) !!}
						{!! Form::text('name', ($logged_user) ? $logged_user->name : null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('lastname', __('messages.lname'), ['class' => 'display-6']) !!}
						{!! Form::text('lastname', ($logged_user) ? $logged_user->lastname : null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('email', __('messages.email'), ['class' => 'display-6']) !!}
						{!! Form::text('email', ($logged_user) ? $logged_user->email : null, ['class' => 'form-control']) !!}
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
						{!! Form::label('file', __('messages.attachment'), ['class' => 'display-6']) !!}
						<br>
						{!! Form::file('file', null, ['class' => 'form-control']) !!}
					</div>
				</div>

				<div class="form-group row text-center">
					<div class="col text-right">
						<a class="btn  btn-outline-info shadow-sm" href="{{ route('home') }}"><i class='fa fa-arrow-left'></i>{{ __('messages.back_home') }}</a>
						<button type="submit" class="btn  btn-outline-success shadow-sm"><i class='fa fa-plus-square'></i>{{ __('messages.send') }}</button>
					</div>
				</div>
			{!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="/js/ajax/contact/ajax.js" defer></script>
@endsection
