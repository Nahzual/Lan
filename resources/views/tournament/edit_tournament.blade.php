@extends('layouts.dashboard')

@section('title')
Editing Tournament : {!!$tournament->name!!}
@endsection

@section('page-title')
Editing Tournament
@endsection

@section('content')

<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

{!! Form::model($tournament, ['method' => 'put', 'onsubmit' => 'return sendRequest(event,'.$lan->id.','.$tournament->id.')']) !!}
	<div>
    <div class="form-group">
      {!! Form::label('is_finished_tournament', 'State of tournament :', ['class' => 'display-6']) !!}
      {!! Form::select('is_finished_tournament', array('0'=>'Not finished', '1'=>'Finished'), null,['id'=>'is_finished_tournament', 'class'=>'form-control']) !!}

		</div>
    <div class="form-group">
			{!! Form::label('name_tournament', 'Name', ['class' => 'display-6']) !!}
			{!! Form::text('name_tournament', null, ['class' => 'form-control']) !!}
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
      {!! Form::label('id_game', 'Choose the game :', ['class'=>'display-6']) !!}
      {!! Form::select('id_game', $games->pluck('name_game', 'id'),null, ['id'=>'id_game', 'class'=>'form-control']) !!}
		</div>
		<div class="form-group">
			<label for="match_mod_tournament">Mode of tournament</label>
			<select id="match_mod_tournament" class="form-control" name="match_mod_tournament" onchange="changementType();" required>
				<option value="{{config('tournament.SOLO')}}" {{ ($tournament->match_mod_tournament==config('tournament.SOLO')) ? 'selected' : '' }}>Solo</option>
				<option value="{{config('tournament.TEAM')}}" {{ ($tournament->match_mod_tournament==config('tournament.TEAM')) ? 'selected' : '' }}>Teams</option>
			</select>
		</div>

		<div class="form-group" id="number" style="{{ ($tournament->match_mod_tournament==config('tournament.SOLO')) ? 'display: none;' : '' }}">
			<label for="number_per_team">Number of players per team</label>
			<input type="number" class="form-control" id="number_per_team" name="number_per_team" value="{{$tournament->number_per_team}}">
		</div>
	</div>
	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn btn-outline-warning shadow-sm"><i class='fa fa-edit'></i> Update</button>
		</div>
		<div class="col">
			<a class="btn btn-outline-info shadow-sm" href="{{ route('lan.show', $lan) }}"><i class='fa fa-arrow-left'></i> Go Back to Lan</a>
		</div>
	</div>
{!! Form::close() !!}
@endsection

@section('js_includes')
<script src="/js/ajax/tournament/ajax_edit.js"></script>
<script src="/js/ajax/tournament/ajax_create.js"></script>
@endsection
