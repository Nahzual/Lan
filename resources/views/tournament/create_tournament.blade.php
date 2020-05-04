@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify_content_conter">
    <div class="col_md_8">
      <div class="card">
        <div class="card-headers">
          <h3 class="lead-title">{{$lan->name}} : Creating a new tournament</h3>
        </div>
        <div class="card_body">

          <div id="response-success" class="container alert alert-success mt-2" style="display:none"></div>
          <div id="response-error" class="container alert alert-danger mt-2" style="display:none"></div>

          {!! Form::open(['methode' => 'put', 'id' => 'CreateNewTournamentForm']) !!}
          <div class="bg-light">
            <div class="form-group">
              {!! Form::label('name_tournament', 'Name of tournament :', ['class' => 'lead']) !!}
              {!! Form::text('name_tournament', null, ['id'=>'name_tournament', 'class'=>'form-control']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('desc_tournament', 'Description of tournament :', ['class' => 'lead']) !!}
              {!! Form::text('desc_tournament', null, ['id'=>'desc_tournament', 'class'=>'form-control', 'size'=>'30x5']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('opening_date_tournament', 'Houre of begin tournament :', ['class' => 'lead']) !!}
              {!! Form::time('opening_date_tournament', null, ['id'=>'opening_date_tournament', 'min'=>'1', 'class'=>'form-control']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('max_player_count_tournament', 'Maximum number of players :', ['class' => 'lead']) !!}
              {!! Form::number('max_player_count_tournament', null, ['id'=>'max_player_count_tournament', 'class'=>'form-control']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('match_mod_tournament', 'Mod of tournament :', ['class' => 'lead']) !!}
              {!! Form::select('match_mod_tournament', array('0'=>'solo', '1'=>'equipes'), ['id'=>'match_mod_tournament', 'class'=>'form-control']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('id_game', 'Choose the game :', ['class'=>'lead']) !!}
              {!! Form::select('id_game', $games->pluck('name_game', 'id'), ['id'=>'id_game', 'class'=>'lead']) !!}
            </div>
          </div>

          <div class="form-group row text-center">
            <div class="col">
              <button type="submit" class="btn btn-primary" id="AddNewTournementSubmit"><i class="fa fa-plus-square"></i>create</button>
            </div>

            <div class="col">
              <a class="btn btn-primary" href="{{ route('lan.show',$lan) }}"><i class="fa fa-arrow-left"></i>Go back to show lan</a>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
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
