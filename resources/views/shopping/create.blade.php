@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					<h3>{{$lan->name}} : Creating new Shopping</h3>
				</div>
				<div class="card-body">
					<div id="response-success" class ="alert alert-success" style="display:none"></div>
					<div id="response-error" class ="alert alert-danger" style="display:none"></div>

					{!! Form::open(['method' => 'put', 'onsubmit'=>'return sendRequest(event,'.$lan->id.')']) !!}
						<div class="form-group">
							{!! Form::label('cost_shopping', 'Price', ['class' => 'display-6']) !!}
							{!! Form::number('cost_shopping', null, ['step'=>'0.01','min'=>'0','class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('quantity_shopping', 'Quantity', ['class' => 'display-6']) !!}
							{!! Form::number('quantity_shopping', null, ['min'=>'0','class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('material_id', ' Choose Material', ['class' => 'display-6']) !!}
							{!! Form::select('material_id', $materials_array, null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group row text-center">
							<div class="col">
								<button type="submit" class="btn btn-outline-success shadow-sm"><i class='fa fa-plus-square'></i> Add</button>
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
<script type="text/javascript" src="/js/ajax/shopping/ajax_create.js" defer></script>
@endsection
