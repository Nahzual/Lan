
<div class="table-responsive col">
	<table class="text-center table card-table table-bordered">
		<thead class="card-table text-center">
			<th scope="col">#</th>
			<th scope="col">{{ __('messages.name') }}</th>
			<th scope="col">{{ __('messages.actions') }}</th>
		</thead>

		<tbody>
		@if(count($users)==0)
		<tr>
			<td colspan="3"><h3>{{ __('messages.nohelper') }}</h3></td>
		</tr>
		@endif
		@foreach($users as $helper)
			<tr>
				<th>{{$helper->id}}</th>
				<td>{!!$helper->pseudo!!}</td>
				<td>
					{!! Form::open(['method' => 'post','url'=>'', 'onsubmit'=>'assign(event,'.$lan->id.','.$task->id.','.$helper->id.')']) !!}
					<div class="form-group row text-center">
						<div class="col">
							<button type="submit" class="btn btn-success shadow-sm"><i class='fa fa-plus-square'></i>{{ __('messages.add') }}</button>
						</div>
					</div>
					{!! Form::close() !!}
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
