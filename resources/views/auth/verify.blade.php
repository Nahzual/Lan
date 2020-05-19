@extends('layouts.app')

@section('content')
<div class="container esp">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card besp">
                <div class="card-header  bg-dark">
					<div class="row">
						<div class="col mt-2">
							<h3 class="text-light">{{ __('messages.verify_email') }}</h3>
						</div>
					</div>
		</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('messages.verif_link_sent') }}
                        </div>
                    @endif

                    {{ __('messages.check_email') }}
                    {{ __('messages.not_get') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('messages.click_request_another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
