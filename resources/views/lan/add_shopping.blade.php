@extends('layouts.app')

@section('title')
Adding shopping to : {!!$lan->name!!}<small>#{{$lan->id}}</small>
@endsection

@section('page-title')
Adding shopping to LAN
@endsection

@section('content')

<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

{!! Form::open(['method' => 'post','onsubmit'=>'return searchShoppings(event,'.$lan->id.')']) !!}
	<div class="bg-light">
		<h4 class='lead'>Shopping's name :</h4>
		<div class="form-group">
			{!! Form::hidden('view_path', 'shopping.list_add_lan') !!}
			{!! Form::text('name_shopping', null, ['required'=>'', 'class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn btn-primary"><i class='fa fa-search'></i> Search</button>
		</div>
	</div>
{!! Form::close() !!}

<div id="request-result">
	<?php if(!isset($materials)){
		$materials=[];
	}?>
	@include('shopping.list_add_lan')
</div>
@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/shopping/ajax_lan.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
