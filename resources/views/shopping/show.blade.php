<div class="card">
	<div class="card-header">
		<h3>{{ __('messages.viewing_shopping_lan'') }} {!! $lan->name !!}</h3>
	</div>


	<div class="card-body">
		<div class="row">
			<label class="display-6 col-3 mt-1 text-center">{{ __('messages.price') }}</label>
			<label class="form-control col-8">{!!$shopping->cost_shopping!!} €</label>
		</div>
		<div class="row">
			<label class="display-6 col-3 mt-1 text-center">{{ __('messages.quantity') }}</label>
			<label class="form-control col-8">{!!$shopping->quantity_shopping!!}</label>
		</div>
		<div class="row">
			<label class="display-6 col-3 mt-1 text-center">{{ __('messages.total_price') }}</label>
			<label class="form-control col-8">{!!$shopping->cost_shopping*$shopping->quantity_shopping!!} €</label>
		</div>
		<div class="row">
			<label class="display-6 col-3 mt-1 text-center">{{ __('messages.name') }}</label>
			<label class="form-control col-8">{!!$material->name_material!!}</label>
		</div>
		<div class="row">
			<label class="display-6 col-3 mt-1 text-center">{{ __('messages.category') }}</label>
			<label class="form-control col-8">{!!$material->category_material!!}</label>
		</div>
		<div class="row">
			<label class="display-6 col-3 mt-1 text-center">{{ __('messages.description') }}</label>
			<label class="form-control col-8">{!!$material->desc_material!!}</label>
		</div>
		<div class="form-group row text-center">
			<div class="col">
				<a class="btn btn-primary" href="{{ route('shopping.edit', array($lan->id,$shopping->id)) }}"><i class='fa fa-edit'></i> {{ __('messages.edit') }}</a>
			</div>
		</div>
	</div>
</div>
