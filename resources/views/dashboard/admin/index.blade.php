@extends('layouts.dashboard')

@section('content')
<div class="card">
	<div class="card-header">
		<h2>Admin Dashboard</h2>
	</div>
<div id="response-success" class="container alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="container alert alert-danger mt-2" style="display:none"></div>
	<div class="card-body">

		  <div class="row justify-content-center">
		    <div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col mt-2">
									<h3>Pending LANS</h3>
								</div>
								<div class="col mt-1">
									<button class="btn btn-outline-dark shadow-sm float-right" data-toggle="collapse" data-target="#pending_lans" aria-expanded="false" aria-controls="pending_lans">Show/hide</button>
								</div>
							</div>
						</div>
						<div class="card-body collapse" id="pending_lans">

					<div class="table-responsive" >
						<table class="table card-table table-bordered">
							<thead class="card-table text-center">
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">View</th>
            <th scope="col">Accept</th>
            <th scope="col">Reject</th>
          </thead>

          <tbody class="text-center">
          @foreach($waiting_lans as $lan)
            <tr id="row-waiting-lan-{{$lan->id}}">
              <td class="lead-text">{{$lan->id}}</td>
              <td class="col mt-2 lead-text">{!!$lan->name!!}</td>

              <td>
                <a class="btn btn-success" href="{{ route('lan.show', $lan->id) }}"><i class='fa fa-eye'></i> View</a>
              </td>
              <td>
                {!! Form::model($lan, ['method' => 'put', 'onsubmit' => 'return sendRequestAccept(event,'.$lan->id.')']) !!}
                  {{ Form::hidden('waiting_lan', config('waiting.ACCEPTED'),['id'=>'waiting_lan_accept']) }}
                  {{ Form::button('<i class="fa fa-check" aria-hidden="true"></i> Accept', ['class' => 'btn btn-success', 'type' => 'submit']) }}
                {{ Form::close() }}
              </td>
              <td>
                {!! Form::model($lan, ['method' => 'put', 'onsubmit' => 'return sendRequestReject(event,'.$lan->id.')']) !!}
                  {{ Form::hidden('waiting_lan', config('waiting.REJECTED'),['id'=>'waiting_lan_reject']) }}
                  {{ Form::button('<i class="fa fa-times" aria-hidden="true"></i> Reject', ['class' => 'btn btn-danger', 'type' => 'submit']) }}
                {{ Form::close() }}
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
</div>
</div>


    </div>
	<div class="col-md-6">
<div class="card">
	<div class="card-header" id="heading-user">
    <div class="row">
   		<div class="col mt-2">
    	  <h3>Latest Users</h3>
      </div>
      <div class="col">
				<button class="btn btn-outline-dark shadow-sm float-right ml-2" data-toggle="collapse" data-target="#users" aria-expanded="false" aria-controls="users">Show/hide</button>
				<?php //<a class="btn btn-success shadow-sm float-right ml-2" href="{{ route('lan.add_user', $lan->id) }}"><i class='fa fa-plus'></i></a> ?>
				<a class="btn btn-outline-primary shadow-sm float-right" href="{{ route('admin.users') }}"><i class='fa fa-list'></i> All</a>
      </div>
   	</div>
 	</div>
	<div class="collapse" id="users" aria-labelledby="heading-user">
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
								
										<button type="submit" class="btn btn-success"><i class='fa fa-eye'></i></button>
									
							  			<button type="submit" class="btn btn-warning"><i class='fa fa-pencil'></i></button>
										<button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i></button>
									
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
	</div>

  </div>


</div>


</div>
@endsection

@section('css_includes')
<link rel="stylesheet" href="/css/table-style.css"></link>
@endsection

@section('js_includes')
@parent
<script src="/js/ajax/lan/ajax_validate.js"></script>
@endsection
