
<div class="table-responsive">
  <table class="table card-table">
    <thead class="card-table text-center">
      <th scope="col" class="lead">#</th>
      <th scope="col" class="lead ">Name</th>
      <th scope="col" class="lead">Release date</th>
      <th scope="col" class="lead">Cost</th>
      <th scope="col" class="lead ">Game type</th>
      <th scope="col" class="lead "></th>
    </thead>

    <tbody>
      @if(count($games)==0)
      <tr>
        <td colspan="6"><h3 class="text-center">No games to show</h3></td>
      </tr>
      @endif

      @foreach($games as $game)
      <?php $date=date_create($game->release_date_game); ?>
      <tr>
        <th scope="row" class="text-center lead-text">{{$game->id}}</th>
        <td scope="col" class="text-center lead-text"><a href="{{ route('game.show', $game->id) }}">{{$game->name_game}}</a></td>
        <td scope="col" class="text-center lead-text">{{date_format($date, config("display.DATE_FORMAT"))}}</td>
        <td scope="col" class="text-center lead-text">{{$game->cost_game}}</td>
        <td scope="col" class="text-center lead-text">
          <?php switch($game->is_multiplayer_game){
            case config('game.SOLO') : echo '1 player'; break;
            case config('game.MULTI_LOCAL') : echo 'Multiplayer local'; break;
            case config('game.MULTI_ONL') : echo 'Online Multiplayer'; break;
            default : break;
          } ?>
        </td>

        <td scope="col" class="lead-text">
          {!! Form::open(['method' => 'post','url'=>'', 'onsubmit'=>'return addGame(event,'.$lan->id.','.$game->id.')']) !!}
            <div class="form-group row text-center">
              <div class="col">
                <button type="submit" class="btn btn-success"><i class='fa fa-plus-square'></i> Add game</button>
              </div>
            </div>
          {!! Form::close() !!}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>