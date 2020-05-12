					<div class="card">
						<div class="card-header" id="heading-material">
							<div class="row">
								<div class="col mt-2">
									<h4>Materials</h4>
								</div>
								@if ($userIsLanAdmin)
								<div class="col">
									<button class="btn btn-outline-dark shadow-sm float-right ml-2" data-toggle="collapse" data-target="#lan_materials" aria-expanded="false" aria-controls="lan_materials">Show/hide</button>
									<a class="btn btn-success shadow-sm float-right ml-2" href="{{ route('lan.add_material', $lan->id) }}"><i class='fa fa-plus'></i></a>
									<a class="btn btn-outline-primary shadow-sm float-right" href="{{ route('lan.material_list', $lan->id) }}"><i class='fa fa-list'></i> All</a>
								</div>
								@endif
							</div>
						</div>
						<div class="collapse" id="lan_materials" aria-labelledby="heading-material">
							<div class="card-body">
								@include('material.list_lan')
							</div>
						</div>
					</div>
					@foreach($materials as $material)
					<div id="popup-material-{{$material->id}}" class="popup">
						<div class="popup-content">
							<span onclick="closeMaterial({{$material->id}})" class="close">&times;</span>
							@include('material.show',$material)
						</div>
					</div>
					@endforeach
