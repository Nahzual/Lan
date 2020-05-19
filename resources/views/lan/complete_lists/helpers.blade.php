@extends('layouts.dashboard')

@section('title')
All the helpers for the LAN {!! $nlan !!}
@endsection

@section('page-title')
LAN's helpers
@endsection

@section('title-buttons')
<div class="col mt-1">
	<form method="GET" action="{{ route('lan.add_helper', $id) }}">
		@csrf
		@method('GET')
		<button type="submit" class="btn btn-outline-success float-right"><i class='fa fa-plus-square'></i> Add a new Helper</button>
	</form>
</div>
@endsection

@section('content')

<div id="response-success-helper" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error-helper" class="alert alert-danger mt-2" style="display:none"></div>

<div class="table-responsive">
	<table class="text-center table card-table table-bordered">
		<thead class="card-table text-center">
			<th scope="col">#</th>
			<th scope="col">Username</th>
			<th scope="col">Actions</th>
		</thead>

		<tbody>
			@if (isset($helpers))
			@if(count($helpers)==0)
			<tr>
				<td colspan="3"><h3>No helpers to show</h3></td>
			</tr>
			@endif

			@foreach($helpers as $helper)
			<tr id="row-helper-lan-{{$helper->id}}">
				<th>{{$helper->id}}</th>
				<td>{!!$helper->pseudo!!}</td>
				<td scope="col" class="text-center">
					<div class="btn-group text-center">
						{!! Form::open(['method' => 'get','url'=>route('user.show', $helper->id)]) !!}
						<button type="submit" class="mr-2 btn btn-success"><i class='fa fa-eye'></i></button>
						{!! Form::close() !!}
						{!! Form::open(['method' => 'delete','onsubmit'=>'return removeHelper(event,'.$id.','.$helper->id.')']) !!}
						<button type="submit" class="btn btn-danger"><i class='fa fa-times'></i></button>
						{!! Form::close() !!}
					</div>
				</td>
			</tr>
			@endforeach
			@endif
		</tbody>
	</table>
</div>

<nav aria-label="page navigation">
	<ul class="pagination justify-content-end">
		<li class="page-item">
			<a class="btn btn-info" href="{{ url('/lan/'.$id) }}" tabindex="-2">Return to the LAN</a>
		</li>
		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/lan/'.$id.'/helpers/') }}" tabindex="-2">First</a>
		</li>
		<li class="page-item @if($previous == 0) disabled @endif">
			<a class="btn btn-outline-info" href="{{ $previous!=0 ?  url('/lan/'.$id.'/helpers/'.($previous)) : '#' }}" tabindex="-1">Back</a>
		</li>
		<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/helpers/'.($page)) }}">{{ $page }}</a></li>
		@if(($page+1)<=$max) <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/helpers/'.($page+1)) }}">{{ ($page+1) }}</a></li>@endif
		@if(($page+2)<=$max)<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/helpers/'.($page+2)) }}">{{ ($page+2) }}</a></li>@endif
		<li class="page-item @if($next) @else disabled @endif">
			<a class="btn btn-outline-info" href="{{ $next ? url('/lan/'.$id.'/helpers/'.($next)) : '#' }}">Next</a>
		</li>
		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/lan/'.$id.'/helpers/'.$max) }}">Last</a>
		</li>
	</ul>
</nav>


@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/lan/ajax_add_helper.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/game/game.css') }}" rel="stylesheet">
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
