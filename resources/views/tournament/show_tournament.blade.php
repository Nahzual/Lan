@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
					<h3 class="lead-title">Viewing : tournament {{$tournament->name_tournament}}</h3>
				</div>
				<div class="card-body">
          <div class="row">
						<label class="lead col-3 mt-1 text-center">Game</label>
						<label class="form-control col-8">{{$game = $games->where('id', $tournament->id_game)->pluck('name_game')}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Name</label>
						<label class="form-control col-8">{{$tournament->name_tournament}}</label>
					</div>
          <div class="row">
						<label class="lead col-3 mt-1 text-center">Opening hour</label>
						<label class="form-control col-8">{{$tournament->opening_date_tournament}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Description</label>
						<label class="form-control col-8">{{$tournament->desc_tournament}}</label>
					</div>
          <div class="row">
						<label class="lead col-3 mt-1 text-center">Number of player subscride</label>
						<label class="form-control col-8">{{$tournament->player_count_tournament}}</label>
					</div>
          <div class="row">
						<label class="lead col-3 mt-1 text-center">Max of player</label>
						<label class="form-control col-8">{{$tournament->max_player_count_tournament}}</label>
					</div>
          <div class="row">
						<label class="lead col-3 mt-1 text-center">Mode of match tournament</label>
						<label class="form-control col-8">
              @if( $tournament->match_mod_tournament == 1 )
                equipes
              @else
                solo
              @endif
            </label>
					</div>
					<div class="form-group row text-center">
						@if(isset($userIsLanAdmin) && $userIsLanAdmin)
						<div class="col">
              <a class="btn btn-warning" href="{{ route('tournament.edit_tournament', array('lan' => $lan->id, 'tournament' => $tournament->id)) }}"><i class='fa fa-edit'></i> Edit</a>
						</div>
						@endif
						<div class="col">
							<a class="btn btn-primary" href="{{ route('lan.show', $lan) }}"><i class='fa fa-arrow-left'></i> Go back to Lan</a>
						</div>
					</div>
        </div>
			</div>
    </div>
  </div>
</div>
@endsection
