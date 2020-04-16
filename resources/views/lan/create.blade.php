@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					<h3 class="lead-title">Creating new Lan</h3>
				</div>
				<div class="card-body">
					<div class ="alert alert-success" style="display:none"></div>
					{!! Form::open(['method' => 'put', 'id' => 'CreateNewLanForm']) !!}
						<div class="bg-light">
							<div class="form-group">
								{!! Form::label('name', 'Name', ['class' => 'lead']) !!}
								{!! Form::text('name', null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('max_num_registrants', 'Maximum numbers of registrants', ['class' => 'lead']) !!}
								{!! Form::text('max_num_registrants', null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('opening_date', 'Date', ['class' => 'lead']) !!}
								{!! Form::text('opening_date', null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('duration', 'Duration', ['class' => 'lead']) !!}
								{!! Form::text('duration', null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('budget', 'Budget', ['class' => 'lead']) !!}
								{!! Form::text('budget', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group row text-center">
							<div class="col">
								<button type="submit" class="btn btn-primary" id="AddNewLanSubmit"><i class='fa fa-plus-square'></i> Add</button>
							</div>
							
							<div class="col">
								<a class="btn btn-primary" href="{{ route('lan.index') }}"><i class='fa fa-arrow-left'></i> Go Back to Lan List</a>
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
		$('#AddNewLanSubmit').click(function(e){
			e.preventDefault();
			$.ajaxSetup({
				headers:{
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: "{{ route('lan.store')}}",
				method: 'post',
				data: {
					name: $('#name').val(),
					max_num_registrants: $('#max_num_registrants').val(),
					opening_date: $('#opening_date').val(),
					duration: $('#duration').val(),
					budget: $('#budget').val()
				},
				success: function(result){
					$('.alert ').show();
					$('.alert ').html(result.success);
				}
			});
		});
	});
</script>
@endsection
