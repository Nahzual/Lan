<div class="card">
	<div class="card-header" id="heading-helper">
    <div class="row">
   		<div class="col mt-2">
    	  <h4>{{ __('messages.helpers') }}</h4>
      </div>
      <div class="col">
				<button class="btn btn-outline-dark shadow-sm float-right ml-2" data-toggle="collapse" data-target="#lan_helpers" aria-expanded="false" aria-controls="lan_helpers">{{ __('messages.show_hide') }}</button>
				<a class="btn btn-success shadow-sm float-right ml-2" href="{{ route('lan.add_helper', $lan->id) }}"><i class='fa fa-plus'></i></a>
				<a class="btn btn-outline-primary shadow-sm float-right" href="{{ route('lan.helper_list', $lan->id) }}"><i class='fa fa-list'></i> {{ __('messages.all') }}</a>
      </div>
   	</div>
 	</div>
	<div class="collapse" id="lan_helpers" aria-labelledby="heading-helper">
		<div class="card-body">
			<div class="table-responsive">
			  <table class="text-center table card-table table-bordered">
			    <thead class="card-table text-center">
			      <th scope="col">#</th>
			      <th scope="col">{{ __('messages.name') }}</th>
			      <th scope="col">{{ __('messages.actions') }}</th>
			    </thead>

			    <tbody>

			    @if (isset($helpers))
						@if(count($helpers)==0)
						<tr>
							<td colspan="3"><h3>{{ __('messages.nohelper') }}</h3></td>
						</tr>
						@endif

			      @foreach($helpers as $helper)
			      <tr id="row-helper-lan-{{$helper->id}}">
							<th>{{$helper->id}}</th>
							<td>{!!$helper->pseudo!!}</td>
							<td scope="col" class="text-center">
								<div class="btn-group text-center">
									{!! Form::open(['method' => 'get','url'=>route('user.show', $helper->id)]) !!}
										<button type="submit" class="mr-2 btn btn-success"><i class='fa fa-eye'></i></button>
									{!! Form::close() !!}
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
</div>
