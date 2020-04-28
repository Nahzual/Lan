<tr id="row-player-lan-{{$lan->id}}">
  <th scope="row" class="text-center lead-text">{{$lan->id}}</th>
  <td scope="col" class="text-center lead-text">{{$lan->name}}</td>
  <td scope="col" class="text-center lead-text">{{ $lan->real_user_count() }}/{{$lan->max_num_registrants}}</td>
  <td scope="col" class="text-center">
    <a class="btn btn-success" href="{{ route('lan.show', $lan->id) }}"><i class='fa fa-eye'></i> View</a>
  </td>
  <td scope="col" class="text-center">
    {{ Form::open([ 'method'  => 'delete', 'onsubmit'=>'return removePlayer(event,'.$lan->id.')' ]) }}
      {{ Form::button('<i class="fa fa-sign-out" aria-hidden="true"></i> Quit', ['class' => 'btn btn-danger', 'type' => 'submit']) }}
    {{ Form::close() }}
  </td>
</tr>
