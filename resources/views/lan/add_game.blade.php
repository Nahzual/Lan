@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col mt-2">
              <h3 class="lead-title">Adding games to : {{$lan->name}}<small>#{{$lan->id}}</small></h3>
            </div>
          </div>
        </div>

        <div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
        <div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

        <div class="card-body">
          {!! Form::open(['method' => 'post','onsubmit'=>'return searchGames(event,'.$lan->id.')']) !!}
            <div class="bg-light">
              <h4 class='lead'>Game's name :</h4>
              <div class="form-group">
                {!! Form::hidden('view_path', 'game.list_add_lan') !!}
                {!! Form::text('name_game', null, ['required'=>'', 'class' => 'form-control']) !!}
              </div>
            </div>
            <div class="form-group row text-center">
              <div class="col">
                <button type="submit" class="btn btn-primary"><i class='fa fa-search'></i> Search</button>
              </div>
            </div>
          {!! Form::close() !!}
        </div>

        <div id="request-result">
          <?php if(!isset($games)){
            $games=[];
          }?>
          @include('game.list_add_lan')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/game/ajax_lan.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
