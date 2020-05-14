<div class="card">
	<div class="card-header">
		<h3 class="lead-title">Viewing : {!!$shopping->name_activity!!}</h3>
	</div>


	<div class="card-body">
		<div class="row">
			<label class="lead col-3 mt-1 text-center">Price</label>
			<label class="form-control col-8">{!!$shopping->cost_shopping!!} €</label>
		</div>
		<div class="row">
			<label class="lead col-3 mt-1 text-center">Quantity</label>
			<label class="form-control col-8">{!!$shopping->quantity_shopping!!}</label>
		</div>
		<div class="row">
			<label class="lead col-3 mt-1 text-center">Total price</label>
			<label class="form-control col-8">{!!$shopping->cost_shopping*$shopping->quantity_shopping!!} €</label>
		</div>
		<div class="row">
			<label class="lead col-3 mt-1 text-center">Name</label>
			<label class="form-control col-8">{!!$material->name_material!!}</label>
		</div>
		<div class="row">
			<label class="lead col-3 mt-1 text-center">Category</label>
			<label class="form-control col-8">{!!$material->category_material!!}</label>
		</div>
		<div class="row">
			<label class="lead col-3 mt-1 text-center">Description</label>
			<label class="form-control col-8">{!!$material->desc_material!!}</label>
		</div>
		<div class="form-group row text-center">
			<div class="col">
				<a class="btn btn-primary" href="{{ route('shopping.edit', array($lan->id,$shopping->id)) }}"><i class='fa fa-edit'></i> Edit</a>
			</div>
		</div>
	</div>
</div>
