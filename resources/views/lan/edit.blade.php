@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					        <div class="row">
						              <div class="col mt-2">
							                  <h3 class="lead-title">Editing Lan : {{$lan->name}}</h3>
						              </div>
					             </div>
				       </div>

              <div class="card-body">
                {!! Form::model($lan, ['method' => 'put', 'onsubmit' => 'return sendRequest(event,'.$lan->id.')']) !!}
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
      								{!! Form::date('opening_date', null, ['class' => 'form-control']) !!}
      							</div>
      							<div class="form-group">
      								{!! Form::label('duration', 'Duration', ['class' => 'lead']) !!}
      								{!! Form::text('duration', null, ['class' => 'form-control']) !!}
      							</div>
      							<div class="form-group">
      								{!! Form::label('budget', 'Budget', ['class' => 'lead']) !!}
      								{!! Form::text('budget', null, ['class' => 'form-control']) !!}
      							</div>
                    <div class="form-group">
      								{!! Form::label('room_length', 'Room length', ['class' => 'lead']) !!}
      								{!! Form::text('room_length', null, ['class' => 'form-control']) !!}
      							</div>
                    <div class="form-group">
      								{!! Form::label('room_width', 'Room width', ['class' => 'lead']) !!}
      								{!! Form::text('room_width', null, ['class' => 'form-control']) !!}
      							</div>
      						</div>
                  <div class="bg-light">
                    {!! Form::label('location', 'Location', ['class' => 'lead']) !!}
      							<div id="location" class="input-group mb-1">
      								{!! Form::number('num_street', $location->num_street, ['id'=>'num_street','min'=>'0', 'placeholder'=>'Street number','class' => 'form-control']) !!}
                      <span class="input-group-addon mr-2"></span>
      								{!! Form::text('name_street', $street->name_street, ['id'=>'name_street','placeholder'=>'Street Name', 'class' => 'form-control']) !!}
                      <span class="input-group-addon mr-2"></span>
                      {!! Form::text('name_city', $city->name_city, ['id'=>'name_city','placeholder'=>'City','class' => 'form-control']) !!}
      							</div>
                    <div class="input-group mb-5">
                      {!! Form::text('zip_city', $city->zip_city, ['id'=>'zip_city','placeholder'=>'ZIP Code','class' => 'form-control']) !!}
                      <span class="input-group-addon mr-2"></span>
                      {!! Form::text('name_department', $department->name_department, ['id'=>'name_department','placeholder'=>'Region Name','class' => 'form-control']) !!}
                      <span class="input-group-addon mr-2"></span>
                      {!! Form::text('name_country', $country->name_country, ['id'=>'name_country','placeholder'=>'Country Name', 'class' => 'form-control']) !!}
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

                <div id="response-success" class="container alert alert-success mt-2" style="display:none"></div>
                <div id="response-error" class="container alert alert-danger mt-2" style="display:none"></div>

              </div>
            </div>
          </div>
    </div>
</div>
@endsection

@section('js_includes')
<script src="/js/ajax/lan/ajax_edit.js"></script>
@endsection
