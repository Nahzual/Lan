<div class="row">
  <div class="col mt-2 lead-text">{{$lan->id}}</div>
  <div class="col mt-2 lead-text">{{$lan->name}}</div>
  <div class="col mt-2 lead-text">{{ $lan->real_user_count() }}/{{$lan->max_num_registrants}}</div>
  <div class="col">
    <a class="btn btn-success" href="{{ route('lan.show', $lan->id) }}"><i class='fa fa-eye'></i> View</a>
  </div>
  <div class="col">
    {{ Form::open([ 'method'  => 'delete', 'onsubmit'=>'return removePlayer(event,'.$lan->id.')' ]) }}
      {{ Form::button('<i class="fa fa-sign-out" aria-hidden="true"></i> Quit', ['class' => 'btn btn-danger', 'type' => 'submit']) }}
    {{ Form::close() }}
  </div>
</div>
<br>
