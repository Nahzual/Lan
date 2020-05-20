				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col mt-2">
								<h4>{{ __('messages.login_required') }}</h4>
							</div>
						</div>
					</div>
					<div class="card-body ">
						<div class="row justify-content-center">
							<p>{{ __('messages.account_needed') }}</p>
							<p>{{ __('messages.cannot_see_info_lan') }}</p>
							<p class="text-center"><a class="btn btn-success" href="{{ url('/login') }}"><i class="fa fa-sign-in"></i> {{ __('messages.login') }}</a></p>
						</div>


					</div>
				</div>
