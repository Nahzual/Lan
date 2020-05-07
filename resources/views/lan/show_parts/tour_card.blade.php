						<div class="card">
							<div class="card-header">
								<div class="row">
									<div class="col mt-2">
										<h4>Tournaments</h4>
									</div>
									@if ($userIsLanAdmin)
									<div class="col mt-2">
										<button class="btn btn-outline-dark shadow-sm float-right" data-toggle="collapse" data-target="#lan_tournaments" aria-expanded="false" aria-controls="lan_tournaments">Show/hide</button>
										<a class="btn btn-success shadow-sm float-right" href="{{ route('tournament.create_tournament', $lan->id) }}"><i class='fa fa-plus'></i></a>
									
										<a class="btn btn-outline-primary shadow-sm float-right" href="{{ route('lan.add_game', $lan->id) }}"><i class='fa fa-list'></i> All</a>
									</div>
									@endif
								</div>
							</div>
							<div class="card-body collapse" id="lan_tournaments">
								@include('tournament.list_lan')
							</div>
						</div>
