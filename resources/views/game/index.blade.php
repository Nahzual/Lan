@extends('layouts.dashboard')

@section('title')
{{ __('messages.games') }}
@endsection

@section('page-title')
{{ __('messages.games') }}
@endsection

@section('title-buttons')
	@if($logged_user->isSiteAdmin())
		<div class="col mt-1">
			<form method="GET" action="{{ route('game.create') }}">
			@csrf
			@method('GET')
				<button type="submit" class="btn  btn-outline-success shadow-sm float-right"><i class='fa fa-plus-square'></i> {{ __('create_new_game') }}</button>
			</form>
		</div>
	@endif
@endsection

@section('content')
<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

{!! Form::open(['method' => 'post','onsubmit'=>'return searchGames(event)']) !!}
	<div>
		<h4 >{{ __('messages.no_games2') }}</h4>
		<div class="form-group">
			{!! Form::hidden('view_path', 'game.list') !!}
			{!! Form::text('name_game', null, ['required'=>'', 'class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn  btn-outline-info shadow-sm"><i class='fa fa-search'></i> {{ __('messages.search') }}</button>
		</div>
	</div>
{!! Form::close() !!}

<div id="request-result">
	<?php if(!isset($games)){
		$games=[];
	}?>
	<?php if(!isset($favourite_games)){
		$favourite_games=[];
	}?>
	@include('game.list')
</div>
@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/game/ajax.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/game/game.css') }}" rel="stylesheet">
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
