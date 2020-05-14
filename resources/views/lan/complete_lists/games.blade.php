@extends('layouts.dashboard')

@section('title')
All the games for the LAN {{ $nlan }}
@endsection

@section('page-title')
LAN's games
@endsection

@section('title-buttons')
@if($userIsLanAdmin)
<div class="col mt-1">
	<form method="GET" action="{{ route('lan.add_game', $id) }}">
		@csrf
		@method('GET')
		<button type="submit" class="btn btn-outline-dark float-right"><i class='fa fa-plus-square'></i> Find new games</button>
	</form>
</div>
@endif
@endsection

@section('content')


<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>



<div class="table-responsive">
	<table class="table card-table">
		<thead class="card-table text-center">
			<th scope="col">#</th>
			<th scope="col">Name</th>
			<th scope="col">Release date</th>
			<th scope="col">Game type</th>
			@if($userIsLanAdmin) <th scope="col">Actions</th> @endif
		</thead>

		<tbody>
			@if(count($games)==0)
			<tr>
				<td colspan="5"><h3 class="text-center">No games to show</h3></td>
			</tr>
			@endif

			@foreach($games as $game)
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
				<td scope="col">
					{!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeGame(event,'.$id.','.$game->id.')']) !!}
					<div class="form-group row text-center">
						<div class="col">
							<button type="submit" class="btn btn-danger"><i class='fa fa-times'></i> Delete</button>
						</div>
					</div>
					{!! Form::close() !!}
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
			<a class="btn btn-info" href="{{ url('/lan/'.$id) }}" tabindex="-2">Return to the LAN</a>
		</i>

		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/lan/'.$id.'/games/') }}" tabindex="-2">First</a>
		</li>
		<li class="page-item @if($previous == 0) disabled @endif">
			<a class="btn btn-outline-info" href="{{ $previous!=0 ?  url('/lan/'.$id.'/games/'.($previous)) : '#' }}" tabindex="-1">Back</a>
		</li>
		<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/games/'.($page)) }}">{{ $page }}</a></li>
		@if(($page+1)<=$max) <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/games/'.($page+1)) }}">{{ ($page+1) }}</a></li>@endif
		@if(($page+2)<=$max)<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/games/'.($page+2)) }}">{{ ($page+2) }}</a></li>@endif
		<li class="page-item @if($next) @else disabled @endif">
			<a class="btn btn-outline-info" href="{{ $next ? url('/lan/'.$id.'/games/'.($next)) : '#' }}">Next</a>
		</li>
		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/lan/'.$id.'/games/'.$max) }}">Last</a>
		</li>
	</ul>
</nav>
@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/game/ajax.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/game/game.css') }}" rel="stylesheet">
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
