@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					         <h3 class="lead-title">Viewing : {{$lan->name}}</h3>
				        </div>
        				<div class="card-body">
        					<div class="row">
        						<label class="lead col-3 mt-1 text-center">Name</label>
        						<label class="form-control col-8">{{$lan->name}}</label>
        					</div>
        					<div class="row">
        						<label class="lead col-3 mt-1 text-center">Maximum numbers of registrants</label>
        						<label class="form-control col-8">{{$lan->max_num_registrants}}</label>
        					</div>
        					<div class="row">
        						<label class="lead col-3 mt-1 text-center">Date</label>
        						<label class="form-control col-8">{{$lan->opening_date}}</label>
        					</div>
        					<div class="row">
        						<label class="lead col-3 mt-1 text-center">Duration</label>
        						<label class="form-control col-8">{{$lan->duration}}</label>
        					</div>
        					<div class="row">
        						<label class="lead col-3 mt-1 text-center">Budget</label>
        						<label class="form-control col-8">{{$lan->budget}} €</label>
        					</div>
                  <div class="row">
                    <label class="lead col-3 mt-1 text-center">Room width</label>
                    <label class="form-control col-8">{{$lan->room_width}} m</label>
                  </div>
                  <div class="row">
                    <label class="lead col-3 mt-1 text-center">Room length</label>
                    <label class="form-control col-8">{{$lan->room_length}} m</label>
                  </div>
        					<div class="row">
        						<label class="lead col-3 mt-1 text-center">Location</label>
        						<label class="form-control col-8">{{$location->num_street.' '.$street->name_street.' '.$city->zip_city.' '.$city->name_city.', '.$department->name_department.', '.$country->name_country}}</label>
        					</div>
        					<div class="form-group row text-center">
        						<div class="col">
        							<a class="btn btn-primary" href="{{ route('lan.edit', $lan->id) }}"><i class='fa fa-edit'></i> Edit</a>
        						</div>
        						<div class="col">
        								<a class="btn btn-primary" href="{{ route('lan.index') }}"><i class='fa fa-arrow-left'></i> Go back to Lan List</a>
        						</div>
        				</div>
            </div>
			    </div>
      </div>
    </div>


@if ($userIsLanAdmin)
<div id="response-success-admin" class="container alert alert-success mt-2" style="display:none"></div>
<div id="response-error-admin" class="container alert alert-danger mt-2" style="display:none"></div>

  <div class="mt-2 row justify-content-center">
    <div class="col-md-8">
      @include('user.admin.show_remove')
    </div>
  </div>

  <div id="response-success-helper" class="container alert alert-success mt-2" style="display:none"></div>
  <div id="response-error-helper" class="container alert alert-danger mt-2" style="display:none"></div>

  <div class="mt-2 row justify-content-center">
    <div class="col-md-8">
      @include('user.helper.show_remove')
    </div>
  </div>
@endif

</div>
@endsection

@section('js_includes')
<script src="/js/ajax/lan/ajax_add_helper.js"></script>
<script src="/js/ajax/lan/ajax_add_admin.js"></script>
@endsection
