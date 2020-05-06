@extends('layouts.dashboard')

@section('content')
      <div class="card">
        <div class="card-header">
					<h3 class="">Creating new task for {{$lan->name}}<small>#{{$lan->id}}</small></h3>
				</div>
				<div class="card-body">
					<div id="response-success" class="alert alert-success" style="display:none"></div>
					{!! Form::open(['method' => 'post', 'id' => 'CreateNewTaskForm']) !!}
						<div class="bg-light">
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
								<button type="submit" class="btn btn-primary" id="AddNewTaskSubmit"><i class='fa fa-plus-square'></i>Add</button>
							</div>

							<div class="col">
								<a class="btn btn-primary" href="{{ route('task.all') }}"><i class='fa fa-arrow-left'></i> Go to your tasklist</a>
							</div>
						</div>
					{!! Form::close() !!}
        </div>
      </div>

<script src=" http://code.jquery.com/jquery-3.3.1.min.js"
					integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
					crossorigin="anonymous">
</script>
<script>
	$(document).ready(function(){
		$('#AddNewTaskSubmit').click(function(e){
			e.preventDefault();
			$.ajaxSetup({
				headers:{
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: "{{ route('task.store',$lan->id)}}",
				method: 'post',
				data: {
					name_task: $('#name_task').val(),
					desc_task: $('#desc_task').val(),
					deadline_task: $('#deadline_task').val(),
				},
				success: function(result){
					$('#response-success').show();
					$('#response-success').html(result.success);
				}
			});
		});
	});
</script>
@endsection
