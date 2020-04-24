<?php
if(isset($user) && $user->rank_user==config('ranks.SITE_ADMIN')) $col_size=1;
else $col_size=2;
?>

<div class="card">
  <div class="card-header text-center">
    <div class="row lead">
      <div class="col-1">#</div>
      <div class="col-2">Name</div>
      <div class="col-2">Release date</div>
      <div class="col-1">Cost</div>
      <div class="col-2">Game type</div>
      <div class="col-{{ $col_size }}"></div>
      <div class="col-{{ $col_size }}"></div>
      @if(isset($user) && $user->rank_user==config('ranks.SITE_ADMIN')) <div class="col-{{ $col_size }}"></div> @endif

    </div>
  </div>
  <div class="card-body text-center">
    @if(count($games)==0)
      <h3 class="text-center">No games to show</h3>
    @endif

    @foreach($games as $game)
    <?php $date=date_create($game->release_date_game); ?>
    <div class="row">
      <div class="col-1 mt-2 lead-text">{{$game->id}}</div>
      <div class="col-2 mt-2 lead-text">{{$game->name_game}}</div>
      <div class="col-2 mt-2 lead-text">{{date_format($date, config("display.DATE_FORMAT"))}}</div>
      <div class="col-1 mt-2 lead-text">{{$game->cost_game}} €</div>
      <div class="col-2 mt-2 lead-text">
        <?php switch($game->is_multiplayer_game){
          case config('game.SOLO') : echo '1 player'; break;
          case config('game.MULTI_LOCAL') : echo 'Multiplayer local'; break;
          case config('game.MULTI_ONL') : echo 'Online Multiplayer'; break;
          default : break;
        } ?>
      </div>

      <div class="col-{{ $col_size }} mt-2 lead-text">
        <a class="btn btn-success" href="{{ route('game.show', $game->id) }}"><i class='fa fa-eye'></i> View</a>
      </div>

      <!-- if there may be games that are not in the user's favourite list, and $game is not in this list, display a form to mark the game as favourite -->
      <?php if(isset($favourite_games) && !$favourite_games->contains($game)){ ?>
        <div class="col-{{ $col_size }} mt-2 lead-text">
          {!! Form::open(['method' => 'post','url'=>'', 'onsubmit'=>'return addGameToFavourite(event,'.$game->id.')']) !!}
            <div class="form-group row text-center">
              <div class="col">
                <button type="submit" class="btn btn-primary"><i class='fa fa-star'></i> Mark</button>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
        <!-- else display a form to remove the game from the favourite list -->
      <?php }else{ ?>
        <div class="col-{{ $col_size }} mt-2 lead-text">
          {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeGameFromFavourite(event,'.$game->id.')']) !!}
            <div class="form-group row text-center">
              <div class="col">
                <button type="submit" class="btn btn-warning"><i class='fa fa-star-o'></i> Unmark</button>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      <?php } ?>

      @if(isset($user) && $user->rank_user==config('ranks.SITE_ADMIN'))
        <div class="col-{{ $col_size }} mt-2 lead-text">
          {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return deleteGame(event,'.$game->id.')']) !!}
            <div class="form-group row text-center">
              <div class="col">
                <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> Delete</button>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      @endif
    </div>
    <br>
    @endforeach
  </div>
</div>
