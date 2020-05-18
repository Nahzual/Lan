
<div class="table-responsive">
  <table class="table card-table">
    <thead class="card-table text-center">
      <th scope="col" class="lead">#</th>
      <th scope="col" class="lead ">Name</th>
      <th scope="col" class="lead">Number_of_member</th>
      <th scope="col" class="lead">Member</th>
      <th scope="col" class="lead">Join tournament</th>
      @if($userIsLanAdmin) <th scope="col" class="lead "></th> @endif
    </thead>

    <tbody>
      @if(count($teams)==0)
      <tr>
        <td colspan="7"><h3 class="text-center">No Participants for the moment</h3></td>
      </tr>
      @else

        @foreach($teams as $team)

          <tr id="row-team-tournament-{{$team->id}}">
            <th scope="row" class="text-center lead-text">{{$team->id}}</th>
            <td scope="col" class="text-center lead-text">{{$team->name_team}}</a></td>
            <td scope="col" class="text-center lead-text">{{$team->number_of_member}}/{{$tournament->number_per_team}}</a></td>
            <td scope="col" class="text-center lead_text">
                @foreach($team->users as $user)
                  {{$user->name}}
                @endforeach
            @if($team->user_id == $user->id)
              <td scope="col" class="lead-text">
                {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeTeam(event,'.$tournament->id.','.$team->id.')']) !!}
                  <div class="form-group row text-center">
                    <div class="col">
                      <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> Delete participation</button>
                    </div>
                  </div>
                {!! Form::close() !!}
              </td>
            @else
              <td scope="col" class="">
                <button type="submit" class="btn btn-primary" id="AddNewTeamSubmit"><i class="fa fa-plus-square"></i>Join</button>
               </td>
            @endif
          </tr>
        @endforeach
    </tbody>
  </table>
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

@endif
