@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

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
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

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
                            <label for="pseudo" class="col-md-4 col-form-label text-md-right">{{ __('Pseudo') }}</label>

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
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

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
                            <label for="tel_user" class="col-md-4 col-form-label text-md-right">{{ __('Tel') }}</label>

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
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                          {!! Form::label('num_street', 'Numero Street', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                          <div class="col-md-6">
                            {!! Form::text('num_street', null, ['class' => 'form-control']) !!}
                          </div>
                        </div>
                        <div class="form-group row">
                          {!! Form::label('name_street', 'Name Street', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                          <div class="col-md-6">
                            {!! Form::text('name_street', null, ['class' => 'form-control']) !!}
                          </div>
                        </div>
                        <div class="form-group row">
                          {!! Form::label('name_city', 'Name City', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                          <div class="col-md-6">
                            {!! Form::text('name_city', null, ['class' => 'form-control']) !!}
                          </div>
                        </div>
                        <div class="form-group row">
                          {!! Form::label('zip_city', 'Zip', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                          <div class="col-md-6">
                            {!! Form::text('zip_city', null, ['class' => 'form-control']) !!}
                          </div>
                        </div>
                        <div class="form-group row">
                          {!! Form::label('name_department', 'Name Department', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                          <div class="col-md-6">
                            {!! Form::text('name_department', null, ['class' => 'form-control']) !!}
                          </div>
                        </div>
                        <div class="form-group row">
                          {!! Form::label('name_country', 'Name Country', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                          <div class="col-md-6">
                            {!! Form::text('name_country', null, ['class' => 'form-control']) !!}
                          </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
