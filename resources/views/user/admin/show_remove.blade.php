<div class="card">
	<div class="card-header" id="heading-admin">
    <div class="row">
   		<div class="col mt-2">
    	  <h4>{{ __('messages.admins') }}</h4>
      </div>
      <div class="col">
				<button class="btn btn-outline-dark shadow-sm float-right ml-2" data-toggle="collapse" data-target="#lan_admins" aria-expanded="false" aria-controls="lan_admins">{{ __('messages.show_hide') }}</button>
				<a class="btn btn-success shadow-sm float-right ml-2" href="{{ route('lan.add_admin', $lan->id) }}"><i class='fa fa-plus'></i></a>
				<a class="btn btn-outline-primary shadow-sm float-right" href="{{ route('lan.admin_list', $lan->id) }}"><i class='fa fa-list'></i> All</a>
      </div>
   	</div>
	</div>
	<div class="collapse" aria-labelledby="heading-admin" id="lan_admins">
		<div class="card-body">
			<div class="table-responsive">
			  <table class="text-center table card-table table-bordered">
			    <thead class="card-table text-center">
			      <th scope="col">#</th>
			      <th scope="col">{{ __('messages.name') }}</th>
			      <th scope="col">{{ __('messages.actions') }}</th>
			    </thead>

			    <tbody>
			    @if (isset($admins))
			    	@foreach($admins as $admin)
			      <tr id="row-admin-lan-{{$admin->id}}">
							<th>{{$admin->id}}</th>
							<td>{!!$admin->pseudo!!}</td>
							<td scope="col" class="text-center">
								<div class="btn-group text-center">
									{!! Form::open(['method' => 'get','url'=>route('user.show', $admin->id)]) !!}
										<button type="submit" class="mr-2 btn btn-success"><i class='fa fa-eye'></i></button>
									{!! Form::close() !!}
							  	{!! Form::open(['method' => 'delete','onsubmit'=>'return removeAdmin(event,'.$lan->id.','.$admin->id.')']) !!}
										<button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i></button>
									{!! Form::close() !!}
								</div>
							</td>
			      </tr>
			      @endforeach
			    @endif
			  	</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
