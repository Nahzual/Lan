<div class="card">
  <div class="card-header text-center">
    <div class="row lead">
      <div class="col-1">#</div>
      <div class="col-2">Name</div>
      <div class="col-2">Release date</div>
      <div class="col-1">Cost</div>
      <div class="col-2">Game type</div>
      <div class="col-2"></div>
      <div class="col-2"></div>
    </div>
  </div>
  <div class="card-body text-center">
    @if(count($games)==0)
      <h3 class="text-center">No games to show</h3>
    @endif
    @foreach($games as $game)
    <div class="row">
      <div class="col-1 mt-2 lead-text">{{$game->id}}</div>
      <div class="col-2 mt-2 lead-text">{{$game->name_game}}</div>
      <div class="col-2 mt-2 lead-text">{{$game->release_date_game}}</div>
      <div class="col-1 mt-2 lead-text">{{$game->cost_game}}</div>
      <div class="col-2 mt-2 lead-text">
        <?php switch($game->is_multiplayer_game){
          case config('game.SOLO') : echo '1 player'; break;
          case config('game.MULTI_LOCAL') : echo 'Multiplayer local'; break;
          case config('game.MULTI_ONL') : echo 'Online Multiplayer'; break;
          default : break;
        } ?>
      </div>

      <div class="col-2 mt-2 lead-text">
        <a class="btn btn-success" href="{{ route('game.show', $game->id) }}"><i class='fa fa-eye'></i> View</a>
      </div>
      <?php if(!$favorite_games->contains($game)){ ?>
        <div class="col-2 mt-2 lead-text">
          {!! Form::open(['method' => 'post','url'=>'', 'onsubmit'=>'return addGameToFavorite(event,'.$game->id.')']) !!}
            <div class="form-group row text-center">
              <div class="col">
                <button type="submit" class="btn btn-primary"><i class='fa fa-star'></i> Mark as favorite</button>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      <?php }else{ ?>
        <div class="col-2 mt-2 lead-text">
          {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeGameFromFavorite(event,'.$game->id.')']) !!}
            <div class="form-group row text-center">
              <div class="col">
                <button type="submit" class="btn btn-warning"><i class='fa fa-star-o'></i> Unmark</button>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      <?php } ?>

    </div>
    <br>
    @endforeach
  </div>
</div>
