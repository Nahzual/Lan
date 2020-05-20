<div class="card">
	<div class="card-header" id="heading-team">
		<div class="row">
			@if(isset($players))
			<div class="col mt-2">
				<h4>Players</h4>
			</div>
			<div class="col">
				<button class="btn btn-outline-dark shadow-sm float-right ml-2" data-toggle="collapse" data-target="#tournament_teams" aria-expanded="false" aria-controls="tournament_teams">Show/hide</button>
				@if($players->count() < $tournament->max_player_count_tournament)
				<a class="btn btn-success shadow-sm float-right ml-2" href="{{ route('tournament.join_list', $tournament->id) }}"><i class='fa fa-plus'></i> Add a new player</a>
				@else
				<a class="btn btn-success shadow-sm float-right ml-2" href="{{ route('tournament.join_list', $tournament->id) }}" title="The maximum number of players for this tournament is reached" disabled><i class='fa fa-plus'></i>  Add a new player</a>
				@endif
			</div>
			@else
			<div class="col mt-2">
				<h4>Teams</h4>
			</div>
			<div class="col">
				<button class="btn btn-outline-dark shadow-sm float-right ml-2" data-toggle="collapse" data-target="#tournament_teams" aria-expanded="false" aria-controls="tournament_teams">Show/hide</button>
				@if($teams->count()*$tournament->number_per_team < $tournament->max_player_count_tournament)
				<a class="btn btn-success shadow-sm float-right ml-2" href="{{ route('team.create_team', $tournament->id) }}"><i class='fa fa-plus'></i> Create a new team</a>
				@else
				<a class="btn btn-success shadow-sm float-right ml-2" href="{{ route('team.create_team', $tournament->id) }}" title="The maximum number of teams for this tournament is reached" disabled><i class='fa fa-plus'></i> Create a new team</a>
				@endif
			</div>
			@endif
		</div>
	</div>

	<div id="response-success" class="container alert alert-success mt-2" style="display:none"></div>
	<div id="response-error" class="container alert alert-danger mt-2" style="display:none"></div>

	<div class="collapse" id="tournament_teams" aria-labelledby="heading-team">
		<div class="card-body">
			<div class="table-responsive">
				<table class="text-center table card-table table-bordered">
					<thead class="card-table text-center">
						<th scope="col" >#</th>
						<th scope="col" >Name</th>
						@if(!isset($players)) <th scope="col" >Number of players</th> @endif
						<th scope="col"></th>
					</thead>

					<tbody>
						@if(isset($players))
							@if(count($players)==0)
								<tr>
									<td colspan="5"><h3 class="text-center">No players to show</h3></td>
								</tr>
							@endif
							@foreach($players as $player)
								<tr id="row-team-tournament-{{$player->pivot->team_id}}">
									<th scope="row">{{$player->id}}</th>
									<td scope="col">{!!$player->pseudo!!}</td>
									<td scope="col" class=" text-center">
										<div class="btn-group">
											<a class="btn btn-success" href="{{ route('user.show', $player->id) }}"><i class='fa fa-eye'></i> View</a>
											@if ($userIsLanAdmin)
												{!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeTeam(event, '.$tournament->id.', '.$player->pivot->team_id.')']) !!}
												<button type="submit" class="btn btn-danger ml-2"><i class='fa fa-times'></i> Remove</button>
												{!! Form::close() !!}
											@endif
										</div>
									</td>
								</tr>
							@endforeach
						@else
							@if(count($teams)==0)
								<tr>
									<td colspan="5"><h3 class="text-center">No teams to show</h3></td>
								</tr>
							@endif
							@foreach($teams as $team)
								<tr id="row-team-tournament-{{$team->id}}">
									<th scope="row">{{$team->id}}</th>
									<td scope="col">{!!$team->name_team!!}</td>
									<td scope="col" class="text-center lead-text">{{count($team->users)}}/{{$tournament->number_per_team}}</td>
									<td scope="col" class=" text-center">
										<div class="btn-group">
											{!! Form::open(['method'=>'get','url'=>route('team.players_team', array('tournament' =>$tournament->id, 'team' => $team->id)) ]) !!}
												<button class="btn btn-success"><i class='fa fa-eye'></i> View</button>
											{{ Form::close() }}
											@if ($userIsLanAdmin)
												{!! Form::open(['method' => 'get','url'=>route('team.join_list',$team->id) ]) !!}
													<button type="submit" class="btn btn-primary ml-2" {!! ($team->users->count()>=$tournament->number_per_team) ? 'title="The team if full" disabled' : '' !!}><i class="fa fa-user-plus"></i> Add players</button>
												{{ Form::close() }}
												{!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeTeam(event, '.$tournament->id.', '.$team->id.')']) !!}
													<button type="submit" class="btn btn-danger ml-2"><i class='fa fa-trash'></i> Delete</button>
												{!! Form::close() !!}
											@endif
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
