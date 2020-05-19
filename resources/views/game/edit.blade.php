@extends('layouts.dashboard')

@section('title')
Editing Game : {!!$game->name_game!!}
@endsection

@section('page-title')
Editing Game
@endsection

@section('content')
<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

{!! Form::model($game, ['method' => 'put', 'onsubmit' => 'return sendRequest(event,'.$game->id.')']) !!}
	<div>
		<div class="form-group">
			{!! Form::label('name_game', __('messages.name') , ['class' => 'display-6']) !!}
			{!! Form::text('name_game', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('desc_game', __('messages.description'), ['class' => 'display-6']) !!}
			{!! Form::textarea('desc_game', null, ['class' => 'form-control','size'=>'30x5']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('release_date_game', __('messages.release_date'), ['class' => 'display-6']) !!}
			{!! Form::date('release_date_game', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('cost_game', __('messages.price), ['class' => 'display-6']) !!}
			{!! Form::number('cost_game', null, ['min'=>'0', 'class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('is_multiplayer_game', __('messages.game_type'), ['class' => 'display-6']) !!}
			{!! Form::select('is_multiplayer_game', [config('game.SOLO') => '1 player', config('game.MULTI_LOCAL') => 'Local multiplayer', config('game.MULTI_ONL')=>'Online multiplayer'], $game->is_multiplayer_game, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn btn-outline-warning"><i class='fa fa-edit'></i> {{ __('messages.update') }}</button>
		</div>
	</div>
{!! Form::close() !!}
@endsection

@section('js_includes')
<script src="/js/ajax/game/ajax_edit.js"></script>
@endsection
