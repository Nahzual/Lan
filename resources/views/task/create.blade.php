@extends('layouts.dashboard')

@section('content')
      <div class="card">
        <div class="card-header">
					<h3 class="">Creating new task for {{$lan->name}}<small>#{{$lan->id}}</small></h3>
				</div>
				<div class="card-body">
					<div id="response-success" class="alert alert-success" style="display:none"></div>
					{!! Form::open(['method' => 'post', 'onsubmit'=>'return sendRequest(event,'.$lan->id.')']) !!}
						<div >
							<div class="form-group">
								{!! Form::label('name_task', 'Name', ['class' => '']) !!}
								{!! Form::text('name_task', null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('desc_task', 'Description of the task', ['class' => '']) !!}
								{!! Form::text('desc_task', null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('deadline_task', 'Deadline of the task', ['class' => '']) !!}
								{!! Form::date('deadline_task', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group row text-center">
							<div class="col">
								<button type="submit" class="btn btn-outline-success shadow-sm"><i class='fa fa-plus-square'></i> Add</button>
							</div>

							<div class="col">
								<a class="btn btn-outline-info shadow-sm" href="{{ route('task.all') }}"><i class='fa fa-arrow-left'></i> Go to your tasklist</a>
							</div>
						</div>
					{!! Form::close() !!}
        </div>
      </div>
@endsection

@section('js_includes')
<script src="/js/ajax/task/ajax_create.js" defer></script>
@endsection
