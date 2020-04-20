@extends('layouts.app')

@section('content')
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
						<label class="form-control col-8">{{$game->desc_game}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Release Date</label>
						<label class="form-control col-8">{{$game->release_date_game}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Price</label>
						<label class="form-control col-8">{{$game->cost_game}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">type de jeu</label>
						<label class="form-control col-8">{{$game->is_multiplayer_game}}</label>
					</div>
					
					<div class="form-group row text-center">
						<div class="col">
							<a class="btn btn-primary" href="{{ route('game.edit', $game->id) }}"><i class='fa fa-edit'></i> Edit</a>
						</div>
						<div class="col">
								<a class="btn btn-primary" href="{{ route('lan.index') }}"><i class='fa fa-arrow-left'></i> Go back to Lan List</a>
						</div>
					</div>
                </div>
			</div>
        </div>
    </div>
</div>
@endsection
