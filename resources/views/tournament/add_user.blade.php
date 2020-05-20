@extends('layouts.dashboard')

@section('title')
Add players to tournament {!! $tournament->name_tournament !!}
@endsection

@section('page-title')
Tournaments players
@endsection

@section('content')
<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

{!! Form::open(['method'=>'get','url'=>'/tournament/'.$tournament->id.'/join']) !!}
	<div class="row form-group">
		<div class="col">
			<h4> {{__('messages.username')}} </h4>
			{!! Form::text('pseudo',(isset($username)) ? $username : null,['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="row form-group text-center">
		<div class="col">
			<button type="submit" class="btn btn-outline-info shadow-sm"><i class="fa fa-search"></i> {{__('messages.search')}}</button>
		</div>
	</div>
{{ Form::close() }}


<hr>

<div class="row">
	<div class="col">
		<div class="table-responsive">
			<table class="text-center table card-table table-bordered">
				<thead class="card-table text-center">
					<th scope="col">#</th>
					<th scope="col">{{ __('messages.name') }}</th>
					<th scope="col">{{ __('messages.actions') }}</th>
				</thead>

				<tbody>
					@if (isset($users))
						@if(count($users)==0)
						<tr>
							<td colspan="3"><h3>{{ __('messages.nouser') }}</h3></td>
						</tr>
						@endif

						@foreach($users as $user)
						<tr id="row-user-lan-{{$user->id}}">
							<th>{{$user->id}}</th>
							<td>{!!$user->pseudo!!}</td>
							<td scope="col" class="text-center">
								<div class="btn-group text-center">
									{!! Form::open(['method'=>'get','url'=>route('user.show',$user->id) ]) !!}
										<button type=submit class="mr-2 btn btn-success"><i class='fa fa-eye'></i> {{ __('messages.view') }}</button>
									{{ Form::close() }}
									{!! Form::open(['method'=>'post','onsubmit'=>'join(event,'.$tournament->id.','.$user->id.')']) !!}
										<button type="submit" class="btn btn-primary"><i class='fa fa-plus'></i> Add to tournament</button>
									{{ Form::close() }}
								</div>
							</td>
						</tr>
						@endforeach
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>

<nav aria-label="page navigation">
	<ul class="pagination justify-content-end">
		@if(!isset($username))
		<a class="btn btn-info" href="{{ url('/dashboard/admin') }}" tabindex="-2">{{ __('messages.back_admin_dash') }}</a>

		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/tournament/'.$tournament->id.'/join') }}" tabindex="-2">{{ __('messages.first') }}</a>
		</li>
		<li class="page-item @if($previous == 0) disabled @endif">
			<a class="btn btn-outline-info" href="{{ $previous!=0 ?  url('tournament/'.$tournament->id.'/join/'.($previous)) : '#' }}" tabindex="-1">{{ __('messages.back') }}</a>
		</li>
		<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/tournament/'.$tournament->id.'/join/'.($page)) }}">{{ $page }}</a></li>
		@if(($page+1)<=$max) <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/tournament/'.$tournament->id.'/join/'.($page+1)) }}">{{ ($page+1) }}</a></li>@endif
		@if(($page+2)<=$max)<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/tournament/'.$tournament->id.'/join/'.($page+2)) }}">{{ ($page+2) }}</a></li>@endif
		<li class="page-item @if($next) @else disabled @endif">
			<a class="btn btn-outline-info" href="{{ $next ? url('/tournament/'.$tournament->id.'/join/'.($next)) : '#' }}">{{ __('messages.next') }}</a>
		</li>
		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/tournament/'.$tournament->id.'/join/'.$max) }}">{{ __('messages.last') }}</a>
		</li>
		@else
		<a class="btn btn-info" href="{{ url('/dashboard/admin?pseudo='.$username) }}" tabindex="-2">{{ __('messages.back_admin_dash') }}</a>

		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/tournament/'.$tournament->id.'/join?pseudo='.$username) }}" tabindex="-2">{{ __('messages.first') }}</a>
		</li>
		<li class="page-item @if($previous == 0) disabled @endif">
			<a class="btn btn-outline-info" href="{{ $previous!=0 ?  url('tournament/'.$tournament->id.'/join/'.($previous).'?pseudo='.$username) : '#' }}" tabindex="-1">{{ __('messages.back') }}</a>
		</li>
		<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/tournament/'.$tournament->id.'/join/'.($page).'?pseudo='.$username) }}">{{ $page }}</a></li>
		@if(($page+1)<=$max) <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/tournament/'.$tournament->id.'/join/'.($page+1).'?pseudo='.$username) }}">{{ ($page+1) }}</a></li>@endif
		@if(($page+2)<=$max)<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/tournament/'.$tournament->id.'/join/'.($page+2).'?pseudo='.$username) }}">{{ ($page+2) }}</a></li>@endif
		<li class="page-item @if($next) @else disabled @endif">
			<a class="btn btn-outline-info" href="{{ $next ? url('/tournament/'.$tournament->id.'/join/'.($next).'?pseudo='.$username) : '#' }}">{{ __('messages.next') }}</a>
		</li>
		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/tournament/'.$tournament->id.'/join/'.$max.'?pseudo='.$username) }}">{{ __('messages.last') }}</a>
		</li>
		@endif
	</ul>
</nav>
@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/tournament/ajax_join.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
