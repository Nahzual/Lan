<div class="card">
	<div class="card-header">
    		<div class="row">
   		  	 <div class="col mt-2">
    	   			 <h4>Helpers</h4>
      			</div>
      			<div class="col">
				<button class="btn btn-outline-dark shadow-sm float-right" data-toggle="collapse" data-target="#lan_helpers" aria-expanded="false" aria-controls="lan_helpers">Show/hide</button>
				<a class="btn btn-success shadow-sm float-right" href="{{ route('lan.add_helper', $lan->id) }}"><i class='fa fa-plus'></i></a>
				<a class="btn btn-outline-primary shadow-sm float-right" href="{{ route('lan.add_game', $lan->id) }}"><i class='fa fa-list'></i> All</a>
      			</div>
   		 </div>
 	 </div>
	<div class="card-body collapse" id="lan_helpers">

		<div class="table-responsive">
		  <table class="text-center table card-table table-bordered">
		    <thead class="card-table text-center">
		      <th scope="col">#</th>
		      <th scope="col">Username</th>
		      <th scope="col">Actions</th>
		    </thead>

		    <tbody>
		    @if (isset($helpers))
		      @foreach($helpers as $helper)
		      <tr id="row-admin-lan-{{$helper->id}}">
			<th >{{$helper->id}}</th>
			<td >{{$helper->pseudo}}</td>
			<td scope="col" class="text-center">
				<div class="btn-group text-center">
			  		<a class="btn btn-success" href="{{ route('user.show', $helper->id) }}"><i class='fa fa-eye'></i></a>
			  		{!! Form::open(['method' => 'delete','onsubmit'=>'return removeHelper(event,'.$lan->id.','.$helper->id.')']) !!}
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
