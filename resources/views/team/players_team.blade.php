@extends('layouts.dashboard')

@section('title')
All the players of the team {{ $team->name_team }}
@if(count($users)<$tournament->number_per_team)
{!! Form::open(['onsubmit'=>'return false;']) !!}
	<button type="submit" class="btn btn-primary float-right" id="AddNewTeamSubmit" onclick="document.location.reload(false)"><i class="fa fa-plus-square"></i> Join</button>
{{ Form::close() }}
@endif

@endsection

@section('page-title')
Participants of team
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
		</thead>

		<tbody>

			@if(count($users)==0)
			<tr>
				<td colspan="3"><h3>No players to show</h3></td>
			</tr>
			@endif

			@foreach($users as $user)
			<tr id="row-user-lan-{{$user->id}}">
				<th>{{$user->id}}</th>
				<td>{!!$user->pseudo!!}</td>
				<td>{!!$user->name!!}</td>
				<td scope="col" class="text-center">
					<div class="btn-group text-center">
						{!! Form::open(['method' => 'delete','onsubmit'=>'return removeTeam(event,'.$team->id.','.$user->id.')']) !!}
						<button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i></button>
						{!! Form::close() !!}
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="col">
            <a class="btn btn-outline-info shadow-sm" href="{{ route('tournament.show_tournament', [$tournament->lan_id, $tournament]) }}"><i class='fa fa-arrow-left'></i> Go Back to Tournament</a>
</div>
@endsection


@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection

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
