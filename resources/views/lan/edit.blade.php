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

               <div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
               <div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

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
                    <div class="form-group">
                      {!! Form::label('num_street', 'Numero Street', ['class' => 'lead']) !!}
                      {!! Form::text('num_street', $location->num_street, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                      {!! Form::label('name_street', 'Name Street', ['class' => 'lead']) !!}
                      {!! Form::text('name_street', $street->name_street, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                      {!! Form::label('name_city', 'Name City', ['class' => 'lead']) !!}
                      {!! Form::text('name_city', $city->name_city, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                      {!! Form::label('zip_city', 'Zip', ['class' => 'lead']) !!}
                      {!! Form::text('zip_city', $city->zip_city, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                      {!! Form::label('name_department', 'Name Department', ['class' => 'lead']) !!}
                      {!! Form::text('name_department', $department->name_department, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                      {!! Form::label('name_country', 'Name Country', ['class' => 'lead']) !!}
                      {!! Form::text('name_country', $country->name_country, ['class' => 'form-control']) !!}
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
