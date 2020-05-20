
<div class="table-responsive">
	<table class="table card-table">
		<thead class="card-table text-center">
			<th scope="col" class="lead">#</th>
			<th scope="col" class="lead">{{ __('messages.name') }}</th>
			<th scope="col" class="lead">{{ __('messages.description') }}</th>
			<th scope="col" class="lead">{{ __('messages.cost') }}</th>
			<th scope="col" class="lead">{{ __('messages.quantity') }}</th>
			@if($userIsLanAdmin) <th scope="col" class="lead "></th> @endif
		</thead>

		<tbody>
			@if(count($materials)==0)
				<tr>
					<td colspan="5"><h3 class="text-center">{{ __('messages.no_materials') }}</h3></td>
				</tr>
			@endif

			@foreach($materials as $material)
				<tr>
					<th scope="row" class="text-center lead-text">{{$material->id}}</th>
					<td scope="col" class="text-center lead-text"><a href="{{ route('material.show', $material->id) }}">{{$material->name_material}}</a></td>
					<td scope="col" class="text-center lead-text">  </td>
					<td scope="col" class="text-center lead-text">  </td>

					@if($userIsLanAdmin)
						<td scope="col" class="lead-text">
							{!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeShopping(event,'.$lan->id.','.$shopping->id.')']) !!}
							<div class="form-group row text-center">
								<div class="col">
									<button type="submit" class="btn btn-warning"><i class='fa fa-times'></i> {{ __('messages.remove') }}</button>
								</div>
							</div>
							{!! Form::close() !!}
						</td>
					@endif
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
