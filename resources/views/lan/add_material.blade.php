@extends('layouts.dashboard')

@section('content')
<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col mt-2">
							<h3>Adding materials to : {!!$lan->name!!}<small>#{{$lan->id}}</small></h3>
						</div>
					</div>
				</div>

				<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
				<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

				<div class="card-body">
					{!! Form::open(['method' => 'post','onsubmit'=>'return searchMaterials(event,'.$lan->id.')']) !!}
					<div>
						<h4>Material's name :</h4>
						<div class="form-group">
							{!! Form::hidden('view_path', 'material.list_add_lan') !!}
							{!! Form::text('name_material', null, ['required'=>'', 'class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group row text-center">
						<div class="col">
							<button type="submit" class="btn btn-outline-info shadow-sm"><i class='fa fa-search'></i> Search</button>
						</div>
					</div>
					{!! Form::close() !!}
				</div>

				<div id="request-result">
					<?php if(!isset($materials)){
						$materials=[];
					}?>
					@include('material.list_add_lan')
				</div>
			<div class="col besp text-right">
							<a class="btn btn-outline-info shadow-sm" href="{{ route('lan.show', $lan) }}"><i class='fa fa-arrow-left'></i> Go back to Lan</a>
						</div>
      </div>
			</div>
		</div>
@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/material/ajax_lan.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
