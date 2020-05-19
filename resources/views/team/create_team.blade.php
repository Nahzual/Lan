@extends('layouts.dashboard')

@section('title')
{!!$tournament->name_tournament!!} : Creating new Team
@endsection

@section('page-title')
Creating new Team
@endsection

@section('content')
<div id="response-success" class ="alert alert-success" style="display:none"></div>
<div id="response-error" class ="alert alert-danger" style="display:none"></div>

{!! Form::open(['method' => 'put', 'onsubmit'=>'return sendRequest(event,'.$tournament->id.')']) !!}
	<div>
		@if($tournament->match_mod_tournament==config('tournament.SOLO'))
		<div class="form-group">
			<h4>You can\'t create teams for this tournament, as the match mode of this tournament is solo.</h4>
		</div>
		@else
		<div class="form-group">
      {!! Form::label('name_team', 'Name of the team :', ['class' => 'display-6']) !!}
      {!! Form::text('name_team', null, ['id'=>'name_team', 'class'=>'form-control']) !!}
		</div>
	  @endif
	</div>
	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn btn-outline-success shadow-sm"><i class='fa fa-plus-square'></i> Add</button>
		</div>

		<div class="col">
			<a class="btn btn-outline-info shadow-sm" href="{{ route('tournament.show_tournament', [$tournament->lan_id, $tournament]) }}"><i class='fa fa-arrow-left'></i> Go Back to Tournament</a>
		</div>
	</div>
{!! Form::close() !!}

@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/team/ajax_create.js" defer></script>
@endsection
