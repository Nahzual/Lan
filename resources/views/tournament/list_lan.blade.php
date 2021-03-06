
<div class="table-responsive">
  <table class="table card-table">
    <thead class="card-table text-center">
      <th scope="col">#</th>
      <th scope="col">{{ __('messages.name') }}</th>
      <th scope="col">{{ __('messages.game') }}</th>
      <th scope="col">{{ __('messages.hour') }}</th>
      <th scope="col">{{ __('messages.actions') }}</th>
    </thead>

    <tbody>
      @if(count($tournaments)==0)
      <tr>
        <td colspan="5"><h3 class="text-center">{{ __('messages.no_tournaments') }}</h3></td>
      </tr>
      @endif

      @foreach($tournaments as $tournament)

      <tr id="row-tournament-lan-{{$tournament->id}}">
        <th scope="row" class="text-center">{{$tournament->id}}</th>
        <td scope="col" class="text-center ">{{$tournament->name_tournament}}</a></td>
        <td scope="col" class="text-center ">{{$tournament->game->name_game}}</td>
        <td scope="col" class="text-center">{{ $tournament->opening_date_tournament }}</td>


        <td scope="col" class=" text-center">
          <div class="btn-group">
						{!! Form::open(['method' => 'get','url'=>route('tournament.show_tournament', array('lan' => $lan->id, 'tournament' => $tournament->id)) ]) !!}
							<button type="submit" class="btn btn-success mr-2"><i class='fa fa-eye'></i></button>
						{!! Form::close() !!}
		        @if(isset($userIsLanAdmin) && $userIsLanAdmin)
							{!! Form::open(['method' => 'get','url'=>route('tournament.edit_tournament', array('lan' => $lan->id, 'tournament' => $tournament->id)) ]) !!}
									<button type="submit" class="btn btn-warning mr-2"><i class='fa fa-edit'></i></button>
							{!! Form::close() !!}
		          {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeTournament(event,'.$lan->id.','.$tournament->id.')']) !!}
		            <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i></button>
		          {!! Form::close() !!}
		        @endif
					</td>
				</div>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
