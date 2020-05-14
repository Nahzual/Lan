@extends('layouts.dashboard')

@section('title')
Viewing : {!!$lan->name!!}
@endsection

@section('page-title')
LAN page
@endsection

@section('title-buttons')
	@if($userIsLanAdmin && $lan->waiting_lan==config('waiting.REJECTED'))
		<div class="col mt-1">
			@csrf
			<button type="submit" onclick="submit(event,{{$lan->id}})" class="btn btn-outline-dark shadow-sm float-right"><i class='fa fa-send'></i> Resubmit</button>
		</div>
	@endif
@endsection

@section('content')
<?php $date = date_create($lan->opening_date); ?>
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
<div class="row esp mt-5">
	<div class="col-md-6">
		<div id="response-success-activity" class="container alert alert-success mt-2" style="display:none"></div>
		<div id="response-error-activity" class="container alert alert-danger mt-2" style="display:none"></div>

		@include('lan.show_parts.activities_card')
	</div>

</div><!-- row -->
@if($userIsLanAdminOrHelper)
<div class="row justify-content-center esp my-5">
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

		@include('lan.show_parts.materials_card')

	</div>

	<div class="col-md-6">
		<div id="response-success-shopping" class="container alert alert-success mt-2" style="display:none"></div>
		<div id="response-error-shopping" class="container alert alert-danger mt-2" style="display:none"></div>
		@include('lan.show_parts.shopping_card')

	</div>
</div>
<div class="row esp">
	<div class="col-md-6">
		<div id="response-success-task" class="container alert alert-success mt-2" style="display:none"></div>
		<div id="response-error-task" class="container alert alert-danger mt-2" style="display:none"></div>

		@include('lan.show_parts.tasks_card')
	</div>

	<div class="col-md-6">
		<div id="response-success-player" class="container alert alert-success mt-2" style="display:none"></div>
		<div id="response-error-player" class="container alert alert-danger mt-2" style="display:none"></div>

		@include('lan.show_parts.users_card')
	</div>

</div>
@endif
@if ($userIsLanAdmin)
<div class="row justify-content-center esp my-5">
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
		<div>
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
@endsection

@section('js_includes')
<script src="/js/ajax/lan/ajax_add_helper.js"></script>
<script src="/js/ajax/lan/ajax_add_admin.js"></script>
<script src="/js/ajax/lan/ajax_delete.js"></script>
<script src="/js/ajax/lan/ajax_submit.js"></script>
<script src="/js/ajax/lan/ajax_remove_game.js"></script>
<script src="/js/ajax/lan/ajax_remove_material.js"></script>
<script src="/js/ajax/lan/ajax_participate.js"></script>

<script src="/js/ajax/material/ajax_edit.js"></script>

<script src="/js/ajax/activity/ajax_delete.js"></script>
<script src="/js/ajax/tournament/ajax_delete.js"></script>
<script src="/js/ajax/task/ajax_delete.js"></script>
<script src="/js/ajax/shopping/ajax_delete.js"></script>

<script src="/js/ajax/game/ajax_port.js"></script>

<!-- pop-up windows scripts -->
<script src="/js/windows/activity/display_window.js"></script>
<script src="/js/windows/material/display_window.js"></script>
<script src="/js/windows/shopping/display_window.js"></script>
<script src="/js/windows/game/add_port_window.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
<link href="{{ asset('css/popup.css') }}" rel="stylesheet">
@endsection
