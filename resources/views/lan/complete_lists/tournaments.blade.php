@extends('layouts.dashboard')

@section('title')
All tournaments for the LAN {{ $nlan }}
@endsection

@section('page-title')
Games
@endsection

@section('title-buttons')
@if ($userIsLanAdmin)
	<div class="col mt-1">
		<form method="GET" action="{{ route('tournament.create_tournament', $id) }}">
			@csrf
			@method('GET')
			<button type="submit" class="btn btn-outline-success float-right"><i class='fa fa-plus-square'></i> Add a tournament</button>
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
			<th scope="col" >Game</th>
			<th scope="col">Hour</th>
			<th scope="col" >Actions</th>
		</thead>

		<tbody>
			@if(count($tournaments)==0)
			<tr>
				<td colspan="5"><h3 class="text-center">No tournaments to show</h3></td>
			</tr>
			@endif

			@foreach($tournaments as $tournament)
			<tr id="row-tournament-lan-{{$tournament->id}}">
				<th scope="row" class="text-center">{{$tournament->id}}</th>
				<td scope="col" class="text-center ">{{$tournament->name_tournament}}</a></td>
				<td scope="col" class="text-center ">{{ substr(($tournament->desc_tournament), 0, 50) }}</td>
				<td scope="col" class="text-center">{{ $tournament->opening_date_tournament }}</td>


				<td scope="col" class=" text-center">
					<div class="btn-group">
						<a class="btn btn-success" href="{{ route('tournament.show_tournament', array('lan' => $id, 'tournament' => $tournament->id)) }}"><i class='fa fa-eye'></i></a>

						@if(isset($userIsLanAdmin) && $userIsLanAdmin)
						<a class="btn btn-warning" href="{{ route('tournament.edit_tournament', array('lan' => $id, 'tournament' => $tournament->id)) }}"><i class='fa fa-edit'></i></a>

						{!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeTournament(event,'.$id.','.$tournament->id.')']) !!}

						<button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i></button>
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
		</li>

		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/lan/'.$id.'/tournaments/') }}" tabindex="-2">First</a>
		</li>
		<li class="page-item @if($previous == 0) disabled @endif">
			<a class="btn btn-outline-info" href="{{ $previous!=0 ?  url('/lan/'.$id.'/tournaments/'.($previous)) : '#' }}" tabindex="-1">Back</a>
		</li>
		<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/tournaments/'.($page)) }}">{{ $page }}</a></li>
		@if(($page+1)<=$max) <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/tournaments/'.($page+1)) }}">{{ ($page+1) }}</a></li>@endif
		@if(($page+2)<=$max)<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/tournaments/'.($page+2)) }}">{{ ($page+2) }}</a></li>@endif
		<li class="page-item @if($next) @else disabled @endif">
			<a class="btn btn-outline-info" href="{{ $next ? url('/lan/'.$id.'/tournaments/'.($next)) : '#' }}">Next</a>
		</li>
		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/lan/'.$id.'/tournaments/'.$max) }}">Last</a>
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
