@extends('layouts.dashboard')

@section('title')
Site Users
@endsection

@section('page-title')
Site Users
@endsection

@section('content')
<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

{!! Form::open(['method'=>'get','url'=>'/adm/users']) !!}
	<div class="row form-group">
		<div class="col">
			<h4>Username :</h4>
			{!! Form::text('pseudo',($username) ? $username : null,['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="row form-group text-center">
		<div class="col">
			<button type="submit" class="btn btn-outline-info shadow-sm"><i class="fa fa-search"></i> Search</button>
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
										<button type=submit class="mr-2 btn btn-success"><i class='fa fa-eye'></i></button>
									{{ Form::close() }}
									{!! Form::open(['id'=>'form-undo-'.$user->id,'method'=>'post','onsubmit'=>'restoreUserList(event,'.$user->id.')','style'=>($user->trashed()) ? '' : 'display: none;']) !!}
										<button type="submit" class="btn btn-primary"><i class='fa fa-undo'></i></button>
									{{ Form::close() }}
									{!! Form::open(['id'=>'form-ban-'.$user->id,'method'=>'post','onsubmit'=>'banUserList(event,'.$user->id.')','style'=>(!$user->trashed()) ? '' : 'display: none;']) !!}
										<button type="submit" class="btn btn-danger"><i class='fa fa-ban'></i></button>
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
		<li class="page-item">
			<a class="btn btn-info" href="{{ url('/dashboard/admin') }}" tabindex="-2">{{ __('messages.back_admin_dash') }}</a>

			<li class="page-item">
				<a class="btn btn-secondary" href="{{ url('/adm/users') }}" tabindex="-2">{{ __('messages.first') }}</a>
			</li>
			<li class="page-item @if($previous == 0) disabled @endif">
				<a class="btn btn-outline-info" href="{{ $previous!=0 ?  url('adm/users/'.($previous)) : '#' }}" tabindex="-1">{{ __('messages.back') }}</a>
			</li>
			<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/adm/users/'.($page)) }}">{{ $page }}</a></li>
			@if(($page+1)<=$max) <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/adm/users/'.($page+1)) }}">{{ ($page+1) }}</a></li>@endif
			@if(($page+2)<=$max)<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/adm/users/'.($page+2)) }}">{{ ($page+2) }}</a></li>@endif
			<li class="page-item @if($next) @else disabled @endif">
				<a class="btn btn-outline-info" href="{{ $next ? url('/adm/users/'.($next)) : '#' }}">{{ __('messages.next') }}</a>
			</li>
			<li class="page-item">
				<a class="btn btn-secondary" href="{{ url('/adm/users/'.$max) }}">{{ __('messages.last') }}</a>
			</li>
		</ul>
	</nav>
@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/user/ajax_delete.js"></script>
<script type="text/javascript" src="/js/ajax/user/ajax_restore.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/game/game.css') }}" rel="stylesheet">
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
