@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					<h3 class="lead-title">Creating new Shopping</h3>
				</div>
				<div class="card-body">
					<div class ="alert alert-success" style="display:none"></div>
					{!! Form::open(['method' => 'put', 'id' => 'CreateNewShoppingForm']) !!}
						<div class="bg-light">
							<div class="form-group">
								{!! Form::label('name_material', 'Name', ['class' => 'lead']) !!}
								{!! Form::text('name_material', null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('desc_material', 'Description of the material', ['class' => 'lead']) !!}
								{!! Form::text('desc_material', null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('cost_shopping', 'Price', ['class' => 'lead']) !!}
								{!! Form::number('cost_shopping', null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('quantity_shopping', 'Quantity', ['class' => 'lead']) !!}
								{!! Form::number('quantity_shopping', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group row text-center">
							<div class="col">
								<button type="submit" class="btn btn-primary" id="AddNewShoppingSubmit"><i class='fa fa-plus-square'></i>Add</button>
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
		$('#AddNewShoppingSubmit').click(function(e){
			e.preventDefault();
			$.ajaxSetup({
				headers:{
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: "{{ route('shopping.store')}}",
				method: 'post',
				data: {
					name_material: $('#name_material').val(),
					desc_material: $('#desc_material').val(),
					price_material: $('#price_material').val(),
					quantity_shopping: $('#quantity_shopping').val()
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
