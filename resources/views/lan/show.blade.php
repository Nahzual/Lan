@extends('layouts.app')

@section('content')
<?php $date = date_create($lan->opening_date); ?>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<h3 class="lead-title">Viewing : {{$lan->name}}</h3>
						@if($userIsLanAdmin && $lan->waiting_lan==config('waiting.REJECTED'))
						<div class="col mt-1">
							@csrf
							<button type="submit" onclick="submit(event,{{$lan->id}})" class="btn btn-outline-dark shadow-sm float-right"><i class='fa fa-send'></i> Resubmit</button>
						</div>
						@endif
					</div>
				</div>

				<div id="response-success-delete" class="container alert alert-success mt-2" style="display:none"></div>
				<div id="response-error-delete" class="container alert alert-danger mt-2" style="display:none"></div>

				@if($userIsLanAdmin && $lan->waiting_lan==config('waiting.REJECTED'))
				<small class="text-center">Your LAN has been rejected, you can resubmit it above after some modifications.</small>
				@endif

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
		</div>
	</div>
</div>

<div class="mt-5 row justify-content-center">
	<div id="response-success-activity" class="container alert alert-success mt-2" style="display:none"></div>
	<div id="response-error-activity" class="container alert alert-danger mt-2" style="display:none"></div>
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col mt-2">
						<h3 class="lead-title">Activities</h3>
					</div>
					@if ($userIsLanAdmin)
					<div class="col">
						<a class="btn btn-primary float-right" href="{{ route('activity.create', $lan->id) }}"><i class='fa fa-plus'></i> Add activities</a>
					</div>
					@endif
				</div>
			</div>
		</div>

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

<div class="mt-5 row justify-content-center">
	<div id="response-success-game" class="container alert alert-success mt-2" style="display:none"></div>
	<div id="response-error-game" class="container alert alert-danger mt-2" style="display:none"></div>
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col mt-2">
						<h3 class="lead-title">Games</h3>
					</div>
					@if ($userIsLanAdmin)
					<div class="col">
						<a class="btn btn-primary float-right" href="{{ route('lan.add_game', $lan->id) }}"><i class='fa fa-plus'></i> Add games</a>
					</div>
					@endif
				</div>
			</div>
		</div>
		@include('game.list_lan')
	</div>
</div>

@if($userIsLanAdminOrHelper)

<div class="my-5 row justify-content-center">
		<div class="col-md-8">
			<hr class="dark-hr"/>
			<h3 class="text-center">Helper section</h3>
			<hr class="dark-hr"/>
		</div>
	</div>

<div class="mt-5 row justify-content-center">
	<div id="response-success-material" class="container alert alert-success mt-2" style="display:none"></div>
	<div id="response-error-material" class="container alert alert-danger mt-2" style="display:none"></div>
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col mt-2">
						<h3 class="lead-title">Materials</h3>
					</div>
					@if ($userIsLanAdmin)
					<div class="col">
						<a class="btn btn-primary float-right" href="{{ route('lan.add_material', $lan->id) }}"><i class='fa fa-plus'></i> Add materials</a>
					</div>
					@endif
				</div>
			</div>
		</div>
		@include('material.list_lan')
	</div>
</div>

<div class="mt-5 row justify-content-center">
	<div id="response-success-shopping" class="container alert alert-success mt-2" style="display:none"></div>
	<div id="response-error-shopping" class="container alert alert-danger mt-2" style="display:none"></div>
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col mt-2">
						<h3 class="lead-title">Shopping</h3>
					</div>
					<div class="col">
					</div>
				</div>
			</div>
		</div>
		<!--@include('game.list_lan')-->
	</div>
</div>
@endif

<div class="mt-5 row justify-content-center">
	<div id="response-success-tournament" class="container alert alert-success mt-2" style="display:none"></div>
	<div id="response-error-tournament" class="container alert alert-danger mt-2" style="display:none"></div>
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col mt-2">
						<h3 class="lead-title">Tournaments</h3>
					</div>
					@if ($userIsLanAdmin)
					<div class="col">
						<a class="btn btn-primary float-right" href="{{ route('tournament.create_tournament', $lan->id) }}"><i class='fa fa-plus'></i> Add tournaments</a>
					</div>
					@endif
				</div>
			</div>
		</div>
		@include('tournament.list_lan')
	</div>
</div>


@if ($userIsLanAdmin)

  <div class="my-5 row justify-content-center">
      <div class="col-md-8">
        <hr class="dark-hr"/>
        <h3 class="text-center">Admin section</h3>
        <hr class="dark-hr"/>
      </div>
    </div>

  <div class="mb-5 row justify-content-center">
    <div id="response-success-admin" class="container alert alert-success mt-2" style="display:none"></div>
    <div id="response-error-admin" class="container alert alert-danger mt-2" style="display:none"></div>
    <div class="col-md-8">
      @include('user.admin.show_remove')
    </div>
  </div>


  <div class="mb-5 row justify-content-center">
    <div id="response-success-helper" class="container alert alert-success mt-2" style="display:none"></div>
    <div id="response-error-helper" class="container alert alert-danger mt-2" style="display:none"></div>
    <div class="col-md-8">
      @include('user.helper.show_remove')
    </div>
  </div>
@endif

</div>
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
