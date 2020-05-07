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
						<div id="response-success-delete" class="container alert alert-success mt-2" style="display:none"></div>
						<div id="response-error-delete" class="container alert alert-danger mt-2" style="display:none"></div>
			
						@include('lan.show_parts.about_card')
		   	</div><!-- col 1-->
			<div class="col-md-4">	
				@include('lan.show_parts.quick_links')
			</div>
		</div>
		<div class="row esp">
			<div class="col-md-6">
				<div id="response-success-game" class="container alert alert-success mt-2" style="display:none"></div>
				<div id="response-error-game" class="container alert alert-danger mt-2" style="display:none"></div>

				@include('lan.show_parts.games_card')
			</div>

			<div class="col-md-6">
				
					<div id="response-success-tournament" class="container alert alert-success mt-2" style="display:none"></div>
					<div id="response-error-tournament" class="container alert alert-danger mt-2" style="display:none"></div>

					@include('lan.show_parts.tour_card')			
						
				
			</div>
		</div><!-- row -->
		<div class="row esp">
			<div class="col-md-6">
					<div id="response-success-activity" class="container alert alert-success mt-2" style="display:none"></div>
					<div id="response-error-activity" class="container alert alert-danger mt-2" style="display:none"></div>
					
					@include('lan.show_parts.activities_card')	

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
	<div class="row">
		<div class="col-md-12">
			<a class="btn btn-outline-info shadow-sm float-right" href="{{ route('lan.show', $lan) }}"><i class='fa fa-arrow-left'></i> Go back to Lan</a>
		</div>
	</div>
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
