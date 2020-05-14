@extends('layouts.dashboard')

@section('title')
Adding helper to Task : {!!$task->name_task!!}
@endsection

@section('page-title')
Adding helper to Task
@endsection

@section('content')
<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

{!! Form::open(['method' => 'post','onsubmit'=>'searchHelper(event,'.$task->id.')']) !!}
	<div class="bg-light">
		<h4 class=''>Helper's name :</h4>
		<div class="form-group">
			{!! Form::text('pseudo', null, ['required'=>'', 'class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group row text-center">
		<div class="col">
			<button type="submit" class="btn btn-primary"><i class='fa fa-search'></i> Search</button>
		</div>
	</div>
{!! Form::close() !!}

<div id="requestResult">
</div>
@endsection

@section('js_includes')
<script src="/js/ajax/task/ajax_add_helper.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
