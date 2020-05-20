
<div class="table-responsive">
  <table class="table card-table">
    <thead class="card-table text-center">
      <th scope="col">#</th>
      <th scope="col">{{ __('messages.name') }}</th>
      <th scope="col">{{ __('messages.release_date') }}</th>
      <th scope="col">{{ __('messages.game_type') }}</th>
			@if(isset($userIsLanAdmin) && $userIsLanAdmin)
			<th scope="col">{{ __('messages.used_ports') }}</th>
      <th scope="col">{{ __('messages.actions') }}</th>
			@endif
    </thead>

    <tbody>
      @if(count($games)==0)
      <tr>
        <td colspan="6"><h3 class="text-center">{{ __('messages.no_games') }}</h3></td>
      </tr>
      @endif

      @foreach($games as $index=>$game)
      <?php $date=date_create($game->release_date_game); ?>
      <tr id="row-game-lan-{{$game->id}}">
        <th scope="row" class="text-center ">{{$game->id}}</th>
        <td scope="col" class="text-center "><a href="{{ route('game.show', $game->id) }}">{!!$game->name_game!!}</a></td>
        <td scope="col" class="text-center ">{{date_format($date, config("display.DATE_FORMAT"))}}</td>
        <td scope="col" class="text-center ">
          <?php switch($game->is_multiplayer_game){
            case config('game.SOLO') : echo '1 player'; break;
            case config('game.MULTI_LOCAL') : echo 'Multiplayer local'; break;
            case config('game.MULTI_ONL') : echo 'Online Multiplayer'; break;
            default : break;
          } ?>
        </td>

        @if(isset($userIsLanAdmin) && $userIsLanAdmin)
				<td scope="col" id="game-ports-{{$game->id}}">
					{{$game->ports_string($ports[$index],$lan->id)}}
				</td>
        			<td scope="col" clas="text-center">
					<div class="form-group row text-center">
						<div class="col">
							<button class="btn btn-primary shadow-sm mb-2" onclick="openGame({{$game->id}})"><i class='fa fa-plus-square'></i> / <i class='fa fa-minus-square'></i> {{ __('messages.ports') }}</button>
						  {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeGame(event,'.$lan->id.','.$game->id.')']) !!}
							<button type="submit" class="btn btn-danger"><i class='fa fa-times'></i> {{ __('messages.delete') }}</button>
						  {!! Form::close() !!}
						</div>
					</div>
        </td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
