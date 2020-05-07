					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col mt-2">
									<h4>Materials</h4>
								</div>
								@if ($userIsLanAdmin)
								<div class="col">
									<button class="btn btn-outline-dark shadow-sm float-right" data-toggle="collapse" data-target="#lan_materials" aria-expanded="false" aria-controls="lan_materials">Show/hide</button>
									<a class="btn btn-success shadow-sm float-right" href="{{ route('lan.add_material', $lan->id) }}"><i class='fa fa-plus'></i></a>
									<a class="btn btn-outline-primary shadow-sm float-right" href="{{ route('lan.add_game', $lan->id) }}"><i class='fa fa-list'></i> All</a>
								</div>
								@endif
							</div>
						</div>
						<div class="card-body collapse" id="lan_materials">
							@include('material.list_lan')
						</div>
					</div>
