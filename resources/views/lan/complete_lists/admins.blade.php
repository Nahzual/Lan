@extends('layouts.dashboard')

@section('title')
All the admins for the LAN {{ $nlan }}
@endsection

@section('page-title')
LAN's admins
@endsection

@section('title-buttons')
<div class="col mt-1">
	<form method="GET" action="{{ route('lan.add_admin', $id) }}">
		@csrf
		<button type="submit" class="btn btn-outline-success float-right"><i class='fa fa-plus-square'></i> Add a new Admin</button>
	</form>
</div>
@endsection

@section('content')

<div id="response-success-admin" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error-admin" class="alert alert-danger mt-2" style="display:none"></div>


<div class="table-responsive">
	<table class="text-center table card-table table-bordered">
		<thead class="card-table text-center">
			<th scope="col">#</th>
			<th scope="col">Username</th>
			<th scope="col">Actions</th>
		</thead>

		<tbody>
			@if (isset($admins))
			@foreach($admins as $admin)
			<tr id="row-admin-lan-{{$admin->id}}">
				<th>{{$admin->id}}</th>
				<td>
					{!!$admin->pseudo!!}
					@if($admin->id==$logged_user->id)
					<small class="text-warning">(You)</small>
					@endif
				</td>
				<td scope="col" class="text-center">
					<div class="btn-group text-center">
						{!! Form::open(['method' => 'get','url'=>route('user.show', $admin->id)]) !!}
							<button type="submit" class="mr-2 btn btn-success"><i class='fa fa-eye'></i></button>
						{!! Form::close() !!}
						{!! Form::open(['method' => 'delete','onsubmit'=>'return removeAdmin(event,'.$id.','.$admin->id.')']) !!}
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
			<a class="btn btn-secondary" href="{{ url('/lan/'.$id.'/admins/') }}" tabindex="-2">First</a>
		</li>
		<li class="page-item @if($previous == 0) disabled @endif">
			<a class="btn btn-outline-info" href="{{ $previous!=0 ?  url('/lan/'.$id.'/admins/'.($previous)) : '#' }}" tabindex="-1">Back</a>
		</li>
		<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/admins/'.($page)) }}">{{ $page }}</a></li>
		@if(($page+1)<=$max) <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/admins/'.($page+1)) }}">{{ ($page+1) }}</a></li>@endif
		@if(($page+2)<=$max)<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/admins/'.($page+2)) }}">{{ ($page+2) }}</a></li>@endif
		<li class="page-item @if($next) @else disabled @endif">
			<a class="btn btn-outline-info" href="{{ $next ? url('/lan/'.$id.'/admins/'.($next)) : '#' }}">Next</a>
		</li>
		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/lan/'.$id.'/admins/'.$max) }}">Last</a>
		</li>
	</ul>
</nav>

@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/lan/ajax_add_admin.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/game/game.css') }}" rel="stylesheet">
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
