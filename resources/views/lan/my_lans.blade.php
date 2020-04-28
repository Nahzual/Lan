<tr id="row-my-lan-{{$lan->id}}">
  <th scope="row" class="text-center lead-text ">{{$lan->id}}</th>
  <td scope="col" class="text-center lead-text">{{$lan->name}}</td>
  <td scope="col" class="text-center lead-text ">{{ $lan->real_user_count() }}/{{$lan->max_num_registrants}}</td>
  <?php if($lan->waiting_lan==config('waiting.WAITING')){ ?>
  <td scope="col" class="text-center lead-text"><i class="fa fa-clock-o" aria-hidden="true"></i></td>
<?php }else if($lan->waiting_lan==config('waiting.ACCEPTED')){ ?>
  <td scope="col" class="text-center lead-text"><i class="fa fa-check success" aria-hidden="true"></i></td>
<?php }else if($lan->waiting_lan==config('waiting.REJECTED')){?>
  <td scope="col" class="text-center lead-text"><i class="fa fa-times danger" aria-hidden="true"></i></td>
  <?php } ?>
  <td scope="col" class="text-center">
    <a class="btn btn-success" href="{{ route('lan.show', $lan->id) }}"><i class='fa fa-eye'></i> View</a>
  </td>
  <td scope="col" class="text-center">
    <a class="btn btn-warning" href="{{ route('lan.edit', $lan->id) }}"><i class='fa fa-edit'></i> Edit</a>
  </td>
  <td scope="col" class="text-center">
    {{ Form::open([ 'method'  => 'delete', 'url' => '', 'onsubmit'=>'return deleteLan(event,'.$lan->id.')' ]) }}
      {{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Delete', ['class' => 'btn btn-danger', 'type' => 'submit']) }}
    {{ Form::close() }}
  </td>
</tr>
