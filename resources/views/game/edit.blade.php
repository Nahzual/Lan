@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					<div class="row">
						<div class="col mt-2">
							<h3 class="lead-title">Editing Game : {{$game->name_game}}</h3>
						</div>
					</div>
				</div>
				<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
				<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>
				<div class="card-body">
					{!! Form::model($game, ['method' => 'put', 'onsubmit' => 'return sendRequest(event,'.$game->id.')']) !!}
						<div class="bg-light">
							<div class="form-group">
								{!! Form::label('name_game', 'Name', ['class' => 'lead']) !!}
								{!! Form::text('name_game', null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('desc_game', 'Description of the Game', ['class' => 'lead']) !!}
								{!! Form::text('desc_game', null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('release_date_game', 'Release Date', ['class' => 'lead']) !!}
								{!! Form::text('release_date_game', null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('cost_game', 'Price ', ['class' => 'lead']) !!}
								{!! Form::text('cost_game', null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('is_multiplayer_game', 'type de jeu', ['class' => 'lead']) !!}
								{!! Form::text('is_multiplayer_game', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group row text-center">
							<div class="col">
								<button type="submit" class="btn btn-primary"><i class='fa fa-edit'></i> Update</button>
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
@endsection

@section('js_includes')
<script src="/js/ajax/lan/ajax_edit.js"></script>
@endsection
