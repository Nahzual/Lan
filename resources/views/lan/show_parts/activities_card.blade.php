<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col mt-2">
									<h4>Activities</h4>
								</div>
								@if ($userIsLanAdmin)
								<div class="col">
									<button class="btn btn-outline-dark shadow-sm float-right" data-toggle="collapse" data-target="#lan_activities" aria-expanded="false" aria-controls="lan_activities">Show/hide</button>
									<a class="btn btn-primary float-right" href="{{ route('activity.create', $lan->id) }}"><i class='fa fa-plus'></i></a>
									<a class="btn btn-primary float-right" href="{{ route('lan.add_game', $lan->id) }}"><i class='fa fa-plus'></i> All</a>
								</div>
								@endif
							</div>
						</div>
						<div class="card-body collapse" id="lan_activities">
							<div class="table-responsive">
								<table class="text-center table card-table table-bordered">
									<thead class="card-table text-center">
									<th scope="col" class="lead">#</th>
									<th scope="col" class="lead ">Name</th>
									<th scope="col" class="lead ">View</th>
									<th scope="col" class="lead">Edit</th>
									<th scope="col" class="lead">Delete</th>
								</thead>

								<tbody>
								@foreach($activities as $activity)
									<tr id="row-activity-lan-{{$activity->id}}">
									<th scope="row" class="lead-text">{{$activity->id}}</th>
									<td scope="col" class="lead-text">{{$activity->name_activity}}</td>
									<td scope="col" >
										<a class="btn btn-success" href="{{ route('activity.show', array('lan' => $lan->id, 'activity' => $activity->id)) }}"><i class='fa fa-eye'></i> View</a>
									</td>
									<td scope="col" class="">
										<a class="btn btn-warning" href="{{ route('activity.edit', array('lan' => $lan->id, 'activity' => $activity->id)) }}"><i class='fa fa-edit'></i> Edit</a>
									</td>
									<td scope="col" class="">
										{!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeActivity(event, '.$lan->id.', '.$activity->id.')']) !!}
										<div class="form-group row text-center">
											<div class="col">
												<button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> Delete</button>
											</div>
										</div>	
										{!! Form::close() !!}
									</td>
									</tr>
								@endforeach
								</tbody>
								</table>
							</div>
						</div>
					</div>
