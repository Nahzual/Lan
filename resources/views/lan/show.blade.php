@extends('layouts.app')

@section('content')
<?php $date = date_create($lan->opening_date); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					         <h3 class="lead-title">Viewing : {{$lan->name}}</h3>
				        </div>

                <div id="response-success-delete" class="container alert alert-success mt-2" style="display:none"></div>
                <div id="response-error-delete" class="container alert alert-danger mt-2" style="display:none"></div>

        				<div class="card-body">
        					<div class="row d-flex justify-content-center">
                    <label class="col-md-2 col-form-label text-md-right">Max number of players</label>
        						<label class="form-control col-8 h-100">{{$lan->max_num_registrants}}</label>
        					</div>
        					<div class="row d-flex justify-content-center">
                    <label class="col-md-2 col-form-label text-md-right">Opening date</label>
        						<label class="form-control col-8 h-100">{{date_format($date, config("display.DATE_FORMAT"))}}</label>
        					</div>
        					<div class="row d-flex justify-content-center">
                    <label class="col-md-2 col-form-label text-md-right">Duration</label>
        						<label class="form-control col-8 h-100">{{$lan->duration}} days</label>
        					</div>
        					<div class="row d-flex justify-content-center">
                    <label class="col-md-2 col-form-label text-md-right">Budget</label>
        						<label class="form-control col-8 h-100">{{$lan->budget}} €</label>
        					</div>
                  <div class="row d-flex justify-content-center">
                    <label class="col-md-2 col-form-label text-md-right">Room dimensions</label>
                    <label class="form-control col-8 h-100">{{$lan->room_width}}*{{$lan->room_length}} m</label>
                  </div>
        					<div class="row d-flex justify-content-center">
                    <label class="col-md-2 col-form-label text-md-right">Location</label>
        						<label class="form-control col-8 h-100">{{$location->num_street.' '.$street->name_street.' '.$city->zip_city.' '.$city->name_city.', '.$department->name_department.', '.$country->name_country}}</label>
        					</div>
        					<div class="form-group row text-center">
        						<div class="col">
        							<a class="btn btn-primary" href="{{ route('lan.edit', $lan->id) }}"><i class='fa fa-edit'></i> Edit</a>
        						</div>
                    @if ($userIsLanAdmin)
                      {{ Form::open([ 'method'  => 'delete', 'url'=>'', 'onsubmit'=>'return deleteLan(event,'.$lan->id.')' ]) }}
                        {{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Delete', ['class' => 'btn btn-danger', 'type' => 'submit']) }}
                      {{ Form::close() }}
                    @endif
        						<div class="col">
        								<a class="btn btn-primary" href="{{ route('lan.index') }}"><i class='fa fa-arrow-left'></i> To Lan List</a>
        						</div>
        				</div>
            </div>
			    </div>
      </div>
    </div>


    <div class="mt-5 row justify-content-center">
      <div id="response-success-game" class="container alert alert-success mt-2" style="display:none"></div>
      <div id="response-error-game" class="container alert alert-danger mt-2" style="display:none"></div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col mt-2">
                <h3 class="lead-title">Games</h3>
              </div>
              @if ($userIsLanAdmin)
              <div class="col">
                <a class="btn btn-primary float-right" href="{{ route('lan.add_game', $lan->id) }}"><i class='fa fa-plus'></i> Add games</a>
              </div>
              @endif
            </div>
          </div>
        </div>
        @include('game.list_lan')
      </div>
    </div>


@if ($userIsLanAdmin)

  <div class="my-5 row justify-content-center">
      <div class="col-md-8">
        <hr class="dark-hr"/>
        <h3 class="text-center">Admin section</h3>
        <hr class="dark-hr"/>
      </div>
    </div>

  <div class="mb-5 row justify-content-center">
    <div id="response-success-admin" class="container alert alert-success mt-2" style="display:none"></div>
    <div id="response-error-admin" class="container alert alert-danger mt-2" style="display:none"></div>
    <div class="col-md-8">
      @include('user.admin.show_remove')
    </div>
  </div>


  <div class="mb-5 row justify-content-center">
    <div id="response-success-helper" class="container alert alert-success mt-2" style="display:none"></div>
    <div id="response-error-helper" class="container alert alert-danger mt-2" style="display:none"></div>
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
<script src="/js/ajax/lan/ajax_delete.js"></script>
<script src="/js/ajax/lan/ajax_remove_game.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
