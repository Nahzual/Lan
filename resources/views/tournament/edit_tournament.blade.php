@extends('layouts.dashboard')

@section('title')
{{ __('messages.edit_tournament') }} : {!!$tournament->name!!}
@endsection

@section('page-title')
{{ __('messages.edit_tournament') }}
@endsection

@section('content')

<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

{!! Form::model($tournament, ['method' => 'put', 'onsubmit' => 'return sendRequest(event,'.$lan->id.','.$tournament->id.')']) !!}
	<div>
    <div class="form-group">
      {!! Form::label('is_finished_tournament', __('messages.tournament_state'), ['class' => 'display-6']) !!}
      {!! Form::select('is_finished_tournament', array('0'=>'Not finished', '1'=>'Finished'), ['id'=>'is_finished_tournament', 'class'=>'form-control']) !!}

		</div>
    <div class="form-group">
			{!! Form::label('name_tournament', __('messages.name'), ['class' => 'display-6']) !!}
			{!! Form::text('name_tournament', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
      {!! Form::label('desc_tournament', __('messages.tournament_description'), ['class' => 'display-6']) !!}
      {!! Form::text('desc_tournament', null, ['id'=>'desc_tournament', 'class'=>'form-control', 'size'=>'30x5']) !!}
		</div>
    <div class="form-group">
      {!! Form::label('opening_date_tournament', __('messages.date'), ['class' => 'display-6']) !!}
      {!! Form::time('opening_date_tournament', null, ['id'=>'opening_date_tournament', 'min'=>'1', 'class'=>'form-control']) !!}
		</div>
    <div class="form-group">
      {!! Form::label('max_player_count_tournament', __('messages.max_nb_player'), ['class' => 'display-6']) !!}
      {!! Form::number('max_player_count_tournament', null, ['id'=>'max_player_count_tournament', 'class'=>'form-control']) !!}
		</div>
    <div class="form-group">
      {!! Form::label('id_game', __('messages.choose_game'), ['class'=>'display-6']) !!}
      {!! Form::select('id_game', $games->pluck('name_game', 'id'), ['id'=>'id_game', 'class'=>'lead']) !!}
		</div>
	</div>
	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn btn-outline-warning shadow-sm"><i class='fa fa-edit'></i> {{ __('messages.update') }}</button>
		</div>
		<div class="col">
			<a class="btn btn-outline-info shadow-sm" href="{{ route('lan.show', $lan) }}"><i class='fa fa-arrow-left'></i> {{ __('messages.back_lan') }}</a>
		</div>
	</div>
{!! Form::close() !!}
@endsection

@section('js_includes')
<script src="/js/ajax/tournament/ajax_edit.js"></script>
@endsection
