<div class="row">
  <div class="col mt-2 lead-text hideOnVerySmallScreens">{{$lan->id}}</div>
  <div class="col mt-2 lead-text">{{$lan->name}}</div>
  <div class="col mt-2 lead-text hideOnVerySmallScreens">{{ $lan->real_user_count() }}/{{$lan->max_num_registrants}}</div>
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
</div>
<br>
