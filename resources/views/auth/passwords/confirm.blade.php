@extends('layouts.app')

@section('content')
<div class="container esp">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bsp">
                <div class="card-header bg-dark">
					<div class="row">
						<div class="col mt-2">
							<h3 class="text-light">{{ __('messages.confirmpassword') }}</h3>
						</div>
					</div>
		</div>

                <div class="card-body">
                    {{ __('messages.confirm_password_before') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('messages.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn  btn-outline-dark shadow-sm">
                                    {{ __('mesages.confirmpassword') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('messages.forgot_password') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
