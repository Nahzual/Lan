<div class="card">

@if ($userIsLanAdmin)
  <div class="card-header">
    <h3 class="float-left mt-2">{{ __('messages.about') }}</h3>
    {!! Form::open(['onsubmit'=>'return false;']) !!}
    <a class="btn btn-primary float-right" href="{{ route('tournament.tree', array('lan' => $lan->id, 'tournament' => $tournament->id)) }}"><i class='fa fa-plus'></i> {{ __('messages.tree') }}</a>	{{ Form::close() }}
  </div>
@endif  

  <div class="card-body">
		@if(isset($teams))
    <div class="row">
      <label class="col-md-2 col-form-label text-md-right">{{ __('messages.nb_players') }}</label>
      <label class="form-control col-8 h-100">{{$players_count}}/{{$tournament->max_player_count_tournament}}</label>
    </div>
		@else
		<div class="row">
			<label class="col-md-2 col-form-label text-md-right">{{ __('messages.nb_players') }}</label>
			<label class="form-control col-8 h-100">{{$players->count()}}/{{$tournament->max_player_count_tournament}}</label>
		</div>
		@endif
    <div class="row">
      <label class="col-md-2 col-form-label text-md-right">{{ __('messages.game') }}</label>
      <label class="form-control col-8 h-100">{{$game->name_game}}</label>
    </div>
    <div class="row">
      <label class="col-md-2 col-form-label text-md-right">{{ __('messages.name') }}</label>
      <label class="form-control col-8 h-100">{{$tournament->name_tournament}}</label>
    </div>
    <div class="row">
      <label class="col-md-2 col-form-label text-md-right">{{ __('messages.date') }}</label>
      <label class="form-control col-8 h-100">{{$tournament->opening_date_tournament}}</label>
    </div>
    <div class="row">
      <label class="col-md-2 col-form-label text-md-right">{{ __('messages.description') }}</label>
      <label class="form-control col-8 h-100">{{$tournament->desc_tournament}}</label>
    </div>
    <div class="row">
      <label class="col-md-2 col-form-label text-md-right">{{ __('messages.tournament_mode') }}</label>
      <label class="form-control col-8 h-100">
        @if( $tournament->match_mod_tournament == 1 )
          {{ __('messages.teams') }}
        @else
          {{ __('messages.solo') }}
        @endif
      </label>
    </div>
    @if( $tournament->match_mod_tournament == 1 )
      <div class="row">
        <label class="col-md-2 col-form-label text-md-right">{{ __('messages.nb_players_team') }}</label>
        <label class="form-control col-8 h-100">{{$tournament->number_per_team}}</label>
      </div>
    @endif
    <div class="form-group row text-center">
      @if(isset($userIsLanAdmin) && $userIsLanAdmin)
      <div class="col">
        <a class="btn btn-warning" href="{{ route('tournament.edit_tournament', array('lan' => $lan->id, 'tournament' => $tournament->id)) }}"><i class='fa fa-edit'></i> {{ __('messages.edit') }}</a>
      </div>
      @endif
      <div class="col">
        <a class="btn btn-primary" href="{{ route('lan.show', $lan) }}"><i class='fa fa-arrow-left'></i> {{ __('messages.back_lan') }}</a>
      </div>
    </div>
  </div>
