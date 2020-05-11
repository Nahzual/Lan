			    <div class="card">
						<div class="card-header">
							<div class="row">
								<h4 class="mt-2">About</h4>
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
								<label class="form-control col-8 h-100">{{$location->num_street.' '.$street->name_street.' '.$city->zip_city.' '.$city->name_city.', '.$department->name_department.', '.$country->name_country}}</label>
							</div>
			   			</div>
					</div>
