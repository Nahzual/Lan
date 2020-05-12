			    <div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col"><h4 class="float-left mt-2">About</h4></div>
								@if($userIsLanAdmin && $lan->waiting_lan==config('waiting.REJECTED'))
								<div class="col"><small class="float-right text-center">Your LAN has been rejected, you can resubmit it above after some modifications.</small></div>
								@endif
							</div>
						</div>
						<div class="card-body">
							<div class="row d-flex justify-content-center">
								<label class="col-md-2 col-form-label text-md-right">Max number of players</label>
								<label class="form-control col-8 h-100">{{$lan->max_num_registrants}}</label>
							</div>
							<div class="row d-flex justify-content-center">
								<label class="col-md-2 col-form-label text-md-right">Opening date</label>
								<label class="form-control col-8 h-100">{{date_format($date, config("display.DATE_FORMAT"))}}</label>
							</div>
							<div class="row d-flex justify-content-center">
								<label class="col-md-2 col-form-label text-md-right">Duration</label>
								<label class="form-control col-8 h-100">{{$lan->duration}} days</label>
							</div>
							<div class="row d-flex justify-content-center">
								<label class="col-md-2 col-form-label text-md-right">Budget</label>
								<label class="form-control col-8 h-100">{{$lan->budget}} €</label>
							</div>
							<div class="row d-flex justify-content-center">
								<label class="col-md-2 col-form-label text-md-right">Room dimensions</label>
								<label class="form-control col-8 h-100">{{$lan->room_width}}*{{$lan->room_length}} m</label>
							</div>
							<div class="row d-flex justify-content-center">
								<label class="col-md-2 col-form-label text-md-right">Location</label>
								<label class="form-control col-8 h-100">{!!$location->num_street.' '.$street->name_street.' '.$city->zip_city.' '.$city->name_city.', '.$department->name_department.', '.$country->name_country!!}</label>
							</div>

							@if ($userIsLanAdmin)
							<div class="row">
								<div class="col-md-11 text-right">
									{{ Form::open([ 'method'  => 'delete', 'url'=>'', 'onsubmit'=>'return deleteLan(event,'.$lan->id.')' ]) }}
										{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Delete', ['class' => 'btn btn-outline-danger shadow-sm float-right', 'type' => 'submit']) }}
									{{ Form::close() }}
									<a class="btn btn-outline-warning shadow-sm float-right" href="{{ route('lan.edit', $lan->id) }}"><i class='fa fa-edit'></i> Edit</a>
								</div>
							</div>
							@endif
			   		</div>
					</div>
