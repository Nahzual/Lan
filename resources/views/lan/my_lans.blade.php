<div class="row">
  <div class="col mt-2 lead-text">{{$lan->id}}</div>
  <div class="col mt-2 lead-text">{{$lan->name}}</div>
  <div class="col mt-2 lead-text">{{ count($lan->users) }}/{{$lan->max_num_registrants}}</div>
  <?php if($lan->waiting_lan==config('waiting.WAITING')){ ?>
  <div class="col mt-2 lead-text"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
<?php }else if($lan->waiting_lan==config('waiting.ACCEPTED')){ ?>
  <div class="col mt-2 lead-text"><i class="fa fa-check success" aria-hidden="true"></i></div>
<?php }else if($lan->waiting_lan==config('waiting.REJECTED')){?>
  <div class="col mt-2 lead-text"><i class="fa fa-times danger" aria-hidden="true"></i></div>
  <?php } ?>
  <div class="col">
    <a class="btn btn-success" href="{{ route('lan.show', $lan->id) }}"><i class='fa fa-eye'></i> View</a>
  </div>
  <div class="col">
    <a class="btn btn-warning" href="{{ route('lan.edit', $lan->id) }}"><i class='fa fa-edit'></i> Edit</a>
  </div>
  <div class="col">
    {{ Form::open([ 'method'  => 'delete', 'route' => [ 'lan.destroy', $lan->id ] ]) }}
      {{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Delete', ['class' => 'btn btn-danger', 'type' => 'submit']) }}
    {{ Form::close() }}
  </div>
</div>
<br>
