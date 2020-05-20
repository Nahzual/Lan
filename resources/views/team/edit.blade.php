@extends('layouts.dashboard')

@section('title')
Editing team {!! $team->name !!} of tournament {!! $tournament->name !!}
@endsection

@section('page-title')
Editing team
@endsection

@section('content')
<div id="response-success" class ="alert alert-success" style="display:none"></div>
<div id="response-error" class ="alert alert-danger" style="display:none"></div>

{!! Form::open(['method' => 'put', 'onsubmit'=>'return sendRequest(event,'.$tournament->id.','.$team->id.')']) !!}
	<div>
		<div class="form-group">
      {!! Form::label('name_team', 'Name of the team :', ['class' => 'display-6']) !!}
      {!! Form::text('name_team', $team->name_team, ['id'=>'name_team', 'class'=>'form-control']) !!}
		</div>
	</div>
	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn btn-outline-success shadow-sm"><i class='fa fa-edit'></i> Update</button>
		</div>

		<div class="col">
			<a class="btn btn-outline-info shadow-sm" href="{{ route('tournament.show_tournament', [$tournament->lan_id, $tournament]) }}"><i class='fa fa-arrow-left'></i> Go Back to Tournament</a>
		</div>
	</div>
{!! Form::close() !!}

@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/team/ajax_edit.js" defer></script>
@endsection
