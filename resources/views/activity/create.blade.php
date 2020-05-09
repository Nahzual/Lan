@extends('layouts.dashboard')

@section('content')
      <div class="card">
        <div class="card-header">
					<h3>{{$lan->name}} : Creating new Activity</h3>
				</div>
				<div class="card-body">
					<div id="response-success" class ="alert alert-success" style="display:none"></div>
					{!! Form::open(['method' => 'put', 'onsubmit'=>'return sendRequest(event,'.$lan->id.')']) !!}
						<div>
							<div class="form-group">
								{!! Form::label('name_activity', 'Name', ['class' => 'display-6']) !!}
								{!! Form::text('name_activity', null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('desc_activity', 'Description', ['class' => 'display-6']) !!}
								{!! Form::textarea('desc_activity', null, ['class' => 'form-control','size'=>'30x5']) !!}
							</div>
						</div>
						<div class="form-group row text-center">
							<div class="col">
								<button type="submit" class="btn btn-outline-success shadow-sm"><i class='fa fa-plus-square'></i> Add</button>
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
<script type="text/javascript" src="/js/ajax/activity/ajax_create.js" defer></script>
@endsection
