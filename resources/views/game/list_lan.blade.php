
<div class="table-responsive">
  <table class="table card-table">
    <thead class="card-table text-center">
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Release date</th>
      <th scope="col">Game type</th>
      @if($userIsLanAdmin) <th scope="col">Actions</th> @endif
    </thead>

    <tbody>
      @if(count($games)==0)
      <tr>
        <td colspan="5"><h3 class="text-center">No games to show</h3></td>
      </tr>
      @endif

      @foreach($games as $game)
      <?php $date=date_create($game->release_date_game); ?>
      <tr id="row-game-lan-{{$game->id}}">
        <th scope="row" class="text-center ">{{$game->id}}</th>
        <td scope="col" class="text-center "><a href="{{ route('game.show', $game->id) }}">{{$game->name_game}}</a></td>
        <td scope="col" class="text-center ">{{date_format($date, config("display.DATE_FORMAT"))}}</td>
        <td scope="col" class="text-center ">
          <?php switch($game->is_multiplayer_game){
            case config('game.SOLO') : echo '1 player'; break;
            case config('game.MULTI_LOCAL') : echo 'Multiplayer local'; break;
            case config('game.MULTI_ONL') : echo 'Online Multiplayer'; break;
            default : break;
          } ?>
        </td>

        @if($userIsLanAdmin)
        <td scope="col">
          {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeGame(event,'.$lan->id.','.$game->id.')']) !!}
            <div class="form-group row text-center">
              <div class="col">
                <button type="submit" class="btn btn-warning"><i class='fa fa-times'></i> Remove</button>
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
