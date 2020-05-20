@extends('layouts.dashboard')

@section('title')
{{ __('messages.edit_tournament') }} : {!!$tournament->name_tournament!!}
@endsection

@section('page-title')
{{ __('messages.edit_tournament') }}
@endsection

@section('content')

<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

{!! Form::model($tournament, ['method' => 'put', 'onsubmit' => 'return sendRequest(event,'.$lan->id.','.$tournament->id.')']) !!}
	<div>
    <div class="form-group">
      {!! Form::label('is_finished_tournament', __('messages.tournament_state'), ['class' => 'display-6']) !!}
      {!! Form::select('is_finished_tournament', array('0'=>'Not finished', '1'=>'Finished'), null,['id'=>'is_finished_tournament', 'class'=>'form-control']) !!}
		</div>
    <div class="form-group">
			{!! Form::label('name_tournament', __('messages.name'), ['class' => 'display-6']) !!}
			{!! Form::text('name_tournament', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
      {!! Form::label('desc_tournament', __('messages.tournament_description'), ['class' => 'display-6']) !!}
      {!! Form::text('desc_tournament', null, ['id'=>'desc_tournament', 'class'=>'form-control', 'size'=>'30x5']) !!}
		</div>
    <div class="form-group">
      {!! Form::label('opening_date_tournament', __('messages.date'), ['class' => 'display-6']) !!}
      {!! Form::time('opening_date_tournament', null, ['id'=>'opening_date_tournament', 'min'=>'1', 'class'=>'form-control','step'=>'1']) !!}
		</div>
    <div class="form-group">
      {!! Form::label('max_player_count_tournament', __('messages.max_nb_player'), ['class' => 'display-6']) !!}
      {!! Form::number('max_player_count_tournament', null, ['id'=>'max_player_count_tournament', 'class'=>'form-control']) !!}
		</div>
    <div class="form-group">
      {!! Form::label('id_game', __('messages.choose_game'), ['class'=>'display-6']) !!}
      {!! Form::select('id_game', $games->pluck('name_game', 'id'),null, ['id'=>'id_game', 'class'=>'form-control']) !!}
		</div>
		<div class="form-group">
			<label for="match_mod_tournament">{{ __('messages.tournament_mode') }}</label>
			<select id="match_mod_tournament" class="form-control" name="match_mod_tournament" onchange="changementType();" required>
				<option value="{{config('tournament.SOLO')}}" {{ ($tournament->match_mod_tournament==config('tournament.SOLO')) ? 'selected' : '' }}>{{ __('messages.solo') }}</option>
				<option value="{{config('tournament.TEAM')}}" {{ ($tournament->match_mod_tournament==config('tournament.TEAM')) ? 'selected' : '' }}>{{ __('messages.teams') }}</option>
			</select>
		</div>

		<div class="form-group" id="number" style="{{ ($tournament->match_mod_tournament==config('tournament.SOLO')) ? 'display: none;' : '' }}">
			<label for="number_per_team">{{ __('messages.nb_players_team') }}</label>
			<input type="number" class="form-control" id="number_per_team" name="number_per_team" value="{{$tournament->number_per_team}}">
		</div>
	</div>
	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn btn-outline-warning shadow-sm"><i class='fa fa-edit'></i> {{ __('messages.update') }}</button>
		</div>
		<div class="col">
			<a class="btn btn-outline-info shadow-sm" href="{{ route('lan.show', $lan) }}"><i class='fa fa-arrow-left'></i> {{ __('messages.back_lan') }}</a>
		</div>
	</div>
{!! Form::close() !!}
@endsection

@section('js_includes')
<script src="/js/ajax/tournament/ajax_edit.js"></script>
<script src="/js/ajax/tournament/ajax_create.js"></script>
@endsection
