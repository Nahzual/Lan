@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col mt-2">
              <h3 class="lead-title">Editing tournament : {{$tournament->name}}</h3>
            </div>
          </div >
        </div>

        <div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
        <div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

        <div class="card-body">
      {!! Form::model($tournament, ['method' => 'put', 'onsubmit' => 'return sendRequest(event,'.$lan->id.','.$tournament->id.')']) !!}
      <div class="bg-light">
        @if(isset($userIsLanAdmin) && $userIsLanAdmin)
        <div class="col">
          {!! Form::label('is_finished_tournament', 'Check if tournament is finished :', ['class' => 'lead']) !!}
          {!! Form::select('is_finished_tournament', array('1'=>'is finished'), ['id'=>'is_finished_tournament', 'class'=>'form-control']) !!}
        </div>
        @endif
        <div class="form-group">
          {!! Form::label('name_tournament', 'Name of tournament :', ['class' => 'lead']) !!}
          {!! Form::text('name_tournament', null, ['id'=>'name_tournament', 'class'=>'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('desc_tournament', 'Description of tournament :', ['class' => 'lead']) !!}
          {!! Form::text('desc_tournament', null, ['id'=>'desc_tournament', 'class'=>'form-control', 'size'=>'30x5']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('opening_date_tournament', 'Houre of begin tournament :', ['class' => 'lead']) !!}
          {!! Form::time('opening_date_tournament', null, ['id'=>'opening_date_tournament', 'min'=>'1', 'class'=>'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('max_player_count_tournament', 'Maximum number of players :', ['class' => 'lead']) !!}
          {!! Form::number('max_player_count_tournament', null, ['id'=>'max_player_count_tournament', 'class'=>'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('match_mod_tournament', 'Mod of tournament :', ['class' => 'lead']) !!}
          {!! Form::select('match_mod_tournament', array('0'=>'solo', '1'=>'equipes'), ['id'=>'match_mod_tournament', 'class'=>'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('id_game', 'Choose the game :', ['class'=>'lead']) !!}
          {!! Form::select('id_game', $games->pluck('name_game', 'id'), ['id'=>'id_game', 'class'=>'lead']) !!}
        </div>
      </div>

        <div class="form-group row text-center">
          <div class="col">
            <button type="submit" class="btn btn-primary"><i class='fa fa-edit'></i> Update</button>
          </div>
          <div class="col">
            <a class="btn btn-primary" href="{{ route('lan.show', $lan) }}"><i class='fa fa-arrow-left'></i> Go Back to Lan</a>
          </div>
        </div>
           {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js_includes')
<script src="/js/ajax/tournament/ajax_edit.js"></script>
@endsection
