        <div class="card-header text-center">
					<div class="row lead">
						<div class="col">Name</div>
						<div class="col">Participants</div>
						<div class="col">Date</div>
            <div class="col"></div>
            <div class="col"></div>
					</div>
				</div>
        <div class="card-body text-center">
						@foreach($lans as $lan)
						<div class="row">
							<div class="col mt-2 lead-text">{{$lan->name}}</div>
							<div class="col mt-2 lead-text">{{ $lan->real_user_count() }}/{{ $lan->max_num_registrants }}</div>
							<div class="col mt-2 lead-text">{{$lan->opening_date}}</div>

							<div class="col">
							  <a class="btn btn-success" href="{{ route('lan.show', $lan->id) }}"><i class='fa fa-eye'></i> View</a>
							</div>
              <div class="col">
                <a class="btn btn-success" href="{{ route('lan.participate', $lan->id) }}"><i class="fa fa-sign-in"></i> Participate</a>
              </div>
						</div>
						<br>
						@endforeach
        </div>
