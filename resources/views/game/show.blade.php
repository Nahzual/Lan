@extends('layouts.app')

@section('content')
<?php $date=date_create($game->release_date_game); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					<h3 class="lead-title">Viewing : {{$game->name_game}}</h3>
				</div>

				<div class="card-body">
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Name</label>
						<label class="form-control col-8">{{$game->name_game}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Description of the game</label>
						<label class="h-25 form-control col-8"><?php echo nl2br($game->desc_game) ?></label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Release Date</label>
						<label class="form-control col-8">{{date_format($date, config("display.DATE_FORMAT"))}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Price</label>
						<label class="form-control col-8">{{$game->cost_game}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Game type</label>
						<label class="form-control col-8"><?php if($game->is_multiplayer_game==config('game.SOLO')) echo '1 player'; else if($game->is_multiplayer_game==config('game.MULTI_LOCAL')) echo 'Multiplayer local'; else echo 'Online multiplayer';?></label>
					</div>

					<div class="form-group row text-center">
            @if($user->rank_user==config('ranks.SITE_ADMIN'))
						<div class="col">
							<a class="btn btn-primary" href="{{ route('game.edit', $game->id) }}"><i class='fa fa-edit'></i> Edit</a>
						</div>
            @endif
						<div class="col">
								<a class="btn btn-primary" href="{{ route('game.index') }}"><i class='fa fa-arrow-left'></i> Go to Game List</a>
						</div>
					</div>
                </div>
			</div>
        </div>
    </div>
</div>
@endsection
