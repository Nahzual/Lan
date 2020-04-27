@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					<h3 class="lead-title">{{$lan->name}} : Creating new Activity</h3>
				</div>
				<div class="card-body">
					<div id="response-success" class ="alert alert-success" style="display:none"></div>
					{!! Form::open(['method' => 'put', 'id' => 'CreateNewActivityForm']) !!}
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
								<button type="submit" class="btn btn-primary" id="AddNewActivitySubmit"><i class='fa fa-plus-square'></i> Add</button>
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

<script src=" http://code.jquery.com/jquery-3.3.1.min.js"
					integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
					crossorigin="anonymous">
</script>
<script>
	$(document).ready(function(){
		$('#AddNewActivitySubmit').click(function(e){
			e.preventDefault();
			$.ajaxSetup({
				headers:{
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: "{{ route('activity.store', $lan) }}",
				method: 'post',
				data: {
					name_activity: $('#name_activity').val(),
					desc_activity: $('#desc_activity').val()
				},
				success: function(result){
					if(result.success!=undefined){
						$('#response-success').show();
						$('#response-success').html(result.success);
					}else{
						$('#response-error').show();
						$('#response-error').html(result.error);
					}
				}
			});
		});
	});
</script>
@endsection
