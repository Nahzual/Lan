@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col mt-2">
							<h3 class="lead-title">Registering to Lan : {{$lan->name}}</h3>
						</div>
					</div>
				</div>

				<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
				<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

				<div class="card-body">
					{!! Form::model($lan, ['method' => 'post', 'onsubmit' => 'return addPlayer(event,'.$lan->id.')']) !!}
						<div class="bg-light">
							<div class="form-group">
								{!! Form::label('place_number', 'Place number', ['class' => 'lead']) !!}
								{!! Form::number('place_number', null, ['min'=>'1','max'=>$lan->max_num_registrants,'class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group row text-center">
							<div class="col">
								<button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Register</button>
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
<script src="/js/ajax/lan/ajax_participate.js"></script>
@endsection
