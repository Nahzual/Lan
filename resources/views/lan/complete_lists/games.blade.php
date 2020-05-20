@extends('layouts.dashboard')

@section('title')
{{ __('messages.all_game_lan') }} {!! $nlan !!}
@endsection

@section('page-title')
{{ __('messages.lan_game') }}
@endsection

@section('title-buttons')
@if($userIsLanAdmin)
<div class="col mt-1">
	<form method="GET" action="{{ route('lan.add_game', $id) }}">
		@csrf
		@method('GET')
		<button type="submit" class="btn btn-outline-dark float-right"><i class='fa fa-plus-square'></i> {{ __('messages.add_game') }}</button>
	</form>
</div>
@endif
@endsection

@section('content')


<div id="response-success-game" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error-game" class="alert alert-danger mt-2" style="display:none"></div>

<div class="table-responsive">
	<table class="table card-table">
		<thead class="card-table text-center">
			<th scope="col">#</th>
			<th scope="col">{{ __('messages.name') }}</th>
			<th scope="col">{{ __('messages.release_date') }}</th>
			<th scope="col">{{ __('messages.game_type') }}</th>
			@if($userIsLanAdmin) <th scope="col">{{ __('messages.used_ports') }}</th> <th scope="col">Actions</th> @endif
		</thead>

		<tbody>
			@if(count($games)==0)
			<tr>
				<td colspan="5"><h3 class="text-center">{{ __('messages.no_games') }}</h3></td>
			</tr>
			@endif

			@foreach($games as $index=>$game)
			<?php $date=date_create($game->release_date_game); ?>
			<tr id="row-game-lan-{{$game->id}}">
				<th scope="row" class="text-center ">{{$game->id}}</th>
				<td scope="col" class="text-center "><a href="{{ route('game.show', $game->id) }}">{{$game->name_game}}</a></td>
				<td scope="col" class="text-center ">{{date_format($date, config("display.DATE_FORMAT"))}}</td>
				<td scope="col" class="text-center ">
					<?php switch($game->is_multiplayer_game){
						case config('game.SOLO') : echo '1 player'; break;
						case config('game.MULTI_LOCAL') : echo 'Multiplayer local'; break;
						case config('game.MULTI_ONL') : echo 'Online Multiplayer'; break;
						default : break;
					} ?>
				</td>

				@if($userIsLanAdmin)
				<td scope="col" id="game-ports-{{$game->id}}">
					{{$game->ports_string($ports[$index])}}
				</td>
				<td scope="col">
					<div class="row text-center">
						<div class="col">
							<button class="btn btn-primary shadow-sm mb-2" onclick="openGame({{$game->id}})"><i class='fa fa-plus-square'></i> / <i class='fa fa-minus-square'></i> {{ __('messages.ports') }}</button>
						  {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeGame(event,'.$id.','.$game->id.')']) !!}
							<button type="submit" class="btn btn-danger"><i class='fa fa-times'></i> {{ __('messages.remove') }}</button>
						  {!! Form::close() !!}
						</div>
					</div>
				</td>
				@endif
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<nav aria-label="page navigation">
	<ul class="pagination justify-content-end">
		<li class="page-item">
			<a class="btn btn-info" href="{{ url('/lan/'.$id) }}" tabindex="-2">{{ __('messages.back_lan') }}</a>
		</i>

		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/lan/'.$id.'/games/') }}" tabindex="-2">{{ __('messages.first') }}</a>
		</li>
		<li class="page-item @if($previous == 0) disabled @endif">
			<a class="btn btn-outline-info" href="{{ $previous!=0 ?  url('/lan/'.$id.'/games/'.($previous)) : '#' }}" tabindex="-1">{{ __('messages.back') }}</a>
		</li>
		<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/games/'.($page)) }}">{{ $page }}</a></li>
		@if(($page+1)<=$max) <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/games/'.($page+1)) }}">{{ ($page+1) }}</a></li>@endif
		@if(($page+2)<=$max)<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/games/'.($page+2)) }}">{{ ($page+2) }}</a></li>@endif
		<li class="page-item @if($next) @else disabled @endif">
			<a class="btn btn-outline-info" href="{{ $next ? url('/lan/'.$id.'/games/'.($next)) : '#' }}">{{ __('messages.next') }}</a>
		</li>
		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/lan/'.$id.'/games/'.$max) }}">{{ __('messages.last') }}</a>
		</li>
	</ul>
</nav>
				@foreach($games as $game)
				<div id="popup-game-{{$game->id}}" class="popup">
					<div class="popup-content">
						<span onclick="closeGame({{$game->id}})" class="close">&times;</span>
						@include('game.add_port_list',[$game,$id])
					</div>
				</div>
				@endforeach
@endsection

@section('js_includes')
<script src="{{ asset('js/ajax/lan/ajax_remove_game.js') }} "></script>
<script src="{{ asset('js/windows/game/add_port_window.js') }} "></script>
<script src="{{ asset('js/ajax/game/ajax_port.js') }} "></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/game/game.css') }}" rel="stylesheet">
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
<link href="{{ asset('css/popup.css') }}" rel="stylesheet">
@endsection
