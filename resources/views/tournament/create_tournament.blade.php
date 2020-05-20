@extends('layouts.dashboard')

@section('title')
{!! $lan->name !!} : {{ __('messages.create_new_tournament') }}
@endsection

@section('page-title')
{{ __('messages.create_new_tournament') }}
@endsection

@section('content')
<div id="response-success" class ="alert alert-success" style="display:none"></div>
<div id="response-error" class ="alert alert-danger" style="display:none"></div>

{!! Form::open(['methode' => 'put', 'id' => 'CreateNewTournamentForm']) !!}
<div>
  <div class="form-group">
    {!! Form::label('name_tournament', __('messages.tournament_name'), ['class' => 'display-6']) !!}
    {!! Form::text('name_tournament', null, ['id'=>'name_tournament', 'class'=>'form-control','required'=>'']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('desc_tournament', __('messages.tournament_description'), ['class' => 'display-6']) !!}
    {!! Form::text('desc_tournament', null, ['id'=>'desc_tournament', 'class'=>'form-control', 'size'=>'30x5','required'=>'']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('opening_date_tournament', __('messages.date') , ['class' => 'display-6']) !!}
    {!! Form::time('opening_date_tournament', null, ['id'=>'opening_date_tournament', 'min'=>'1', 'class'=>'form-control','required'=>'']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('max_player_count_tournament', __('messages.max_nb_player') , ['class' => 'display-6']) !!}
    {!! Form::number('max_player_count_tournament', null, ['id'=>'max_player_count_tournament', 'class'=>'form-control','required'=>'']) !!}
  </div>
  <div class="form-group">
    <label for="match_mod_tournament">{{ __('messages.tournament_mode') }}</label>
    <select id="match_mod_tournament" class="form-control" name="match_mod_tournament" onchange="changementType();" required>
      <option value="0">{{ __('messages.solo') }}</option>
      <option value="1">{{ __('messages.teams') }}</option>
    </select>

  </div>
  <div class="form-group" id="number" style="display:none">
    <label for="number_per_team">{{ __('messages.nb_players_team') }}</label>
    <input type="number" class="form-control" id="number_per_team" name="number_per_team" value="1">

  </div>
  <div class="form-group">
    {!! Form::label('id_game', __('messages.choose_game'), ['class'=>'display-6']) !!}
    {!! Form::select('id_game', $games->pluck('name_game', 'id'), null,['class'=>'form-control','required'=>'']) !!}
  </div>
</div>

<div class="form-group row text-center">
  <div class="col">
    <button type="submit" class="btn btn-outline-success shadow-sm" id="AddNewTournementSubmit"><i class="fa fa-plus-square"></i> {{ __('messages.add') }}</button>
  </div>

  <div class="col">
    <a class="btn btn-outline-info shadow-sm" href="{{ route('lan.show',$lan) }}"><i class="fa fa-arrow-left"></i> {{ __('messages.back_lan') }}</a>
  </div>
</div>
{!! Form::close() !!}

<script type="text/javascript" src="/js/ajax/tournament/ajax_create.js"></script>

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
