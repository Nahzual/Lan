@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					<h3 class="lead-title">Creating new game</h3>
				</div>
				<div class="card-body">

					<div class ="alert alert-success" id="response-success" style="display:none"></div>
          <div class ="alert alert-danger" id="response-error" style="display:none"></div>


					{!! Form::open(['method' => 'put', 'id' => 'CreateNewGameForm']) !!}
						<div class="bg-light">
							<div class="form-group">
								{!! Form::label('name_game', 'Name', ['class' => 'lead']) !!}
								{!! Form::text('name_game', null, ['class' => 'form-control']) !!}
							</div>
              <div class="form-group">
								{!! Form::label('desc_game', 'Description of the Game', ['class' => 'lead']) !!}
								{!! Form::textarea('desc_game', null, ['class' => 'form-control','size'=>'30x5']) !!}
							</div>
              <div class="form-group">
								{!! Form::label('release_date_game', 'Release Date', ['class' => 'lead']) !!}
								{!! Form::date('release_date_game', null, ['class' => 'form-control']) !!}
							</div>
              <div class="form-group">
								{!! Form::label('cost_game', 'Price (in €) ', ['class' => 'lead']) !!}
								{!! Form::number('cost_game', null, ['min'=>'0', 'class' => 'form-control']) !!}
							</div>
              <div class="form-group">
								{!! Form::label('is_multiplayer_game', 'Game Type : ', ['class' => 'lead']) !!}
								{!! Form::select('is_multiplayer_game', [config('game.SOLO') => '1 player', config('game.MULTI_LOCAL') => 'Local multiplayer', config('game.MULTI_ONL')=>'Online multiplayer'], null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group row text-center">
							<div class="col">
								<button type="submit" class="btn btn-primary" id="AddNewGameSubmit"><i class='fa fa-plus-square'></i>Add</button>
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
		$('#AddNewGameSubmit').click(function(e){
			e.preventDefault();
			$.ajaxSetup({
				headers:{
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: "{{ route('game.store')}}",
				method: 'post',
        dataType: 'json',
				data: {
					name_game: $('#name_game').val(),
					desc_game: $('#desc_game').val(),
					release_date_game: $('#release_date_game').val(),
					cost_game: $('#cost_game').val(),
					is_multiplayer_game: $('#is_multiplayer_game').val(),
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
