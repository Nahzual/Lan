      <div class="card">
        <div class="card-header">
					<h3>Viewing : {{$material->name_material}}</h3>
				</div>

				<div class="card-body">
					<div class="row">
						<label class="display-6" >Name</label>
						<label class="form-control">{{$material->name_material}}</label>
					</div>
					<div class="row">
						<label class="display-6">Description of the material</label>
						<textarea size="30x5" class="form-control">{{$material->desc_material}}</textarea>
					</div>
        </div>
			</div>
