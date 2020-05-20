			    <div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col mt-2">
									<h4>{{ __('messages.about') }}</h4>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row d-flex justify-content-center">
								<label class="col-md-2 col-form-label text-md-right">{{ __('messages.nb_max_registrants') }}</label>
								<label class="form-control col-8 h-100">{{$lan->max_num_registrants}}</label>
							</div>
							<div class="row d-flex justify-content-center">
								<label class="col-md-2 col-form-label text-md-right">{{ __('messages.date') }}</label>
								<label class="form-control col-8 h-100">{{date_format($date, config("display.DATE_FORMAT"))}}</label>
							</div>
							<div class="row d-flex justify-content-center">
								<label class="col-md-2 col-form-label text-md-right">{{ __('messages.duration') }}</label>
								<label class="form-control col-8 h-100">{{$lan->duration}} days</label>
							</div>
							<div class="row d-flex justify-content-center">
								<label class="col-md-2 col-form-label text-md-right">{{ __('messages.budget') }}</label>
								<label class="form-control col-8 h-100">{{$lan->budget}} €</label>
							</div>
							<div class="row d-flex justify-content-center">
								<label class="col-md-2 col-form-label text-md-right">{{ __('messages.location') }}</label>
								<label class="form-control col-8 h-100">{!!$location->num_street.' '.$street->name_street.' '.$city->zip_city.' '.$city->name_city.', '.$department->name_department.', '.$country->name_country!!}</label>
							</div>
			   			</div>
					</div>
