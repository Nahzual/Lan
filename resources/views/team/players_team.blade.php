@extends('layouts.dashboard')

@section('title')
All the players of the team {{ $team->name_team }}

@endsection

@section('title-buttons')

@if($userIsLanAdmin || $logged_user->isSiteAdmin())
<div class="col text-center">
	<a class="btn btn-warning shadow-sm" href="{{ route('team.edit', [$tournament->id, $team->id]) }}"><i class='fa fa-edit'></i> Edit</a>
</div>
@endif

@if(($userIsLanAdmin || $logged_user->isSiteAdmin()) && count($users)<$tournament->number_per_team)
	<div class="col">
		{!! Form::open(['method' => 'get','url'=>route('team.join_list',$team->id) ]) !!}
			<button type="submit" class="btn btn-primary float-right"><i class="fa fa-user-plus"></i> Add players</button>
		{{ Form::close() }}
	</div>
@elseif($userIsLanAdmin || $logged_user->isSiteAdmin())
<div class="col">
	{!! Form::open(['method' => 'get','url'=>route('team.join_list',$team->id) ]) !!}
		<button type="submit" class="btn btn-primary float-right" title="The team is full" disabled><i class="fa fa-user-plus"></i> Add users</button>
	{{ Form::close() }}
</div>
@endif

@endsection

@section('page-title')
Team players
@endsection

@section('content')

<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

<div class="table-responsive">
	<table class="text-center table card-table table-bordered">
		<thead class="card-table text-center">
			<th scope="col">#</th>
			<th scope="col">Pseudo</th>
			<th scope="col">Name</th>
			<th scope="col"></th>
		</thead>

		<tbody>

			@if(count($users)==0)
			<tr>
				<td colspan="4"><h3>No players to show</h3></td>
			</tr>
			@endif

			@foreach($users as $user)
			<tr id="row-user-team-{{$user->id}}">
				<th>{{$user->id}}</th>
				<td>{!!$user->pseudo!!}</td>
				<td>{!!$user->name.' '.$user->lastname!!}</td>
				<td scope="col" class="text-center">
					<div class="btn-group text-center">
						{!! Form::open(['method' => 'get','url'=>route('user.show',$user->id)]) !!}
							<button type="submit" class="btn btn-success mr-2"><i class='fa fa-eye'></i> View</button>
						{!! Form::close() !!}
						@if($userIsLanAdmin)
						{!! Form::open(['method' => 'delete','onsubmit'=>'return removePlayer(event,'.$team->id.','.$user->id.')']) !!}
							<button type="submit" class="btn btn-danger"><i class='fa fa-times'></i> Remove</button>
						{!! Form::close() !!}
						@endif
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="row">
	<div class="col">
	  <a class="btn btn-outline-info shadow-sm float-right" href="{{ route('tournament.show_tournament', [$tournament->lan_id, $tournament]) }}"><i class='fa fa-arrow-left'></i> Go Back to Tournament</a>
	</div>
</div>
@endsection


@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/team/ajax_remove_player.js"></script>
@endsection
