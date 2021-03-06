@extends('layouts.dashboard')

@section('title')
{{ __('messages.all_task_lan') }} {!! $nlan !!}
@endsection

@section('page-title')
{{ __('messages.lan_task') }}
@endsection

@section('title-buttons')
<div class="col mt-1">
	<form method="GET" action="{{ route('task.create', $id) }}">
		@csrf
		@method('GET')
		<button type="submit" class="btn btn-outline-success float-right"><i class='fa fa-plus-square'></i> {{ __('messages.add_task') }}</button>
	</form>
</div>
@endsection

@section('content')


<div id="response-success-task" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error-task" class="alert alert-danger mt-2" style="display:none"></div>

<div class="table-responsive">
	<table class="text-center table card-table table-bordered">
		<thead class="card-table text-center">
			<th scope="col" >#</th>
			<th scope="col" >{{ __('messages.name') }}</th>
			<th scope="col" >{{ __('messages.actions') }}</th>
		</thead>

		<tbody>
			@if(count($tasks)==0)
			<tr>
				<td colspan="5"><h3 class="text-center">{{ __('messages.no_tasks') }}</h3></td>
			</tr>
			@endif
			@foreach($tasks as $task)
			<tr id="row-task-lan-{{$task->id}}">
				<th scope="row">{{$task->id}}</th>
				<td scope="col">{!!$task->name_task!!}</td>
				<td scope="col" class=" text-center">
					<div class="btn-group">
						{!! Form::open(['method'=>'get','url'=>route('task.show',[$lan->id,$task->id])]) !!}
						<button type="submit" class="btn btn-success mr-2"><i class='fa fa-eye'></i> {{ __('messages.view') }}</button>
						{{ Form::close() }}
						@if ($userIsLanAdmin)
						{!! Form::open(['method'=>'get','url'=>route('task.edit',[$lan->id,$task->id])]) !!}
						<button type="submit" class="btn btn-warning mr-2"><i class='fa fa-edit'></i> {{ __('messages.edit') }}</button>
						{{ Form::close() }}
						{!! Form::open(['method'=>'get','url'=>route('task.assign',[$lan->id,$task->id])]) !!}
						<button type="submit" class="btn btn-primary mr-2"><i class='fa fa-user-plus'></i> {{ __('messages.assign') }}</button>
						{{ Form::close() }}
						{!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return deleteTask(event, '.$lan->id.', '.$task->id.')']) !!}
						<button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> {{ __('messages.delete') }}</button>
						{!! Form::close() !!}
						@endif
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<nav aria-label="page navigation">
	<ul class="pagination justify-content-end">
		<li class="page-item">
			<a class="btn btn-info" href="{{ url('/lan/'.$id) }}" tabindex="-2">{{ __('messages.back_lan') }}</a>
		</li>

		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/lan/'.$id.'/tasks/') }}" tabindex="-2">{{ __('messages.first') }}</a>
		</li>
		<li class="page-item @if($previous == 0) disabled @endif">
			<a class="btn btn-outline-info" href="{{ $previous!=0 ?  url('/lan/'.$id.'/tasks/'.($previous)) : '#' }}" tabindex="-1">{{ __('messages.back') }}</a>
		</li>
		<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/tasks/'.($page)) }}">{{ $page }}</a></li>
		@if(($page+1)<=$max) <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/tasks/'.($page+1)) }}">{{ ($page+1) }}</a></li>@endif
		@if(($page+2)<=$max)<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/tasks/'.($page+2)) }}">{{ ($page+2) }}</a></li>@endif
		<li class="page-item @if($next) @else disabled @endif">
			<a class="btn btn-outline-info" href="{{ $next ? url('/lan/'.$id.'/tasks/'.($next)) : '#' }}">{{ __('messages.next') }}</a>
		</li>
		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/lan/'.$id.'/tasks/'.$max) }}">{{ __('messages.last') }}</a>
		</li>
	</ul>
</nav>
@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/game/ajax.js"></script>
<script src="/js/ajax/task/ajax_delete.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/game/game.css') }}" rel="stylesheet">
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
