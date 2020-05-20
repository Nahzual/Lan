
<div class="table-responsive col">
  <table class="table card-table">
    <thead class="card-table text-center">
      <th scope="col">#</th>
      <th scope="col">{{ __('messages.name') }}</th>
      <th scope="col">{{ __('messages.release_date') }}</th>
      <th scope="col">{{ __('messages.price') }}</th>
      <th scope="col">{{ __('messages.game_type') }}</th>
      <th scope="col">{{ __('messages.actions') }}</th>
    </thead>

    <tbody>
      @if(count($games)==0)
      <tr>
        <td colspan="7"><h3 class="text-center">{{ __('messages.no_games3') }}</h3></td>
      </tr>
      @endif

      @foreach($games as $game)
      <?php $date=date_create($game->release_date_game); ?>
      <tr id="row-game-{{$game->id}}">
        <th scope="row " class="text-center">{{$game->id}}</th>
        <td scope="col ">{!!$game->name_game!!}</td>
        <td scope="col " class="text-center">{{date_format($date, config("display.DATE_FORMAT"))}}</td>
        <td scope="col" class="text-center">{{$game->cost_game}} €</td>
        <td scope="col " class="text-center">
          <?php switch($game->is_multiplayer_game){
            case config('game.SOLO') : echo '1 player'; break;
            case config('game.MULTI_LOCAL') : echo 'Multiplayer local'; break;
            case config('game.MULTI_ONL') : echo 'Online Multiplayer'; break;
            default : break;
          } ?>
        </td>

        <td scope="col" class="text-center">
          <a class="mb-2 btn btn-success" href="{{ route('game.show', $game->id) }}"><i class='fa fa-eye'></i> {{ __('messages.view') }}</a>

        <?php $game_isnt_favourite=isset($favourite_games) && !$favourite_games->contains($game); ?>
          {!! Form::open(['method' => 'post','url'=>'', 'id'=>'game-mark-'.$game->id, 'style'=>(!$game_isnt_favourite) ? 'display: none;' : 'display: block;','onsubmit'=>'return addGameToFavourite(event,'.$game->id.')']) !!}
          	<button type="submit" class="btn btn-primary mb-2"><i class='fa fa-star'></i> {{ __('messages.mark') }}</button>
          {!! Form::close() !!}

          {!! Form::open(['method' => 'delete','url'=>'', 'id'=>'game-unmark-'.$game->id,'style'=>($game_isnt_favourite) ? 'display: none;' : 'display: block;', 'onsubmit'=>'return removeGameFromFavourite(event,'.$game->id.')']) !!}
            <button type="submit" class="btn btn-warning mb-2"><i class='fa fa-star-o'></i> {{ __('messages.unmark') }}</button>
          {!! Form::close() !!}

        @if(isset($logged_user) && $logged_user->isSiteAdmin())
        {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return deleteGame(event,'.$game->id.')']) !!}
          <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> {{ __('messages.delete') }}</button>
        {!! Form::close() !!}
        @endif
	</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
