@extends('layouts.dashboard')

@section('title')
{{ __('messages.teams_for_tournament') }} {{ $ntourn }}
@endsection

@section('page-title')
{{ __('messages.tournament_teams') }}
@endsection

@section('title-buttons')
	<div class="col mt-1">
		<form method="GET" action="{{ route('team.create_team', $tournamentId) }}">
			@csrf
			<button type="submit" class="btn btn-outline-success float-right"><i class='fa fa-plus-square'></i> {{ __('messages.add_team') }}</button>
		</form>
	</div>
@endsection

@section('content')

<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>


<div class="table-responsive">
	<table class="text-center table card-table table-bordered">
		<thead class="card-table text-center">
			<th scope="col" >#</th>
			<th scope="col" >{{ __('messages.name') }}</th>
      @if($tournament->match_mod_tournament==0)
			  <th scope="col" >{{ __('messages.member') }}r</th>
      @endif
		</thead>

		<tbody>
			@if(count($teams)==0)
			<tr>
				<td colspan="5"><h3 class="text-center">{{ __('messages.no_teams') }}</h3></td>
			</tr>
			@endif
			@foreach($teams as $team)
			<tr id="row-team-tournament-{{$team->id}}">
				<th scope="row">{{$team->id}}</th>
				<td scope="col">{!!$team->name_team!!}</td>
        @if(match_mod_tournament==0)
          <td scope="col">
            @foreach($team->users as $user)
              {{$user->name}}
            @endforeach
          </td>
        @endif
				<td scope="col" class=" text-center">
					<div class="btn-group">
						{!! Form::open(['onsubmit'=>'return false;']) !!}
							<button class="btn btn-success mr-2" id="team-view-{{$team->id}}" onclick="openTeam({{$team->id}})"><i class='fa fa-eye'></i> {{ __('messages.view') }}</button>
            {{ Form::close() }}
						@if ($userIsLanAdmin)
  						{!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeTeam(event, '.$tournament->id.', '.$team->id.')']) !!}
  							<button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> {{ __('messages.delete') }}</button>
  						{!! Form::close() !!}
						@endif
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>


<nav aria-label="page navigation">
	<ul class="pagination justify-content-end">
		<li class="page-item">
			<a class="btn btn-info" href="{{ url('/tournament/'.$tournamentId) }}" tabindex="-2"> {{ __('messages.back_tournament') }}</a>

			<li class="page-item">
				<a class="btn btn-secondary" href="{{ url('/tournament/'.$tournamentId.'/teams/') }}" tabindex="-2">{{ __('messages.first') }}</a>
			</li>
			<li class="page-item @if($previous == 0) disabled @endif">
				<a class="btn btn-outline-info" href="{{ $previous!=0 ?  url('/tournament/'.$tournamentId.'/teams/'.($previous)) : '#' }}" tabindex="-1">{{ __('messages.back') }}</a>
			</li>
			<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/tournament/'.$tournamentId.'/teams/'.($page)) }}">{{ $page }}</a></li>
			@if(($page+1)<=$max) <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/tournament/'.$tournamentId.'/teams/'.($page+1)) }}">{{ ($page+1) }}</a></li>@endif
			@if(($page+2)<=$max)<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/tournament/'.$tournamentId.'/teams/'.($page+2)) }}">{{ ($page+2) }}</a></li>@endif
			<li class="page-item @if($next) @else disabled @endif">
				<a class="btn btn-outline-info" href="{{ $next ? url('/tournament/'.$tournamentId.'/teams/'.($next)) : '#' }}">{{ __('messages.next') }}</a>
			</li>
			<li class="page-item">
				<a class="btn btn-secondary" href="{{ url('/tournament/'.$tournamentId.'/teams/'.$max) }}">{{ __('messages.last') }}</a>
			</li>
		</ul>
	</nav>

@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/team/ajax.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/team/team.css') }}" rel="stylesheet">
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
