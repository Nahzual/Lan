					<div class="card">
						<div class="card-header" id="heading-activity">
							<div class="row">
								<div class="col mt-2">
									<h4>Activities</h4>
								</div>
								@if ($userIsLanAdmin)
								<div class="col">
									<button class="btn btn-outline-dark shadow-sm float-right ml-2" data-toggle="collapse" data-target="#lan_activities" aria-expanded="false" aria-controls="lan_activities">Show/hide</button>
									<a class="btn btn-success shadow-sm float-right ml-2" href="{{ route('activity.create', $lan->id) }}"><i class='fa fa-plus'></i></a>
									<a class="btn btn-outline-primary shadow-sm float-right" href="{{ route('lan.add_game', $lan->id) }}"><i class='fa fa-list'></i> All</a>
								</div>
								@endif
							</div>
						</div>
						<div class="collapse" id="lan_activities" aria-labelledby="heading-activity">
							<div class="card-body">
								<div class="table-responsive">
									<table class="text-center table card-table table-bordered">
										<thead class="card-table text-center">
										<th scope="col" >#</th>
										<th scope="col" >Name</th>
										<th scope="col" >Actions</th>
									</thead>

									<tbody>
									@foreach($activities as $activity)
										<tr id="row-activity-lan-{{$activity->id}}">
											<th scope="row">{{$activity->id}}</th>
											<td scope="col">{{$activity->name_activity}}</td>
											<td scope="col" class=" text-center">
		           					<div class="btn-group">
													<a class="btn btn-success mr-2" onclick="openActivity({{$activity->id}})"><i class='fa fa-eye'></i> View</a>
													<a class="btn btn-warning mr-2" href="{{ route('activity.edit', array('lan' => $lan->id, 'activity' => $activity->id)) }}"><i class='fa fa-edit'></i> Edit</a>
													{!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeActivity(event, '.$lan->id.', '.$activity->id.')']) !!}
														<button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> Delete</button>
													{!! Form::close() !!}
												</div>
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				@foreach($activities as $activity)
				<div id="popup-activity-{{$activity->id}}" class="popup">
					<div class="popup-content">
						<span onclick="closeActivity({{$activity->id}})" class="close">&times;</span>
						@include('activity.show',$activity)
					</div>
				</div>
				@endforeach
