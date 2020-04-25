@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col mt-2">
              <h3 class="lead-title">Games</h3>
            </div>
            @if($user->rank_user==config('ranks.SITE_ADMIN'))
              <div class="col mt-1">
                <form method="GET" action="{{ route('game.create') }}">
                @csrf
                @method('GET')
                  <button type="submit" class="btn btn-primary float-right"><i class='fa fa-plus-square'></i> Create a new game</button>
                </form>
              </div>
            @endif
          </div>
        </div>


        <div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
        <div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

        <div class="card-body">
          {!! Form::open(['method' => 'post','onsubmit'=>'return searchGames(event)']) !!}
            <div class="bg-light">
              <h4 class='lead'>Game's name :</h4>
              <div class="form-group">
                {!! Form::hidden('view_path', 'game.list') !!}
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
          <?php if(!isset($favourite_games)){
            $favourite_games=[];
          }?>
          @include('game.list')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/game/ajax.js"></script>
<script defer="defer" type="text/javascript" src="/js/responsive/game/responsive.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/game/game.css') }}" rel="stylesheet">
@endsection
