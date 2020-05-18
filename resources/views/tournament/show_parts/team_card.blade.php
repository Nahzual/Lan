<div class="card">
  <div class="card-header" id="heading-team">
    <div class="row">
      @if($tournament->match_mod_tournament==1)
      <div class="col mt-2">
        <h4>Teams</h4>
      </div>
      @endif
      @if($tournament->match_mod_tournament==0)
      <div class="col mt-2">
        <h4>Players</h4>
      </div>
      @endif
      <div class="col">
        <button class="btn btn-outline-dark shadow-sm float-right ml-2" data-toggle="collapse" data-target="#tournament_teams" aria-expanded="false" aria-controls="tournament_teams">Show/hide</button>
        @if($teams->count() < $tournament->max_player_count_tournament)
          <a class="btn btn-success shadow-sm float-right ml-2" href="{{ route('team.create_team', $tournament->id) }}"><i class='fa fa-plus'></i></a>
        @endif
      </div>
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
          @if($tournament->match_mod_tournament==1)
            <th scope="col" >Number</th>
            <th scope="col" >Show</th>
          @endif
        </thead>

        <tbody>
        @if(count($teams)==0)
          <tr>
            @if($tournament->match_mod_tournament==1)
            <td colspan="5"><h3 class="text-center">No teams to show</h3></td>
            @endif
            @if($tournament->match_mod_tournament==0)
            <td colspan="5"><h3 class="text-center">No players to show</h3></td>
            @endif
          </tr>
        @endif
        @foreach($teams as $team)
          <tr id="row-team-tournament-{{$team->id}}">
            <th scope="row">{{$team->id}}</th>
            <td scope="col">{!!$team->name_team!!}</td>
                @if($tournament->match_mod_tournament==1)
                  <td scope="col" class="text-center lead-text">{{$team->number_of_member}}/{{$tournament->number_per_team}}</a></td>
                @endif
                <td scope="col" class=" text-center">
                  <div class="btn-group">
                    @if($tournament->match_mod_tournament==1)
                    {!! Form::open(['onsubmit'=>'return false;']) !!}
                                      <a class="btn btn-success" href="{{ route('team.players_team', array('tournament' =>$tournament->id, 'team' => $team->id)) }}"><i class='fa fa-eye'></i></a>
                                    {{ Form::close() }}
                      {!! Form::open(['onsubmit'=>'return false;']) !!}
                      <button type="submit" class="btn btn-primary" id="AddNewTeamSubmit" onclick="document.location.reload(false)"><i class="fa fa-plus-square"></i> Join</button>
                      {{ Form::close() }}
                    @endif
                    @if ($userIsLanAdmin)
                     {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeTeam(event, '.$tournament->id.', '.$team->id.')']) !!}
                        <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> Delete</button>
                      {!! Form::close() !!}
                    @endif
                  </div>
                </td>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>


<script src=" http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
</script>
<script>
    $(document).ready(function(){
        $('#AddNewTeamSubmit').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('team.joinTeam',$team) }}",
                method: 'post',
                success: function(result){
                    if(result.success!=undefined){
                        $('#response-success').show();
                        $('#response-success').html(result.success);
                    }else{
                        $('#response-error').show();
                        $('#response-error').html(result.error);
                    }
                }
            });
        });
    });
</script>
