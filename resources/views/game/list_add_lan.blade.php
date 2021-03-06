
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
        <td colspan="6"><h3 class="text-center">{{ __('messages.no_game') }}</h3></td>
      </tr>
      @endif

      @foreach($games as $game)
      <?php $date=date_create($game->release_date_game); ?>
      <tr>
        <th scope="row" class="text-center">{{$game->id}}</th>
        <td scope="col" class="text-center"><a href="{{ route('game.show', $game->id) }}">{!!$game->name_game!!}</a></td>
        <td scope="col" class="text-center">{{date_format($date, config("display.DATE_FORMAT"))}}</td>
        <td scope="col" class="text-center">{{$game->cost_game}}</td>
        <td scope="col" class="text-center">
          <?php switch($game->is_multiplayer_game){
            case config('game.SOLO') : echo '1 player'; break;
            case config('game.MULTI_LOCAL') : echo 'Multiplayer local'; break;
            case config('game.MULTI_ONL') : echo 'Online Multiplayer'; break;
            default : break;
          } ?>
        </td>

        <td scope="col">
          {!! Form::open(['method' => 'post','url'=>'', 'onsubmit'=>'return addGame(event,'.$lan->id.','.$game->id.')']) !!}
            <div class="form-group row text-center">
              <div class="col">
                <button type="submit" class="btn btn-success"><i class='fa fa-plus-square'></i> {{ __('messages.add_game') }}</button>
              </div>
            </div>
          {!! Form::close() !!}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
