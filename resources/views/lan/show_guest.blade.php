@extends('layouts.dashboard')

@section('content')
<?php $date = date_create($lan->opening_date); ?>
<div class="card">
	<div class="card-header">
		<div class="row">
			<h3>Viewing : {{$lan->name}}</h3>
			<div class="col">
				<a class="btn btn-success float-right" href="{{ route('lan.participate', $lan->id) }}"><i class="fa fa-sign-in"></i> Participate</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-8">

				@include('lan.show_guest_parts.about_card')
		  </div><!-- col 1-->
			<div class="col-md-4">
				@include('lan.show_guest_parts.quick_links')
			</div>
		</div>
		<div class="row esp">
			<div class="col-md-6">
				@include('lan.show_guest_parts.games_card')
			</div>

			<div class="col-md-6">
				@include('lan.show_guest_parts.tour_card')

			</div>
		</div><!-- row -->
		<div class="row esp mt-5">
			<div class="col-md-6">
				@include('lan.show_guest_parts.activities_card')
			</div>

		</div><!-- row -->
		<div class="row esp">
			<div class="col-md-12">
				<a class="btn btn-outline-info shadow-sm float-right" href="{{ route('all_lans') }}"><i class='fa fa-arrow-left'></i> Go back to LANs list</a>
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
<script src="/js/ajax/task/ajax_delete.js"></script>


<!-- pop-up windows scripts -->
<script src="/js/windows/activity/display_window.js"></script>
<script src="/js/windows/material/display_window.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
<link href="{{ asset('css/popup.css') }}" rel="stylesheet">
@endsection
