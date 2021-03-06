@extends('layouts.dashboard')

@section('title')
{{ __('messages.viewing') }} : {!!$game->name_game!!}
@endsection

@section('page-title')
{{ __('messages.game') }}
@endsection


@section('content')
<?php $date=date_create($game->release_date_game); ?>
<div class="row d-flex justify-content-center">
	<label class="col-md-2 col-form-label text-md-right">{{ __('messages.name') }}</label>
	<label class="h-100 form-control col-8">{!!$game->name_game!!}</label>
</div>
<div class="row d-flex justify-content-center">
	<label class="col-md-2 col-form-label text-md-right">{{ __('messages.description') }}</label>
	<label class="h-100 form-control col-8"><?php echo nl2br($game->desc_game) ?></label>
</div>
<div class="row d-flex justify-content-center">
	<label class="col-md-2 col-form-label text-md-right">{{ __('messages.release_date') }}</label>
	<label class="h-100 form-control col-8">{{date_format($date, config("display.DATE_FORMAT"))}}</label>
</div>
<div class="row d-flex justify-content-center">
	<label class="col-md-2 col-form-label text-md-right">{{ __('messages.price') }}</label>
	<label class="h-100 form-control col-8">{{$game->cost_game}}</label>
</div>
<div class="row d-flex justify-content-center">
	<label class="col-md-2 col-form-label text-md-right">{{ __('messages.game_type') }}</label>
	<label class="h-100 form-control col-8"><?php if($game->is_multiplayer_game==config('game.SOLO')) echo '1 player'; else if($game->is_multiplayer_game==config('game.MULTI_LOCAL')) echo 'Multiplayer local'; else echo 'Online multiplayer';?></label>
</div>

<div id="response-success" class="container alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="container alert alert-danger mt-2" style="display:none"></div>

<div class="mt-5 form-group row text-center">
	@if($logged_user->isSiteAdmin())
	<div class="col">
		<a class="btn btn-outline-warning shadow-sm" href="{{ route('game.edit', $game->id) }}"><i class='fa fa-edit'></i> {{ __('messages.edit') }}</a>
	</div>
	<div class="col">
		{{ Form::open([ 'method'  => 'delete', 'url'=>'', 'onsubmit'=>'return sendRequest(event,'.$game->id.')' ]) }}
			{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Delete', ['class' => 'btn btn-outline-danger shadow-sm', 'type' => 'submit']) }}
		{{ Form::close() }}
	</div>
	@endif
	<div class="col">
		<a class="btn  btn-outline-info shadow-sm" href="{{ route('game.index') }}"><i class='fa fa-arrow-left'></i> {{ __('messages.back_game') }}</a>
	</div>
</div>
@endsection

@section('js_includes')
<script src="/js/ajax/game/ajax_delete.js"></script>
@endsection
