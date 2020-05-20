@extends('layouts.dashboard')

@section('title')
{{ __('messages.my_tasks') }}
@endsection

@section('page-title')
{{ __('messages.my_tasks') }}
@endsection

@section('content')
@if(empty($tasks))
<div id="accordion">
	<?php $end=$tasks->keys()->last(); ?>
	@foreach($tasks as $index=>$lan_tasks)
	<div class="card">
		<div class="card-header" id="heading-{{$index}}">
			<div class="row">
				<div class="col mt-2">
					<h3>{{ __('messages.my_tasks_lan') }} {!!$lan_tasks[0]->name!!}</h3>
				</div>
				<div class="col mt-1">
					<button class="btn btn-outline-dark shadow-sm float-right" data-toggle="collapse" data-target="#collapse-{{$index}}" aria-expanded="true" aria-controls="collapse-{{$index}}">{{ __('messages.show_hide') }}</button>
				</div>
			</div>
		</div>

		<div id="collapse-{{$index}}" class="collapse" aria-labelledby="heading-{{$index}}" data-parent="#accordion">
			<div class="card-body table-responsive esp" id="lan-tasks-{{$lan_tasks[0]->lan_id}}">
				<table class="table card-table table-bordered box_shadow">
					<thead class="text-center">
						<th scope="col">#</th>
						<th scope="col">{{ __('messages.name') }}</th>
						<th scope="col">{{ __('messages.description') }}</th>
						<th scope="col">{{ __('messages.deadline') }}</th>
						<th scope="col">{{ __('messages.actions') }}</th>
					</thead>

					<tbody>
						@foreach($lan_tasks as $task)
						<tr>
							<th class="text-center">{{$task->id}}</th>
							<td class="text-center">{!!$task->name_task!!}</td>
							<td class="text-center">{!! $task->desc_task !!}</td>
							<td class="text-center">{{date_format(date_create($task->deadline_task), config("display.DATE_FORMAT"))}}</td>
							<td class="text-center">
								<a class="btn btn-success" href="{{ route('task.show', [$task->lan_id,$task->id]) }}"><i class='fa fa-eye'></i> {{ __('messages.view') }}</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@endforeach
</div>
@else
<div class="card">
		<div class="card-header">
				<div class="row">
					<div class="col mt-2">
						<h3>{{ __('messages.no_tasks') }}</h3>
					</div>
				</div>
		</div>
</div>
@endif
@endsection

@section('js_includes')
<script src="/js/ajax/lan/ajax_all_lans_list.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
