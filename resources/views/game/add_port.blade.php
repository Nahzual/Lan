
      <div class="card">
        <div class="card-header">
					<div class="row">
						<div class="col mt-2">
							<h3>{{ __('messages.add_port_game', ['game' => $game->name_game, 'lan' => $lan->name]) }}</h3>
						</div>
					</div>
				</div>

        <div id="response-success-{{$game->id}}" class="alert alert-success mt-2" style="display:none"></div>
        <div id="response-error-{{$game->id}}" class="alert alert-danger mt-2" style="display:none"></div>

				<div class="card-body">
					<div>
		        <h4>{{ __('messages.port') }}</h4>
            <div class="form-group">
              {!! Form::number('port', null, ['id'=>'port-number-'.$game->id,'required'=>'', 'min'=>'1','class' => 'form-control']) !!}
						</div>
          </div>
          <div class="form-group row text-center">
            <div class="col">
							{!! Form::open(['method' => 'post','onsubmit'=>'addPort(event,'.$lan->id.','.$game->id.')']) !!}
              	<button type="submit" class="btn btn-outline-info shadow-sm"><i class='fa fa-plus-square'></i> {{ __('messages.add') }}</button>
							{!! Form::close() !!}
						</div>
          </div>

					<div class="form-group row text-center">
						<div class="col">
							{!! Form::open(['method' => 'post','onsubmit'=>'removePort(event,'.$lan->id.','.$game->id.')']) !!}
								<button type="submit" class="btn btn-warning shadow-sm"><i class='fa fa-minus-square'></i> {{ __('messages.remove') }}</button>
							{!! Form::close() !!}
						</div>
					</div>
      	</div>
  		</div>
