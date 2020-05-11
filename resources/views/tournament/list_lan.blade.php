
<div class="table-responsive">
  <table class="table card-table">
    <thead class="card-table text-center">
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col" >Game</th>
      <th scope="col">Hour</th>
      <th scope="col" >Actions</th>
    </thead>

    <tbody>
      @if(count($tournaments)==0)
      <tr>
        <td colspan="5"><h3 class="text-center">No tournaments to show</h3></td>
      </tr>
      @endif

      @foreach($tournaments as $tournament)

      <tr id="row-tournament-lan-{{$tournament->id}}">
        <th scope="row" class="text-center">{{$tournament->id}}</th>
        <td scope="col" class="text-center ">{{$tournament->name_tournament}}</a></td>
        <td scope="col" class="text-center ">{{ substr(($tournament->desc_tournament), 0, 50) }}</td>
        <td scope="col" class="text-center">{{ $tournament->opening_date_tournament }}</td>


        <td scope="col" class=" text-center">
            <div class="btn-group">
              <a class="btn btn-success" href="{{ route('tournament.show_tournament', array('lan' => $lan->id, 'tournament' => $tournament->id)) }}"><i class='fa fa-eye'></i></a>

        @if(isset($userIsLanAdmin) && $userIsLanAdmin)
            <a class="btn btn-warning" href="{{ route('tournament.edit_tournament', array('lan' => $lan->id, 'tournament' => $tournament->id)) }}"><i class='fa fa-edit'></i></a>

          {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeTournament(event,'.$lan->id.','.$tournament->id.')']) !!}

                <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i></button>
            </div>
          {!! Form::close() !!}
        </td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
