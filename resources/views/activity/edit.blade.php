@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
			<div class="row">
				<div class="col mt-2">
					<h3 class="lead-title">Editing Activity : {{$activity->name}}</h3>
				</div>
			</div>
		</div>

        <div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
        <div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

        <div class="card-body">
			{!! Form::model($activity, ['method' => 'put', 'onsubmit' => 'return sendRequest(event,'.$lan->id.','.$activity->id.')']) !!}
				<div class="bg-light">
					<div class="form-group">
						{!! Form::label('name_activity', 'Name', ['class' => 'lead']) !!}
						{!! Form::text('name_activity', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('desc_activity', 'Description', ['class' => 'lead']) !!}
						{!! Form::text('desc_activity', null, ['class' => 'form-control']) !!}
					</div>
				</div>
				<div class="form-group row text-center">
					<div class="col">
						<button type="submit" class="btn btn-primary"><i class='fa fa-edit'></i> Update</button>
					</div>
					<div class="col">
						<a class="btn btn-primary" href="{{ route('lan.show', $lan) }}"><i class='fa fa-arrow-left'></i> Go Back to Lan</a>
					</div>
				</div>
			{!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js_includes')
<script src="/js/ajax/activity/ajax_edit.js"></script>
@endsection
