@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					<h3 class="lead-title">Viewing : shopping</h3>
				</div>

				$shoppingmat = DB::table('contains')->where('shopping_id', '=', $shopping->id)->join('shoppings', 'shoppings.id', '=', 'contains.shopping_id')
					->join('materials', 'contains.material_id', '=', 'materials.id')
					->select('shoppings.*', 'contains.quantity', 'materials.name_material', 'materials.price_material')
					->get();

				<div class="card-body">
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Name</label>
						<label class="form-control col-8">{{$shoppingmat->name_material}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Price</label>
						<label class="form-control col-8">{{$shoppingmat->price_material}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Quantity</label>
						<label class="form-control col-8">{{$shoppingmat->quantity}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Total price</label>
						<label class="form-control col-8">{{$shoppingmat->cost_shopping}}</label>
					</div>
					<div class="form-group row text-center">
						<div class="col">
							<a class="btn btn-primary" href="{{ route('shopping.edit', $shopping->id) }}"><i class='fa fa-edit'></i> Edit</a>
						</div>
						<div class="col">
								<a class="btn btn-primary" href="{{ route('lan.index') }}"><i class='fa fa-arrow-left'></i> Go back to Lan List</a>
						</div>
					</div>
                </div>
			</div>
        </div>
    </div>
</div>
@endsection
