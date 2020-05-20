						<div class="card">
							<div class="card-header" id="heading-tournament">
								<div class="row">
									<div class="col mt-2">
										<h4>{{ __('messages.tournaments') }}</h4>
									</div>
									<div class="col">
										<button class="btn btn-outline-dark shadow-sm float-right ml-2" data-toggle="collapse" data-target="#lan_tournaments" aria-expanded="false" aria-controls="lan_tournaments">{{ __('messages.show_hide') }}</button>
										<a class="btn btn-outline-primary shadow-sm float-right" href="{{ route('lan.tour_list', $lan->id) }}"><i class='fa fa-list'></i> {{ __('messages.all') }}</a>
									</div>
								</div>
							</div>
							<div class="collapse" id="lan_tournaments" aria-labelledby="heading-tournament">
								<div class="card-body">
									@include('tournament.list_lan')
								</div>
							</div>
						</div>
