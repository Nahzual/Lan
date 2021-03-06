@extends('layouts.app')

@section('content')
<div class="container esp">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card besp">
				<div class="card-header  bg-dark">
					<div class="row">
						<div class="col mt-2">
							<h3 class="text-light">{{ __('messages.register') }}</h3>
						</div>
					</div>
				</div>

				<div class="card-body">
					<form method="POST" action="{{ route('register') }}">
						@csrf

						<div class="form-group row">
							<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.name') }}</label>

							<div class="col-md-6">
								<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

								@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('messages.lname') }}</label>

							<div class="col-md-6">
								<input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

								@error('lastname')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="pseudo" class="col-md-4 col-form-label text-md-right">{{ __('messages.pseudo') }}</label>

							<div class="col-md-6">
								<input id="pseudo" type="text" class="form-control @error('pseudo') is-invalid @enderror" name="pseudo" value="{{ old('pseudo') }}" required autocomplete="pseudo" autofocus>

								@error('pseudo')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('messages.email') }}</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="tel_user" class="col-md-4 col-form-label text-md-right">{{ __('messages.tel') }}</label>

							<div class="col-md-6">
								<input id="tel_user" type="tel_user" class="form-control @error('tel_user') is-invalid @enderror" name="tel_user" value="{{ old('tel_user') }}" required autocomplete="tel_user">

								@error('tel_user')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('messages.password') }}</label>

							<div class="col-md-6">
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('messages.confirmpassword') }}</label>

							<div class="col-md-6">
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
							</div>
						</div>

						<div class="form-group row">
							{!! Form::label('num_street', __('messages.streetnbr'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
							<div class="col-md-6">
								<input type="number" name="num_street" id="num_street" min="1" placeholder="{{ __('messages.streetnbr') }}" value="{{ old('num_street') }}" class="form-control @error('num_street') is-invalid @enderror"></input>

								@error('num_street')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							{!! Form::label('name_street', __('messages.streetname'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
							<div class="col-md-6">
								<input type="text" name="name_street" id="name_street"  placeholder="{{ __('messages.streetname') }}" value="{{ old('name_street') }}" class="form-control @error('name_street') is-invalid @enderror"></input>

								@error('name_street')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							{!! Form::label('name_city', __('messages.city'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
							<div class="col-md-6">
								<input type="text" name="name_city" id="name_city"  placeholder="{{ __('messages.city') }}" value="{{ old('name_city') }}" class="form-control @error('name_city') is-invalid @enderror"></input>

								@error('name_city')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							{!! Form::label('zip_city', __('messages.zip'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
							<div class="col-md-6">
								<input type="text" name="zip_city" id="zip_city"  placeholder="{{ __('messages.zip') }}" value="{{ old('zip_city') }}" class="form-control @error('zip_city') is-invalid @enderror"></input>

								@error('zip_city')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							{!! Form::label('name_department', __('messages.depname'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
							<div class="col-md-6">
								<input type="text" name="name_department" id="name_department"  placeholder="{{ __('messages.depname') }}" value="{{ old('name_department') }}" class="form-control @error('name_department') is-invalid @enderror"></input>

								@error('name_department')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							{!! Form::label('name_country', __('messages.country'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}
							<div class="col-md-6">
								<input type="text" name="name_country" id="name_country"  placeholder="{{ __('messages.country') }}" value="{{ old('name_country') }}" class="form-control @error('name_country') is-invalid @enderror"></input>

								@error('name_country')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn  btn-outline-dark shadow-sm"><i class='fa fa-sign-in'></i>
									{{ __('messages.register') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
