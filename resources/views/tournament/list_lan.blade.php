
<div class="table-responsive">
  <table class="table card-table">
    <thead class="card-table text-center">
      <th scope="col" class="lead">#</th>
      <th scope="col" class="lead ">Name</th>
      <th scope="col" class="lead">Game</th>
      <th scope="col" class="lead ">Hour</th>
      <th scope="col" class="lead ">View</th>
      <th scope="col" class="lead ">Edit</th>
      <th scope="col" class="lead ">Delete</th>
      @if($userIsLanAdmin) <th scope="col" class="lead "></th> @endif
    </thead>

    <tbody>
      @if(count($tournaments)==0)
      <tr>
        <td colspan="5"><h3 class="text-center">No tournaments for the moment</h3></td>
      </tr>
      @endif

      @foreach($tournaments as $tournament)

      <tr id="row-tournament-lan-{{$tournament->id}}">
        <th scope="row" class="text-center lead-text">{{$tournament->id}}</th>
        <td scope="col" class="text-center lead-text">{{$tournament->name_tournament}}</a></td>
        <td scope="col" class="text-center lead-text">{{ substr(($tournament->desc_tournament), 0, 50) }}</td>
        <td scope="col" class="text-center lead-text">{{ $tournament->opening_date_tournament }}</td>

     
        <td scope="col" >
              <a class="btn btn-success" href="{{ route('tournament.show_tournament', array('lan' => $lan->id, 'tournament' => $tournament->id)) }}"><i class='fa fa-eye'></i> View</a>
        </td>

        @if($userIsLanAdmin)
        <td scope="col" class="">
            <a class="btn btn-warning" href="{{ route('tournament.edit_tournament', array('lan' => $lan->id, 'tournament' => $tournament->id)) }}"><i class='fa fa-edit'></i> Edit</a>
         </td>
        <td scope="col" class="lead-text">
          {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeTournament(event,'.$lan->id.','.$tournament->id.')']) !!}
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
