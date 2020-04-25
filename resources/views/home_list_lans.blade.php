        <div class="card-header text-center">
					<div class="row lead">
						<div class="col-5">Name</div>
						<div class="col hideOnVerySmallScreens">Participants</div>
						<div class="col hideOnSmallScreens">Date</div>
            <div class="col-1"></div>
            <div class="hideOnVerySmallScreens col-1"></div>
					</div>
				</div>
        <div class="card-body text-center">
						@foreach($lans as $lan)
            <?php $date = date_create($lan->opening_date); ?>

						<div class="row">
							<div class="col-5 mt-2 lead-text">{{$lan->name}}</div>
							<div class="hideOnVerySmallScreens col mt-2 lead-text">{{ $lan->real_user_count() }}/{{ $lan->max_num_registrants }}</div>
							<div class="hideOnSmallScreens col mt-2 lead-text">{{date_format($date, config("display.DATE_FORMAT"))}}</div>

							<div class="col">
							  <a class="btn btn-success" href="{{ route('lan.show', $lan->id) }}"><i class='fa fa-eye'></i> View</a>
							</div>
              <div class="hideOnVerySmallScreens col">
                <a class="btn btn-success" href="{{ route('lan.participate', $lan->id) }}"><i class="fa fa-sign-in"></i> Participate</a>
              </div>
						</div>
						<br>
						@endforeach
        </div>
