					<div class="card">
						<div class="card-header" id="heading-task">
							<div class="row">
								<div class="col mt-2">
									<h4>Tasks</h4>
								</div>
								<div class="col">
									<button class="btn btn-outline-dark shadow-sm float-right ml-2" data-toggle="collapse" data-target="#lan_tasks" aria-expanded="false" aria-controls="lan_tasks">Show/hide</button>
									@if ($userIsLanAdminOrHelper)
									<a class="btn btn-success shadow-sm float-right ml-2" href="{{ route('task.create', $lan->id) }}"><i class='fa fa-plus'></i></a>@endif
									<a class="btn btn-outline-primary shadow-sm float-right" href="{{ route('lan.task_list', $lan->id) }}"><i class='fa fa-list'></i> All</a>

								</div>
							</div>
						</div>
						<div class="collapse" id="lan_tasks" aria-labelledby="heading-task">
							<div class="card-body">
								<div class="table-responsive">
									<table class="text-center table card-table table-bordered">
										<thead class="card-table text-center">
										<th scope="col" >#</th>
										<th scope="col" >Name</th>
										<th scope="col" >Actions</th>
									</thead>

									<tbody>
									@if(count($tasks)==0)
										<tr>
											<td colspan="5"><h3 class="text-center">No tasks to show</h3></td>
										</tr>
									@endif
									@foreach($tasks as $task)
										<tr id="row-task-lan-{{$task->id}}">
											<th scope="row">{{$task->id}}</th>
											<td scope="col">{!!$task->name_task!!}</td>
											<td scope="col" class=" text-center">
		           					<div class="btn-group">
													{!! Form::open(['method'=>'get','url'=>route('task.show',[$lan->id,$task->id])]) !!}
														<button type="submit" class="btn btn-success mr-2"><i class='fa fa-eye'></i> View</button>
													{{ Form::close() }}
													@if ($userIsLanAdmin)
													{!! Form::open(['method'=>'get','url'=>route('task.edit',[$lan->id,$task->id])]) !!}
														<button type="submit" class="btn btn-warning mr-2"><i class='fa fa-edit'></i> Edit</button>
													{{ Form::close() }}
													{!! Form::open(['method'=>'get','url'=>route('task.assign',[$lan->id,$task->id])]) !!}
														<button type="submit" class="btn btn-primary mr-2"><i class='fa fa-user-plus'></i> Assign</button>
													{{ Form::close() }}
													{!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return deleteTask(event, '.$lan->id.', '.$task->id.')']) !!}
														<button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> Delete</button>
													{!! Form::close() !!}
													@endif
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
