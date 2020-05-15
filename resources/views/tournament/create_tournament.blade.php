@extends('layouts.dashboard')

@section('title')
{{$lan->name}} : Creating new Tournament
@endsection

@section('page-title')
Creating new Tournament
@endsection

@section('content')
<div id="response-success" class ="alert alert-success" style="display:none"></div>
<div id="response-error" class ="alert alert-danger" style="display:none"></div>

{!! Form::open(['methode' => 'put', 'id' => 'CreateNewTournamentForm']) !!}
<div>
  <div class="form-group">
    {!! Form::label('name_tournament', 'Name of tournament :', ['class' => 'display-6']) !!}
    {!! Form::text('name_tournament', null, ['id'=>'name_tournament', 'class'=>'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('desc_tournament', 'Description of tournament :', ['class' => 'display-6']) !!}
    {!! Form::text('desc_tournament', null, ['id'=>'desc_tournament', 'class'=>'form-control', 'size'=>'30x5']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('opening_date_tournament', 'Houre of begin tournament :', ['class' => 'display-6']) !!}
    {!! Form::time('opening_date_tournament', null, ['id'=>'opening_date_tournament', 'min'=>'1', 'class'=>'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('max_player_count_tournament', 'Maximum number of players :', ['class' => 'display-6']) !!}
    {!! Form::number('max_player_count_tournament', null, ['id'=>'max_player_count_tournament', 'class'=>'form-control']) !!}
  </div>
  <div class="form-group">
    <label for="match_mod_tournament">Mod of tournament</label>
    <select id="match_mod_tournament" name="match_mod_tournament" onchange="changementType();">
      <option value="0">solo</option>
      <option value="1">equipes</option>
    </select>
    <!--{!! Form::label('match_mod_tournament', 'Mod of tournament :', ['class' => 'lead']) !!}
    {!! Form::select('match_mod_tournament', array('0'=>'solo', '1'=>'equipes'), ['id'=>'match_mod_tournament', 'class'=>'form-control']) !!}-->
  </div>
  <div class="form-group" id="number" style="display:none">
    <label for="number_per_team">Number per team</label>
    <input type="number" id="number_per_team" name="number_per_team" value="1">
    <!--{!! Form::label('number_per_team', 'Number per team :', ['class' => 'lead']) !!}
    {!! Form::number('number_per_team', '1', ['id'=>'number_per_team', 'class'=>'form-control']) !!}-->
  </div>
  <div class="form-group">
    {!! Form::label('id_game', 'Choose the game :', ['class'=>'display-6']) !!}
    {!! Form::select('id_game', $games->pluck('name_game', 'id'), ['id'=>'id_game', 'class'=>'lead']) !!}
  </div>
</div>

<div class="form-group row text-center">
  <div class="col">
    <button type="submit" class="btn btn-outline-success shadow-sm" id="AddNewTournementSubmit"><i class="fa fa-plus-square"></i>Add</button>
  </div>

  <div class="col">
    <a class="btn btn-outline-info shadow-sm" href="{{ route('lan.show',$lan) }}"><i class="fa fa-arrow-left"></i>Go back to Lan</a>
  </div>
</div>
{!! Form::close() !!}

<script>
  function changementType() {
    var match_mod_tournament = document.getElementById("match_mod_tournament").value;
    var div = document.getElementById("number");
    if (match_mod_tournament == "1") {
    div.style="display:block";
    } else {
    div.style="display:none";
    }
  }
</script>
<script src=" http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
</script>
<script>
	$(document).ready(function(){
		$('#AddNewTournementSubmit').click(function(e){
			e.preventDefault();
			$.ajaxSetup({
				headers:{
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: "{{ route('tournament.store', $lan) }}",
				method: 'post',
				data: {
					name_tournament: $('#name_tournament').val(),
					desc_tournament: $('#desc_tournament').val(),
					opening_date_tournament: $('#opening_date_tournament').val(),
					match_mod_tournament: $('#match_mod_tournament').val(),
          number_per_team: $('#number_per_team').val(),
					id_game: $('#id_game').val(),
					max_player_count_tournament: $('#max_player_count_tournament').val(),
				},
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
@endsection
