@extends('layouts.dashboard')

@section('title')
{{ __('messages.materials') }}
@endsection

@section('page-title')
{{ __('messages.materials') }}
@endsection

@section('content')
<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

{!! Form::open(['method'=>'get','url'=>'/adm/materials']) !!}
	<div class="row form-group">
		<div class="col">
			<h4>{{ __('messages.material_name_or_cat') }}</h4>
			{!! Form::text('name_material',(isset($name)) ? $name : null,['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="row form-group text-center">
		<div class="col">
			<button type="submit" class="btn btn-outline-info shadow-sm"><i class="fa fa-search"></i> {{ __('messages.search') }}</button>
		</div>
	</div>
{{ Form::close() }}


<hr>

<div class="row">
	<div class="col">
		<div class="table-responsive">
			<table class="table card-table text-center">
				<thead class="card-table text-center">
					<th scope="col">#</th>
					<th scope="col">{{ __('messages.name') }}</th>
					<th scope="col">{{ __('messages.actions') }}</th>
				</thead>

				<tbody>
					@if(count($materials)==0)
					<tr>
						<td colspan="6"><h3 class="text-center">{{ __('messages.no_materials') }}</h3></td>
					</tr>
					@endif

					@foreach($materials as $material)
					<tr id="row-material-{{$material->id}}">
						<th scope="row" class="text-center">{{$material->id}}</th>
						<td scope="col" class="text-center">{!!$material->name_material!!}</td>
						<td scope="col">
							<div class="btn-group">
								<button class="btn btn-success mb-1" id="material-view-{{$material->id}}" onclick="openMaterial({{$material->id}})"><i class='fa fa-eye'></i></button>
								{!! Form::open(['method' => 'get','url'=>route('material.edit',$material->id)]) !!}
									<button type="submit" class="mb-1 d-inline btn btn-warning"><i class='fa fa-edit'></i></button>
								{!! Form::close() !!}
								{!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return sendRequest(event,'.$material->id.')']) !!}
									<button type="submit" class="d-inline btn btn-danger"><i class='fa fa-trash'></i></button>
								{!! Form::close() !!}
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<nav aria-label="page navigation">
	<ul class="pagination justify-content-end">
		@if(!isset($name))
		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/adm/materials/') }}" tabindex="-2">{{ __('messages.first') }}</a>
		</li>
		<li class="page-item @if($previous == 0) disabled @endif">
			<a class="btn btn-outline-info" href="{{ $previous!=0 ?  url('/adm/materials/'.($previous)) : '#' }}" tabindex="-1">{{ __('messages.back') }}</a>
		</li>
		<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/adm/materials/'.($page)) }}">{{ $page }}</a></li>
		@if(($page+1)<=$max) <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/adm/materials/'.($page+1)) }}">{{ ($page+1) }}</a></li>@endif
		@if(($page+2)<=$max)<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/adm/materials/'.($page+2)) }}">{{ ($page+2) }}</a></li>@endif
		<li class="page-item @if($next) @else disabled @endif">
			<a class="btn btn-outline-info" href="{{ $next ? url('/adm/materials/'.($next)) : '#' }}">{{ __('messages.next') }}</a>
		</li>
		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/adm/materials/'.$max) }}">{{ __('messages.last') }}</a>
		</li>
		@else
		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/adm/materials/?name_material='.$name) }}" tabindex="-2">{{ __('messages.first') }}</a>
		</li>
		<li class="page-item @if($previous == 0) disabled @endif">
			<a class="btn btn-outline-info" href="{{ $previous!=0 ?  url('/adm/materials/'.($previous).'?name_material='.$name) : '#' }}" tabindex="-1">{{ __('messages.back') }}</a>
		</li>
		<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/adm/materials/'.($page).'?name_material='.$name) }}">{{ $page }}</a></li>
		@if(($page+1)<=$max) <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/adm/materials/'.($page+1).'?name_material='.$name) }}">{{ ($page+1) }}</a></li>@endif
		@if(($page+2)<=$max)<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/adm/materials/'.($page+2).'?name_material='.$name) }}">{{ ($page+2) }}</a></li>@endif
		<li class="page-item @if($next) @else disabled @endif">
			<a class="btn btn-outline-info" href="{{ $next ? url('/adm/materials/'.($next).'?name_material='.$name) : '#' }}">{{ __('messages.next') }}</a>
		</li>
		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/adm/materials/'.$max.'?name_material='.$name) }}">{{ __('messages.last') }}</a>
		</li>
		@endif
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
<script type="text/javascript" src="/js/ajax/material/ajax_delete.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/popup.css') }}" rel="stylesheet">
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
