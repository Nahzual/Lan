@extends('layouts.dashboard')

@section('title')
Viewing : {!!$tournament->name_tournament!!}
@endsection

@section('page-title')
Tournament page
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div id="response-success" class ="alert alert-success" style="display:none"></div>
		<div id="response-error" class ="alert alert-danger" style="display:none"></div>
		@include('tournament.show_parts.about_card')
	</div><!-- col 1-->
</div>


	<div class="col-md-12">
		<div id="response-success-teams" class="container alert alert-success mt-2" style="display:none"></div>
		<div id="response-error-teams" class="container alert alert-danger mt-2" style="display:none"></div>
		@include('tournament.show_parts.team_card')
	</div>
@endsection

@section('js_includes')
<script src="/js/ajax/team/ajax_delete.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
<link href="{{ asset('css/popup.css') }}" rel="stylesheet">
@endsection
