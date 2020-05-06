@extends('layouts.dashboard')

@section('content')
<?php $date=date_create($game->release_date_game); ?>
      <div class="card">
        <div class="card-header">
					<h3>Viewing : {{$game->name_game}}</h3>
				</div>

				<div class="card-body">
					<div class="row d-flex justify-content-center">
						<label class="col-md-2 col-form-label text-md-right">Name</label>
						<label class="h-100 form-control col-8">{{$game->name_game}}</label>
					</div>
					<div class="row d-flex justify-content-center">
						<label class="col-md-2 col-form-label text-md-right">Description of the game</label>
						<label class="h-100 form-control col-8"><?php echo nl2br($game->desc_game) ?></label>
					</div>
					<div class="row d-flex justify-content-center">
						<label class="col-md-2 col-form-label text-md-right">Release Date</label>
						<label class="h-100 form-control col-8">{{date_format($date, config("display.DATE_FORMAT"))}}</label>
					</div>
					<div class="row d-flex justify-content-center">
						<label class="col-md-2 col-form-label text-md-right">Price</label>
						<label class="h-100 form-control col-8">{{$game->cost_game}}</label>
					</div>
					<div class="row d-flex justify-content-center">
						<label class="col-md-2 col-form-label text-md-right">Game type</label>
						<label class="h-100 form-control col-8"><?php if($game->is_multiplayer_game==config('game.SOLO')) echo '1 player'; else if($game->is_multiplayer_game==config('game.MULTI_LOCAL')) echo 'Multiplayer local'; else echo 'Online multiplayer';?></label>
					</div>

          <div id="response-success" class="container alert alert-success mt-2" style="display:none"></div>
          <div id="response-error" class="container alert alert-danger mt-2" style="display:none"></div>

					<div class="mt-5 form-group row text-center">
            @if($user->rank_user==config('ranks.SITE_ADMIN'))
						<div class="col">
							<a class="btn btn-outline-warning shadow-sm" href="{{ route('game.edit', $game->id) }}"><i class='fa fa-edit'></i> Edit</a>
						</div>
            <div class="col">
              {{ Form::open([ 'method'  => 'delete', 'url'=>'', 'onsubmit'=>'return sendRequest(event,'.$game->id.')' ]) }}
                {{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Delete', ['class' => 'btn btn-outline-danger shadow-sm', 'type' => 'submit']) }}
              {{ Form::close() }}
            </div>
            @endif
						<div class="col">
							<a class="btn  btn-outline-info shadow-sm" href="{{ route('game.index') }}"><i class='fa fa-arrow-left'></i> Return to the game list</a>
						</div>
					</div>
        </div>
			</div>
@endsection

@section('js_includes')
<script src="/js/ajax/game/ajax_delete.js"></script>
@endsection
