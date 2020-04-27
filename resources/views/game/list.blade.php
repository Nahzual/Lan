
<div class="table-responsive">
  <table class="table card-table">
    <thead class="card-table text-center">
      <th scope="col" class="lead">#</th>
      <th scope="col" class="lead ">Name</th>
      <th scope="col" class="lead">Release date</th>
      <th scope="col" class="lead ">Cost</th>
      <th scope="col" class="lead ">Game type</th>
      <th scope="col" class="lead "></th>
      <th scope="col" class="lead "></th>
      @if(isset($user) && $user->rank_user==config('ranks.SITE_ADMIN')) <th scope="col" class="lead"></th> @endif

    </thead>

    <tbody>
      @if(count($games)==0)
      <tr>
        <td colspan="7"><h3 class="text-center">No games to show</h3></td>
      </tr>
      @endif

      @foreach($games as $game)
      <?php $date=date_create($game->release_date_game); ?>
      <tr>
        <th scope="row" class="lead-text">{{$game->id}}</th>
        <td scope="col" class="lead-text">{{$game->name_game}}</td>
        <td scope="col" class="lead-text">{{date_format($date, config("display.DATE_FORMAT"))}}</td>
        <td scope="col" class="lead-text">{{$game->cost_game}} €</td>
        <td scope="col" class="lead-text">
          <?php switch($game->is_multiplayer_game){
            case config('game.SOLO') : echo '1 player'; break;
            case config('game.MULTI_LOCAL') : echo 'Multiplayer local'; break;
            case config('game.MULTI_ONL') : echo 'Online Multiplayer'; break;
            default : break;
          } ?>
        </td>

        <td scope="col" class="lead-text">
          <a class="btn btn-success" href="{{ route('game.show', $game->id) }}"><i class='fa fa-eye'></i> View</a>
        </td>

        <!-- if there may be games that are not in the user's favourite list, and $game is not in this list, display a form to mark the game as favourite -->
        <?php if(isset($favourite_games) && !$favourite_games->contains($game)){ ?>
          <td scope="col" class="lead-text">
            {!! Form::open(['method' => 'post','url'=>'', 'onsubmit'=>'return addGameToFavourite(event,'.$game->id.')']) !!}
              <div class="form-group row text-center">
                <div class="col">
                  <button type="submit" class="btn btn-primary"><i class='fa fa-star'></i> Mark</button>
                </div>
              </div>
            {!! Form::close() !!}
          </td>
          <!-- else display a form to remove the game from the favourite list -->
        <?php }else{ ?>
          <td scope="col" class="lead-text">
            {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeGameFromFavourite(event,'.$game->id.')']) !!}
              <div class="form-group row text-center">
                <div class="col">
                  <button type="submit" class="btn btn-warning"><i class='fa fa-star-o'></i> Unmark</button>
                </div>
              </div>
            {!! Form::close() !!}
          </td>
        <?php } ?>

        @if(isset($user) && $user->rank_user==config('ranks.SITE_ADMIN'))
          <td scope="col" class="lead-text">
            {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return deleteGame(event,'.$game->id.')']) !!}
              <div class="form-group row text-center">
                <div class="col">
                  <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> Delete</button>
                </div>
              </div>
            {!! Form::close() !!}
          </td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
