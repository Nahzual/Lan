@extends('layouts.dashboard')

@section('content')
      <div class="card">
        <div class="card-header">
			<div class="row">
				<div class="col mt-2">
					<h3 >Editing Activity : {!!$activity->name!!}</h3>
				</div>
			</div>
		</div>

        <div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
        <div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

        <div class="card-body">
			{!! Form::model($activity, ['method' => 'put', 'onsubmit' => 'return sendRequest(event,'.$lan->id.','.$activity->id.')']) !!}
				<div>
					<div class="form-group">
						{!! Form::label('name_activity', 'Name', ['class' => 'display-6']) !!}
						{!! Form::text('name_activity', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('desc_activity', 'Description', ['class' => 'display-6']) !!}
						{!! Form::textarea('desc_activity', null, ['class' => 'form-control']) !!}
					</div>
				</div>
				<div class="form-group row text-center">
					<div class="col">
						<button type="submit" class="btn btn-outline-warning shadow-sm"><i class='fa fa-edit'></i> Update</button>
					</div>
					<div class="col">
						<a class="btn btn-outline-info shadow-sm" href="{{ route('lan.show', $lan) }}"><i class='fa fa-arrow-left'></i> Go Back to Lan</a>
					</div>
				</div>
			{!! Form::close() !!}
        </div>
      </div>
@endsection

@section('js_includes')
<script src="/js/ajax/activity/ajax_edit.js"></script>
@endsection
