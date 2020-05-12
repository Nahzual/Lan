					<div class="card">
						<div class="card-header" id="heading-shopping">
							<div class="row">
								<div class="col mt-2">
									<h4>Shopping</h4>
								</div>
								@if ($userIsLanAdmin)
								<div class="col">
									<button class="btn btn-outline-dark shadow-sm float-right ml-2" data-toggle="collapse" data-target="#lan_shopping" aria-expanded="false" aria-controls="lan_shopping">Show/hide</button>
									<a class="btn btn-success shadow-sm float-right ml-2" href="{{ route('shopping.create', $lan->id) }}"><i class='fa fa-plus'></i></a>
									<a class="btn btn-outline-primary shadow-sm float-right" href="{{ route('lan.add_game', $lan->id) }}"><i class='fa fa-plus'></i> All</a>
								</div>
								@endif
							</div>
						</div>
						<div class="collapse" id="lan_shopping" aria-labelledby="heading-shopping">
							<div class="card-body">
							</div>
						</div>

					</div>
