<div class="card">
  <div class="card-header">
    <h3 class="float-left mt-2">About</h3>
  </div>

  <div class="card-body">
    <div class="row">
      <label class="col-md-2 col-form-label text-md-right">Player tournament</label>
      <label class="form-control col-8 h-100">{{$teams->count()}}/{{$tournament->max_player_count_tournament}}</label>
    </div>
    <div class="row">
      <label class="col-md-2 col-form-label text-md-right">Game</label>
      <label class="form-control col-8 h-100">{{$game = $games->where('id', $tournament->id_game)->pluck('name_game')}}</label>
    </div>
    <div class="row">
      <label class="col-md-2 col-form-label text-md-right">Name</label>
      <label class="form-control col-8 h-100">{{$tournament->name_tournament}}</label>
    </div>
    <div class="row">
      <label class="col-md-2 col-form-label text-md-right">Opening hour</label>
      <label class="form-control col-8 h-100">{{$tournament->opening_date_tournament}}</label>
    </div>
    <div class="row">
      <label class="col-md-2 col-form-label text-md-right">Description</label>
      <label class="form-control col-8 h-100">{{$tournament->desc_tournament}}</label>
    </div>
    <div class="row">
      <label class="col-md-2 col-form-label text-md-right">Mode of match tournament</label>
      <label class="form-control col-8 h-100">
        @if( $tournament->match_mod_tournament == 1 )
          equipes
        @else
          solo
        @endif
      </label>
    </div>
    @if( $tournament->match_mod_tournament == 1 )
      <div class="row">
        <label class="col-md-2 col-form-label text-md-right">Number per team</label>
        <label class="form-control col-8 h-100">{{$tournament->number_per_team}}</label>
      </div>
    @endif
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
