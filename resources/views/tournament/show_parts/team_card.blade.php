<div class="card">
  <div class="card-header" id="heading-team">
    <div class="row">
      <div class="col mt-2">
        <h4>Team</h4>
      </div>
      <div class="col">
        <button class="btn btn-outline-dark shadow-sm float-right ml-2" data-toggle="collapse" data-target="#tournament_teams" aria-expanded="false" aria-controls="tournament_teams">Show/hide</button>
        <a class="btn btn-success shadow-sm float-right ml-2" href="{{ route('team.create_team', $tournament->id) }}"><i class='fa fa-plus'></i></a>
      </div>
    </div>
  </div>
  <div class="collapse" id="tournament_teams" aria-labelledby="heading-team">
    <div class="card-body">
      <div class="table-responsive">
        <table class="text-center table card-table table-bordered">
          <thead class="card-table text-center">
          <th scope="col" >#</th>
          <th scope="col" >Name</th>
          @if($tournament->match_mod_tournament==1)
            <th scope="col" >Number</th>
          @endif
	<th scope="col" >Actions</th>
        </thead>

        <tbody>
        @if(count($teams)==0)
          <tr>
            <td colspan="5"><h3 class="text-center">No teams to show</h3></td>
          </tr>
        @endif
        @foreach($teams as $team)
          <tr id="row-team-tournament-{{$team->id}}">
            <th scope="row">{{$team->id}}</th>
            <td scope="col">{!!$team->name_team!!}</td>
                @if($tournament->match_mod_tournament==1)
                  <td scope="col" class="text-center">{{$team->number_of_member}}/{{$tournament->number_per_team}}</a></td>
                @endif
            <td scope="col" class=" text-center">
              <div class="btn-group">
                {!! Form::open(['onsubmit'=>'return false;']) !!}
                  <button class="btn btn-success mr-2" id="team-view-{{$team->id}}" onclick="openTeam({{$team->id}})"><i class='fa fa-eye'></i> View</button>
                {{ Form::close() }}

                @if ($userIsLanAdmin)
                  {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeTeam(event, '.$tournament->id.', '.$team->id.')']) !!}
                    <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> Delete</button>
                  {!! Form::close() !!}
		
                @endif
              </div>
		</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
@foreach($teams as $team)
  <div id="popup-team-{{$team->id}}" class="popup">
    <div class="popup-content">
      <span onclick="closeTeam({{$team->id}})" class="close">&times;</span>
      @include('team.show_team',$team)
    </div>
  </div>
@endforeach
