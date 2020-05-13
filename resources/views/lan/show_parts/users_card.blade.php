<div class="card">
	<div class="card-header" id="heading-user">
    <div class="row">
   		<div class="col mt-2">
    	  <h4>Players</h4>
      </div>
      <div class="col">
				<button class="btn btn-outline-dark shadow-sm float-right ml-2" data-toggle="collapse" data-target="#lan_users" aria-expanded="false" aria-controls="lan_users">Show/hide</button>
				<?php //<a class="btn btn-success shadow-sm float-right ml-2" href="{{ route('lan.add_user', $lan->id) }}"><i class='fa fa-plus'></i></a> ?>
				<a class="btn btn-outline-primary shadow-sm float-right" href="{{ route('lan.user_list', $lan->id) }}"><i class='fa fa-list'></i> All</a>
      </div>
   	</div>
 	</div>
	<div class="collapse" id="lan_users" aria-labelledby="heading-user">
		<div class="card-body">
			<div class="table-responsive">
			  <table class="text-center table card-table table-bordered">
			    <thead class="card-table text-center">
			      <th scope="col">#</th>
			      <th scope="col">Username</th>
			 <th scope="col">Actions</th>
			    </thead>

			    <tbody>

			    @if (isset($users))
						@if(count($users)==0)
						<tr>
							<td colspan="3"><h3>Error while reaching the user list</h3></td>
						</tr>
						@endif

			      @foreach($users as $user)
			      <tr id="row-helper-lan-{{$user->id}}">
							<th>{{$user->id}}</th>
							<td>{!!$user->pseudo!!}</td>
							<td scope="col" class="text-center">
								<div class="btn-group text-center">
									{!! Form::open(['method' => 'get','url'=>route('user.show', $user->id)]) !!}
										<button type="submit" class="mr-2 btn btn-success"><i class='fa fa-eye'></i></button>
									{!! Form::close() !!}
@if ($userIsLanAdmin)
							  	{!! Form::open(['method' => 'delete','onsubmit'=>'return removeUser(event,'.$lan->id.','.$user->id.')']) !!}
										<button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i></button>
									{!! Form::close() !!}@endif
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
