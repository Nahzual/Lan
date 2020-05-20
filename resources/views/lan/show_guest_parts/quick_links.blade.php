				<div class="card">
					<div class="card-header">
						<div class="row">
							<h4 class="mt-2">{{ __('messages.reminder') }}</h4>
						</div>
					</div>
					<div class="card-body ">
					<div class="row justify-content-center">
						<p>{{ __('messages.external_users') }}</p>
						<p>{{ __('messages.be_careful') }}</p>

						<p> {{ __('messages.even_friend') }}</p>
						<p>{{ __('messages.can_make_lan') }}</p>

					</div>

					<div class="row justify-content-center">
			@if($time_left->invert || $time_left->days==0)
				<a class="btn btn-success disabled"> {{ __('messages.lan_closed') }}</a>
			@else
				<a class="btn btn-success" href="{{ route('lan.participate', $lan->id) }}"><i class="fa fa-sign-in"></i> {{ __('messages.join_lan') }}</a>
			@endif

													<form method="GET" action="{{ route('lan.create') }}">
										@csrf
										@method('GET')
										<button type="submit" class="btn  btn-outline-dark shadow-sm"><i class='fa fa-plus-square'></i> {{ __('messages.create_new_lan') }}</button>
									</form>
					</div>
					</div>
				</div>
