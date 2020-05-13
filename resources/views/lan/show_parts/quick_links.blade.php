				<div class="card">
					<div class="card-header">
						<div class="row">
							<h4 class="mt-2">Quick-Links</h4>
						</div>
					</div>
					<div class="card-body h-100">

									<div class="row justify-content-center">
										<div class="col-md-4 text-center space-remove">
											<a class="btn btn-dark shadow-sm  lan-btn-quick  w-100" href="{{ route('lan.activity_list', $lan->id) }}"><i class='fa fa-puzzle-piece'></i> Activities</a>
										</div>
										<div class="col-md-4 text-center  space-remove">
											<a class="btn btn-dark shadow-sm  lan-btn-quick  w-100" href="{{ route('lan.game_list', $lan->id) }}"><i class='fa fa-gamepad'></i> Games</a>
										</div>
										<div class="col-md-4 text-center space-remove">
											<a class="btn btn-dark shadow-sm  lan-btn-quick   w-100" href="{{ route('lan.tour_list', $lan->id) }}"><i class='fa fa-trophy'></i> Tournaments</a>
										</div>
									</div>

									@if($userIsLanAdminOrHelper)
									<div class="row justify-content-center">
										<div class="col-md-4 text-center space-remove">
											<a class="btn btn-or shadow-sm  lan-btn-quick  w-100" href="{{ route('lan.task_list', $lan->id) }}"><i class='fa fa-tasks'></i> Tasks</a>
										</div>
										<div class="col-md-4 text-center space-remove">
											<a class="btn btn-or shadow-sm  lan-btn-quick  w-100" href="{{ route('lan.material_list', $lan->id) }}"><i class='fa fa-archive'></i> Materials</a>
										</div>
										<div class="col-md-4 text-center space-remove">
											<a class="btn btn-or shadow-sm  lan-btn-quick  w-100" href="{{ route('lan.shopping_list', $lan->id) }}"><i class='fa fa-tags'></i> Shoppings</a>
										</div>
									</div>
									<div class="row justify-content-center">
										<div class="col-md-4 text-center space-remove">
											<a class="btn btn-purple shadow-sm  lan-btn-quick  w-100" href="{{ route('lan.user_list', $lan->id) }}"><i class='fa fa-user'></i> Players</a>
										</div>
										@if($userIsLanAdmin)
										<div class="col-md-4 text-center space-remove">
											<a class="btn btn-purple shadow-sm lan-btn-quick   w-100" href="{{ route('lan.admin_list', $lan->id) }}"><i class='fa fa-user'></i> Admins</a>
										</div>
										<div class="col-md-4 text-center space-remove">
											<a class="btn btn-purple shadow-sm lan-btn-quick  w-100" href="{{ route('lan.helper_list', $lan->id) }}"><i class='fa fa-user'></i> Helpers</a>
										</div>
										@endif
									</div>
									@endif
									<div class="row justify-content-center">
										<div class="col-md-4 text-center space-remove">
											<a class="btn btn-info shadow-sm lan-btn-quick  w-100" href="{{ route('lan.guest_show', $lan->id) }}"><i class='fa fa-eye'></i> Public View</a>
										</div>
									</div>
						</div>	
				</div>
