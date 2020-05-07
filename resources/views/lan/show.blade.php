@extends('layouts.dashboard')

@section('content')
<?php $date = date_create($lan->opening_date); ?>
<div class="card">
	<div class="card-header">
			<div class="row">
				<h3>Viewing : {{$lan->name}}</h3>
							@if($userIsLanAdmin && $lan->waiting_lan==config('waiting.REJECTED'))
				<div class="col mt-1">
				@csrf
				<button type="submit" onclick="submit(event,{{$lan->id}})" class="btn btn-outline-dark shadow-sm float-right"><i class='fa fa-send'></i> Resubmit</button>
				</div>
							@endif
			</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-8">
			      	<div class="card">
				
						<div id="response-success-delete" class="container alert alert-success mt-2" style="display:none"></div>
						<div id="response-error-delete" class="container alert alert-danger mt-2" style="display:none"></div>

						@if($userIsLanAdmin && $lan->waiting_lan==config('waiting.REJECTED'))
						<small class="text-center">Your LAN has been rejected, you can resubmit it above after some modifications.</small>
						@endif
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
							<div class="form-group row text-center">

								@if ($userIsLanAdmin)
									<div class="col">
										<a class="btn btn-primary" href="{{ route('lan.edit', $lan->id) }}"><i class='fa fa-edit'></i> Edit</a>
									</div>
									{{ Form::open([ 'method'  => 'delete', 'url'=>'', 'onsubmit'=>'return deleteLan(event,'.$lan->id.')' ]) }}
										{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Delete', ['class' => 'btn btn-danger', 'type' => 'submit']) }}
									{{ Form::close() }}
								@endif
								<div class="col">
									<a class="btn btn-primary" href="{{ route('lan.index') }}"><i class='fa fa-arrow-left'></i> To Lan List</a>
								</div>
							</div>
			   			</div>
					</div>
		   	</div><!-- col 1-->
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<h4 class="mt-2">Quick-Links</h4>
						</div>
					</div>
					<div class="card-body">
					<p>Liste complète des joueurs</p>
					<p>Liste des admins</p>
					<p>Liste des helpers</p>
					<p>Liste des activités</p>
					<p>Liste des jeux</p>
					<p>Liste des taches</p>
					<p>Liste des tournois</p>
					<p>Liste du materiel</p>
					<p>Shopping list</p>
					</div>	
				</div>
			</div>
		</div>
		<div class="row esp">
			<div class="col-md-6">
				<div id="response-success-game" class="container alert alert-success mt-2" style="display:none"></div>
				<div id="response-error-game" class="container alert alert-danger mt-2" style="display:none"></div>
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col mt-2">
									<h4>Games</h4>
								</div>
								@if ($userIsLanAdmin)
								<div class="col mt-2">
									<button class="btn btn-outline-dark shadow-sm float-right" data-toggle="collapse" data-target="#lan_games" aria-expanded="false" aria-controls="lan_games">Show/hide</button>
									<a class="btn btn-primary float-right" href="{{ route('lan.add_game', $lan->id) }}"><i class='fa fa-plus'></i></a>
									<a class="btn btn-primary float-right" href="{{ route('lan.add_game', $lan->id) }}"><i class='fa fa-plus'></i> All</a>
								</div>
								@endif
							</div>
						</div>
						<div class="card-body collapse" id="lan_games">
							@include('game.list_lan')
						</div>
				</div>
			</div>

			<div class="col-md-6">
				
					<div id="response-success-tournament" class="container alert alert-success mt-2" style="display:none"></div>
					<div id="response-error-tournament" class="container alert alert-danger mt-2" style="display:none"></div>

						<div class="card">
							<div class="card-header">
								<div class="row">
									<div class="col mt-2">
										<h4>Tournaments</h4>
									</div>
									@if ($userIsLanAdmin)
									<div class="col mt-2">
										<button class="btn btn-outline-dark shadow-sm float-right" data-toggle="collapse" data-target="#lan_tournaments" aria-expanded="false" aria-controls="lan_tournaments">Show/hide</button>
										<a class="btn btn-primary float-right" href="{{ route('tournament.create_tournament', $lan->id) }}"><i class='fa fa-plus'></i></a>
									
										<a class="btn btn-primary float-right" href="{{ route('lan.add_game', $lan->id) }}"><i class='fa fa-plus'></i> All</a>
									</div>
									@endif
								</div>
							</div>
							<div class="card-body collapse" id="lan_tournaments">
								@include('tournament.list_lan')
							</div>
						</div>
						
				
			</div>
		</div><!-- row -->
		<div class="row esp">
			<div class="col-md-6">
					<div id="response-success-activity" class="container alert alert-success mt-2" style="display:none"></div>
					<div id="response-error-activity" class="container alert alert-danger mt-2" style="display:none"></div>
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
			</div>
				
		</div><!-- row -->
		@if($userIsLanAdminOrHelper)
		<div class="row justify-content-center esp">
					<div class="col-md-12">
						<hr class="dark-hr"/>
						<h3 class="text-center">Helper section</h3>
						<hr class="dark-hr"/>
					</div>
		</div>
		<div class="row esp">
				<div class="col-md-6">
					<div id="response-success-material" class="container alert alert-success mt-2" style="display:none"></div>
					<div id="response-error-material" class="container alert alert-danger mt-2" style="display:none"></div>
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col mt-2">
									<h4>Materials</h4>
								</div>
								@if ($userIsLanAdmin)
								<div class="col">
									<button class="btn btn-outline-dark shadow-sm float-right" data-toggle="collapse" data-target="#lan_materials" aria-expanded="false" aria-controls="lan_materials">Show/hide</button>
									<a class="btn btn-primary float-right" href="{{ route('lan.add_material', $lan->id) }}"><i class='fa fa-plus'></i></a>
									<a class="btn btn-primary float-right" href="{{ route('lan.add_game', $lan->id) }}"><i class='fa fa-plus'></i> All</a>
								</div>
								@endif
							</div>
						</div>
						<div class="card-body collapse" id="lan_materials">
							@include('material.list_lan')
						</div>
					</div>
					
				</div>
			
				<div class="col-md-6">
					<div id="response-success-shopping" class="container alert alert-success mt-2" style="display:none"></div>
					<div id="response-error-shopping" class="container alert alert-danger mt-2" style="display:none"></div>
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col mt-2">
									<h4>Shopping</h4>
								</div>
								@if ($userIsLanAdmin)
								<div class="col">
									<button class="btn btn-outline-dark shadow-sm float-right" data-toggle="collapse" data-target="#lan_shopping" aria-expanded="false" aria-controls="lan_shopping">Show/hide</button>
									<a class="btn btn-primary float-right" href="{{ route('lan.add_material', $lan->id) }}"><i class='fa fa-plus'></i></a>
									<a class="btn btn-primary float-right" href="{{ route('lan.add_game', $lan->id) }}"><i class='fa fa-plus'></i> All</a>
								</div>
								@endif
							</div>
						</div>
						<!--@include('game.list_lan')-->
					</div>

				</div>
		</div>
	@endif
	@if ($userIsLanAdmin)
			<div class="row justify-content-center esp">
						<div class="col-md-12">
							<hr class="dark-hr"/>
							<h3 class="text-center">Admin section</h3>
							<hr class="dark-hr"/>
						</div>
			</div>
			<div class="row esp">
				  <div class="col-md-6">
				    <div id="response-success-admin" class="container alert alert-success mt-2" style="display:none"></div>
				    <div id="response-error-admin" class="container alert alert-danger mt-2" style="display:none"></div>
				    <div >
				      @include('user.admin.show_remove')
				    </div>
				  </div>


				  <div class="col-md-6">
				    <div id="response-success-helper" class="container alert alert-success mt-2" style="display:none"></div>
				    <div id="response-error-helper" class="container alert alert-danger mt-2" style="display:none"></div>
				    <div>
				      @include('user.helper.show_remove')
				    </div>
				  </div>
			</div>
	@endif
	</div><!-- card body -->
</div><!-- card -->
@endsection

@section('js_includes')
<script src="/js/ajax/lan/ajax_add_helper.js"></script>
<script src="/js/ajax/lan/ajax_add_admin.js"></script>
<script src="/js/ajax/lan/ajax_delete.js"></script>
<script src="/js/ajax/lan/ajax_submit.js"></script>
<script src="/js/ajax/lan/ajax_remove_game.js"></script>
<script src="/js/ajax/lan/ajax_remove_material.js"></script>
<script src="/js/ajax/material/ajax_edit.js"></script>

<script src="/js/ajax/activity/ajax_delete.js"></script>
<script src="/js/ajax/tournament/ajax_delete.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
