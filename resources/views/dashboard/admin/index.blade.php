@extends('layouts.dashboard')

@section('title')
Administrator dashboard
@endsection

@section('page-title')
Admin dashboard
@endsection

@section('toolbar')
<!-- Toolbar -->
<div class="card">
	<div class="card-body">
		<div class="row">
			{!! Form::open(['method'=>'get','url'=>'/game/create']) !!}
				<button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Add a new game</button>
			{!! Form::close() !!}
			{!! Form::open(['method'=>'get','url'=>'/material/create']) !!}
			 <button type="submit" class="ml-2 btn btn-primary"><i class="fa fa-plus-square"></i> Add a new material</button>
		 {!! Form::close() !!}
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="row justify-content-center">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col">
						<h3>Latest users</h3>
					</div>
					<div class="col">
						<button class="btn btn-outline-dark shadow-sm float-right" data-toggle="collapse" data-target="#collapse-users" aria-expanded="false" aria-controls="collapse-users">Show/hide</button>
					</div>
				</div>
			</div>
			<div id="response-success-users" class="container alert alert-success mt-2" style="display:none"></div>
			<div id="response-error-users" class="container alert alert-danger mt-2" style="display:none"></div>
		</div>
		<div id="collapse-users" class="table-responsive collapse">
			<table class="table card-table table-bordered">
				<thead class="card-table text-center">
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Username</th>
					<th scope="col">Actions</th>
				</thead>

				<tbody class="text-center" id="table-users">
					@if(count($latest_users)!=0)
					@each('user.show_delete',$latest_users,'user')
					@else
					<tr id="row-user-empty">
						<td colspan="4"><h4>No users to show</h4></td>
					</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>

	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col">
						<h3>Latest deleted users</h3>
					</div>
					<div class="col">
						<button class="btn btn-outline-dark shadow-sm float-right" data-toggle="collapse" data-target="#collapse-deleted-users" aria-expanded="false" aria-controls="collapse-deleted-users">Show/hide</button>
					</div>
				</div>
			</div>
			<div id="response-success-users-deleted" class="container alert alert-success mt-2" style="display:none"></div>
			<div id="response-error-users-deleted" class="container alert alert-danger mt-2" style="display:none"></div>
		</div>

		<div class="table-responsive collapse" id="collapse-deleted-users">
			<table class="table card-table table-bordered">
				<thead class="card-table text-center">
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Username</th>
					<th scope="col">Actions</th>
				</thead>

				<tbody class="text-center" id="table-deleted-users">
					@if(count($latest_deleted_users)!=0)
					@each('user.show_restore',$latest_deleted_users,'user')
					@else
					<tr id="row-user-deleted-empty">
						<td colspan="4"><h4>No users to show</h4></td>
					</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row justify-content-center mt-5">
	<div class="col-md-6">
		<div id="response-success-lans" class="container alert alert-success mt-2" style="display:none"></div>
		<div id="response-error-lans" class="container alert alert-danger mt-2" style="display:none"></div>
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col">
						<h3>Pending LANs</h3>
					</div>
					<div class="col">
						<button class="btn btn-outline-dark shadow-sm float-right" data-toggle="collapse" data-target="#collapse-lans" aria-expanded="false" aria-controls="collapse-lans">Show/hide</button>
					</div>
				</div>
			</div>
		</div>

		<div class="table-responsive collapse" id="collapse-lans">
			<table class="table card-table table-bordered">
				<thead class="card-table text-center">
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">View</th>
					<th scope="col">Accept</th>
					<th scope="col">Reject</th>
				</thead>

				<tbody class="text-center">
					@if(count($waiting_lans)==0)
					<tr scope="row">
						<td scope="col" colspan="5"><h4>No lans to show</h4></td>
					</tr>
					@endif
					@foreach($waiting_lans as $lan)
					<tr scope="row" id="row-waiting-lan-{{$lan->id}}">
						<td scope="col" class="lead-text">{{$lan->id}}</td>
						<td scope="col" class="mt-2 lead-text">{!!$lan->name!!}</td>

						<td scope="col">
							<a class="btn btn-success" href="{{ route('lan.show', $lan->id) }}"><i class='fa fa-eye'></i> View</a>
						</td>
						<td scope="col">
							{!! Form::model($lan, ['method' => 'put', 'onsubmit' => 'return sendRequestAccept(event,'.$lan->id.')']) !!}
							{{ Form::hidden('waiting_lan', config('waiting.ACCEPTED'),['id'=>'waiting_lan_accept']) }}
							{{ Form::button('<i class="fa fa-check" aria-hidden="true"></i> Accept', ['class' => 'btn btn-success', 'type' => 'submit']) }}
							{{ Form::close() }}
						</td>
						<td scope="col">
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
@endsection

@section('css_includes')
<link rel="stylesheet" href="/css/table-style.css"></link>
@endsection

@section('js_includes')
@parent
<script src="/js/ajax/lan/ajax_validate.js"></script>
<script src="/js/ajax/user/ajax_delete.js"></script>
<script src="/js/ajax/user/ajax_restore.js"></script>
@endsection
