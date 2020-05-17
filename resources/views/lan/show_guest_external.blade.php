@extends('layouts.app')

<?php
$date = date_create($lan->opening_date);
$today = date_create(date('Y-m-d'));
$time_left = $today->diff($date);
$places_left=count($lan->real_users); ?>

@section('content')
		<div class="row text-center esp">
			@if(!$time_left->invert)
			<div class="col">
				<h2><i class="text-warning fa fa-clock-o"></i> {{$time_left->days}} days left to join !</h2>
				@if($places_left<$lan->max_num_registrants)
				<h2><i class="text-warning fa fa-warning"></i> {{$lan->max_num_registrants-count($lan->real_users)}}/{{$lan->max_num_registrants}} places left !</h2>
				@else
				<h2><i class="text-danger fa fa-warning"></i> No places left !</h2>
				@endif
			</div>
			@endif

		</div>
		<div class="row justify-content-center">
			<div class="col-md-7">

				@include('lan.show_guest_parts.about_card')
			</div><!-- col 1-->
			<div class="col-md-3">
				@include('lan.show_guest_parts.quick_links_external')
			</div>
		</div>
		<div class="row esp justify-content-center">
			<div class="col-md-5">
				@include('lan.show_guest_parts.games_card')
			</div>

			<div class="col-md-5">
				@include('lan.show_guest_parts.tour_card')

			</div>
		</div><!-- row -->
		<div class="row esp justify-content-center">
			<div class="col-md-5">
				@include('lan.show_guest_parts.activities_card')
			</div>

		</div><!-- row -->
		<div class="row esp">
			<div class="col-md-11">
				<a class="btn btn-info shadow-sm float-right" href="{{ route('all_lans') }}"><i class='fa fa-arrow-left'></i> Go back to LANs list</a>
			</div>
		</div>
@endsection

@section('js_includes')


<!-- pop-up windows scripts -->
<script src="/js/windows/activity/display_window.js"></script>
<script src="/js/windows/material/display_window.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
<link href="{{ asset('css/popup.css') }}" rel="stylesheet">
@endsection
