@extends('layouts.dashboard')

@section('content')
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col mt-2">
              <h3>Adding games to : {!!$lan->name!!}<small>#{{$lan->id}}</small></h3>
            </div>
          </div>
        </div>

        <div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
        <div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

        <div class="card-body">
          {!! Form::open(['method' => 'post','onsubmit'=>'return searchGames(event,'.$lan->id.')']) !!}
            <div>
              <h4>What's gaming, doc ?</h4>
              <div class="form-group">
                {!! Form::hidden('view_path', 'game.list_add_lan') !!}
                {!! Form::text('name_game', null, ['required'=>'', 'class' => 'form-control']) !!}
              </div>
            </div>
            <div class="form-group row text-center">
              <div class="col">
                <button type="submit" class="btn btn-outline-info shadow-sm"><i class='fa fa-search'></i> Search</button>
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
<div class="col besp text-right">
							<a class="btn btn-outline-info shadow-sm" href="{{ route('lan.show', $lan) }}"><i class='fa fa-arrow-left'></i> Go back to Lan</a>
						</div>
      </div>
@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/game/ajax_lan.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
