@extends('layouts.dashboard')

@section('content')
<div class="card">
	<div class="card-header">
		<h2>Create a LAN</h2>
	</div>
	<div class="card-body">

          <div id="response-success" class="container alert alert-success mt-2" style="display:none"></div>
          <div id="response-error" class="container alert alert-danger mt-2" style="display:none"></div>

			{!! Form::open(['method' => 'put', 'id' => 'CreateNewLanForm']) !!}
				<div>
					<div class="form-group">
						{!! Form::label('name', 'Name', ['class' => 'display-6']) !!}
						{!! Form::text('name', null, ['id'=>'name', 'class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('max_num_registrants', 'Maximum numbers of registrants', ['class' => 'display-6']) !!}
						{!! Form::number('max_num_registrants', null, ['id'=>'max_num_registrants','min'=>'1', 'class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('opening_date', 'Date', ['class' => 'display-6']) !!}
						{!! Form::date('opening_date', null, ['id'=>'opening_date','class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('duration', 'Duration (in days)', ['class' => 'display-6']) !!}
						{!! Form::number('duration', null, ['id'=>'duration','min'=>'1','class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('budget', 'Budget (in €)', ['class' => 'display-6']) !!}
						{!! Form::number('budget', null, ['id'=>'budget','min'=>'0', 'class' => 'form-control']) !!}
					</div>
              				<div class="form-group">
              					 {!! Form::label('room_length', 'Room length (in meters)', ['class' => 'display-6']) !!}
              				  	{!! Form::number('room_length', null, ['id'=>'room_length','min'=>'1', 'class' => 'form-control', 'onchange'=>'changeDimensions()']) !!}
              				</div>
              				<div class="form-group">
                				{!! Form::label('room_width', 'Room width (in meters)', ['class' => 'display-6']) !!}
                				{!! Form::number('room_width', null, ['id'=>'room_width','min'=>'1', 'class' => 'form-control', 'onchange'=>'changeDimensions()']) !!}
              				</div>
				</div>
				<div>
              				{!! Form::label('location', 'Location', ['class' => 'display-6']) !!}
					<div id="location" class="input-group mb-1">
						{!! Form::number('num_location', null, ['id'=>'num_location','min'=>'0', 'placeholder'=>'Street number','class' => 'form-control']) !!}
                				<span class="input-group-addon mr-2"></span>
						{!! Form::text('name_street', null, ['id'=>'name_street','placeholder'=>'Street Name', 'class' => 'form-control']) !!}
                				<span class="input-group-addon mr-2"></span>
               					 {!! Form::text('name_city', null, ['id'=>'name_city','placeholder'=>'City','class' => 'form-control']) !!}
					</div>
              				<div class="input-group mb-5">
                				{!! Form::text('zip_city', null, ['id'=>'zip_city','placeholder'=>'ZIP Code','class' => 'form-control']) !!}
                				<span class="input-group-addon mr-2"></span>
                				{!! Form::text('name_department', null, ['id'=>'name_department','placeholder'=>'Region Name','class' => 'form-control']) !!}
                				<span class="input-group-addon mr-2"></span>
                				{!! Form::text('name_country', null, ['id'=>'name_country','placeholder'=>'Country Name', 'class' => 'form-control']) !!}
					</div>
				</div>

				<hr/>
				{!! Form::label('room_plan', 'Room plan :', ['class' => 'display-6']) !!}
					
				<p class="lead-text">Legend :</p>
						<table>
							<tbody>
								<tr>
									<table style="display: inline-table;" class="border border-dark field">Wall : <td class="cell wall"></td></table>
								</tr>
								<tr>
									<td scope="col">Table :</td>
									<table style="display: inline-table;" class="border border-dark field"><td class="mr-2 cell table"></td></table>
								</tr>
								<tr>
									<td scope="col">Computer :</td>
									<table style="display: inline-table;" class="border border-dark field"><td class="cell computer"></td></table>
								</tr>
								<tr>
									<td scope="col">Console :</td>
									<table style="display: inline-table;" class="border border-dark field"><td class="cell console"></td></table>
								</tr>
								<tr>
									<td scope="col">Empty chair :</td>
									<table style="display: inline-table;" class="border border-dark field"><td class="cell chairNull"></td></table>
								</tr>
								<tr>
									<td scope="col">Empty space :</td>
									<table style="display: inline-table;" class="border border-dark field"><td class="mr-2 cell null"></td></table>
								</tr>
							</tbody>
						</table>

				<div id="plateau" class="form-group row text-center justify-content-center mt-5">
					<div id="result">

					</div>
				</div>

				<div class="form-group row text-center">
					<div class="col">
						<button type="submit" class="btn  btn-outline-success shadow-sm" id="AddNewLanSubmit"><i class='fa fa-plus-square'></i> Add</button>
					</div>
					<div class="col">
						<a class="btn  btn-outline-info shadow-sm" href="{{ route('my_lans') }}"><i class='fa fa-arrow-left'></i> Go back to my LANs</a>
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
		$('#AddNewLanSubmit').click(function(e){
			e.preventDefault();

			fillRoomPlaces(room);

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
					budget: $('#budget').val(),
					num_location: $('#num_location').val(),
					name_street: $('#name_street').val(),
					name_city: $('#name_city').val(),
					zip_city: $('#zip_city').val(),
					name_department: $('#name_department').val(),
					name_country: $('#name_country').val(),
          room_width: $('#room_width').val(),
          room_length: $('#room_length').val(),
					room: JSON.stringify(room)
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

@section('js_includes')
<script type="text/javascript" src="../js/room_plan/salle.js"></script>
<script type="text/javascript" src="../js/room_plan/create.js"></script>
@endsection

@section('css_includes')
<link rel="stylesheet" href="../css/room_plan/salle.css"></link>
@endsection
