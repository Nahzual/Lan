@extends('layouts.dashboard')

@section('title')
{{$tournament->name}} : Creating new Team
@endsection

@section('page-title')
Creating new Team
@endsection

@section('content')
<div id="response-success" class ="alert alert-success" style="display:none"></div>
<div id="response-error" class ="alert alert-danger" style="display:none"></div>

{!! Form::open(['method' => 'put', 'onsubmit'=>'return sendRequest(event,'.$tournament->id.')']) !!}
	<div>
		@if($tournament->number_per_team == 1)
		<div class="form-group">
      {!! Form::label('name_team', 'Your pseudo :', ['class' => 'display-6']) !!}
      {!! Form::text('name_team', $user->pseudo, ['id'=>'name_team', 'class'=>'display-6']) !!}
		</div>
		@else
		<div class="form-group">
      {!! Form::label('name_team', 'Name of team :', ['class' => 'display-6']) !!}
      {!! Form::text('name_team', null, ['id'=>'name_team', 'class'=>'form-control']) !!}
		</div>
	  @endif
    <div class="form-group">
      {!! Form::label('id_user', 'Personne who participate :', ['class' => 'display-6'])!!}
      {!! Form::label('id_user', $user->name, ['id'=>'id_user', 'class'=>'display-6']) !!}
		</div>
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

<script src=" http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
</script>
@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/team/ajax_create.js" defer></script>
@endsection
