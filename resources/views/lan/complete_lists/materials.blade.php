@extends('layouts.dashboard')

@section('title')
All the materials for the LAN {!! $nlan !!}<small>#{{$id}}</small>
@endsection

@section('page-title')
LAN's materials
@endsection

@section('title-buttons')
<div class="col mt-1">
	<form method="GET" action="{{ route('lan.add_material', $id) }}">
		@csrf
		@method('GET')
		<button type="submit" class="btn btn-outline-success float-right"><i class='fa fa-plus-square'></i> Add a Material</button>
	</form>
</div>
@endsection

@section('content')

<div id="response-success-material" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error-material" class="alert alert-danger mt-2" style="display:none"></div>

<div class="table-responsive">
	<table class="table card-table text-center">
		<thead class="card-table text-center">
			<th scope="col">#</th>
			<th scope="col">Name</th>
			<th scope="col">Quantity</th>
			<th scope="col">Actions</th>
		</thead>

		<tbody>
			@if(count($materials)==0)
			<tr>
				<td colspan="6"><h3 class="text-center">No materials to show</h3></td>
			</tr>
			@endif

			@foreach($materials as $material)
			<tr id="row-material-lan-{{$material->id}}">
				<th scope="row" class="text-center">{{$material->id}}</th>
				<td scope="col" class="text-center">{!!$material->name_material!!}</td>
				<td scope="col" class="text-center">
					{!! Form::number('quantity-'.$material->id,$material->quantity,['class'=>'form-control text-center','min'=>'1']) !!}
					{!! Form::open(['method' => 'put','url'=>'', 'onsubmit'=>'return editQuantity(event,'.$id.','.$material->id.')']) !!}
					<div class="form-group text-center mt-2">
						<div class="col">
							<button type="submit" class="btn btn-primary"><i class='fa fa-edit'></i> Edit quantity</button>
						</div>
					</div>
					{!! Form::close() !!}
				</td>

				<td scope="col">
					<button class="btn btn-success mb-1" id="material-view-{{$material->id}}" onclick="openMaterial({{$material->id}})"><i class='fa fa-eye'></i></button>
					{!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeMaterial(event,'.$id.','.$material->id.')']) !!}
					<button type="submit" class="d-inline btn btn-danger"><i class='fa fa-times'></i></button>
					{!! Form::close() !!}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<nav aria-label="page navigation">
	<ul class="pagination justify-content-end">
		<li class="page-item">
			<a class="btn btn-info" href="{{ url('/lan/'.$id) }}" tabindex="-2">Return to the LAN</a>
		</li>

		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/lan/'.$id.'/materials/') }}" tabindex="-2">First</a>
		</li>
		<li class="page-item @if($previous == 0) disabled @endif">
			<a class="btn btn-outline-info" href="{{ $previous!=0 ?  url('/lan/'.$id.'/materials/'.($previous)) : '#' }}" tabindex="-1">Back</a>
		</li>
		<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/materials/'.($page)) }}">{{ $page }}</a></li>
		@if(($page+1)<=$max) <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/materials/'.($page+1)) }}">{{ ($page+1) }}</a></li>@endif
		@if(($page+2)<=$max)<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/materials/'.($page+2)) }}">{{ ($page+2) }}</a></li>@endif
		<li class="page-item @if($next) @else disabled @endif">
			<a class="btn btn-outline-info" href="{{ $next ? url('/lan/'.$id.'/materials/'.($next)) : '#' }}">Next</a>
		</li>
		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/lan/'.$id.'/materials/'.$max) }}">Last</a>
		</li>
	</ul>
</nav>

@foreach($materials as $material)
<div id="popup-material-{{$material->id}}" class="popup">
	<div class="popup-content">
		<span onclick="closeMaterial({{$material->id}})" class="close">&times;</span>
		@include('material.show',$material)
	</div>
</div>
@endforeach

@endsection

@section('js_includes')
<script type="text/javascript" src="/js/windows/material/display_window.js"></script>
<script src="/js/ajax/material/ajax_edit.js"></script>
<script src="/js/ajax/lan/ajax_remove_material.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/popup.css') }}" rel="stylesheet">
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
