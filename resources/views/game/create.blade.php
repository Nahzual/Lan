@extends('layouts.dashboard')

@section('title')
{{ __('messages.add_new_game') }}
@endsection

@section('page-title')
{{ __('messages.add_new_game') }}
@endsection

@section('content')
<div class ="alert alert-success" id="response-success" style="display:none"></div>
<div class ="alert alert-danger" id="response-error" style="display:none"></div>

{!! Form::open(['method' => 'put', 'onsubmit'=>'return sendRequest(event)']) !!}
	<div>
		<div class="form-group">
			{!! Form::label('name_game', __('messages.name') , ['class' => 'display-6']) !!}
			{!! Form::text('name_game', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('desc_game', __('messages.description') , ['class' => 'display-6']) !!}
			{!! Form::textarea('desc_game', null, ['class' => 'form-control','size'=>'30x5']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('release_date_game', {{ __('messages.release_date') }}, ['class' => 'display-6']) !!}
			{!! Form::date('release_date_game', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('cost_game',  __('messages.price') , ['class' => 'display-6']) !!}
			{!! Form::number('cost_game', null, ['min'=>'0', 'class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('is_multiplayer_game', __('messages.game_type') , ['class' => 'display-6']) !!}
			{!! Form::select('is_multiplayer_game', [config('game.SOLO') => '1 player', config('game.MULTI_LOCAL') => 'Local multiplayer', config('game.MULTI_ONL')=>'Online multiplayer'], null, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn  btn-outline-success shadow-sm"><i class='fa fa-plus-square'></i> {{ __('messages.add') }}</button>
		</div>

		<div class="col">
			<a class="btn  btn-outline-info shadow-sm" href="{{ route('game.index') }}"><i class='fa fa-arrow-left'></i> {{ __('messages.back_game') }}</a>
		</div>
	</div>
{!! Form::close() !!}
@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/game/ajax_create.js" defer></script>
@endsection
