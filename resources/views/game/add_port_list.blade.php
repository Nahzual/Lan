
      <div class="card">
        <div class="card-header">
					<div class="row">
						<div class="col mt-2">
							<h3>Adding port to game "{!!$game->name_game!!}"</h3>
						</div>
					</div>
				</div>

        <div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
        <div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

				<div class="card-body">
					<div>
		        <h4>Port :</h4>
            <div class="form-group">
              {!! Form::number('port', null, ['required'=>'', 'min'=>'1','class' => 'form-control']) !!}
						</div>
          </div>
          <div class="form-group row text-center">
            <div class="col">
							{!! Form::open(['method' => 'post','onsubmit'=>'addPort(event,'.$id.','.$game->id.')']) !!}
              	<button type="submit" class="btn btn-outline-info shadow-sm"><i class='fa fa-plus-square'></i> Add</button>
							{!! Form::close() !!}
						</div>
          </div>

					<div class="form-group row text-center">
						<div class="col">
							{!! Form::open(['method' => 'post','onsubmit'=>'removePort(event,'.$id.','.$game->id.')']) !!}
								<button type="submit" class="btn btn-warning shadow-sm"><i class='fa fa-minus-square'></i> Remove</button>
							{!! Form::close() !!}
						</div>
					</div>
      	</div>
  		</div>
