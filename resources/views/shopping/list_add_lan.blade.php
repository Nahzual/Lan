
<div class="table-responsive">
	<table class="table card-table">
		<thead class="card-table text-center">
			<th scope="col" class="lead">#</th>
			<th scope="col" class="lead">{{ __('messages.name') }}</th>
			<th scope="col" class="lead">{{ __('messages.description') }}</th>
			<th scope="col" class="lead">{{ __('messages.cost') }}</th>
			<th scope="col" class="lead">{{ __('messages.quantity') }}</th>
		</thead>

		<tbody>
			@if(count($shoppings)==0)
				<tr>
					<td colspan="6"><h3 class="text-center">{{ __('messages.no_shoppings') }}</h3></td>
				</tr>
			@endif

			@foreach($shoppings as $shopping)
				<tr>
					<th scope="row" class="text-center lead-text">{{$material->id}}</th>
					<td scope="col" class="text-center lead-text"><a href="{{ route('material.show', $material->id) }}">{{$material->name_material}}</a></td>
					<td scope="col" class="text-center lead-text">  </td>
					<td scope="col" class="text-center lead-text">  </td>

					<td scope="col" class="lead-text">
						{!! Form::open(['method' => 'post','url'=>'', 'onsubmit'=>'return addShopping(event,'.$lan->id.','.$shopping->id.')']) !!}
						<div class="form-group row text-center">
							<div class="col">
								<button type="submit" class="btn btn-success"><i class='fa fa-plus-square'></i> {{ __('messages.add_shopping') }}</button>
							</div>
						</div>
						{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
