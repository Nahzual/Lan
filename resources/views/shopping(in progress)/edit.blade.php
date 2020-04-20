@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					<div class="row">
						<div class="col mt-2">
							<h3 class="lead-title">Editing Material : {{$material->name_material}}</h3>
						</div>
					</div>
				</div>
				<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
				<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>
				<div class="card-body">
					{!! Form::model($material, ['method' => 'put', 'onsubmit' => 'return sendRequest(event,'.$material->id.')']) !!}
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
								{!! Form::label('price_material', 'Price', ['class' => 'lead']) !!}
								{!! Form::text('price_material', null, ['class' => 'form-control']) !!}
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
