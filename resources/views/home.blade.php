@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					<div class="row">
						<div class="col mt-2">
							<h3 class="lead-title">List Lans</h3>
						</div>
					</div>
				</div>

        <div class="card-body">
          {!! Form::open(['method' => 'post','onsubmit'=>'sendRequest(event)']) !!}
            <div class="bg-light">
              <?php if(Auth::check()){ ?>
              <h4 class='lead'>Display lans from :</h4>
              <div class="form-group">
                {!! Form::label('location', 'Everywhere', ['for'=>'everywhere']) !!}
                {!! Form::radio('location', 'everywhere', (isset($location) && $location=='everywhere') ? true : false) !!}

                {!! Form::label('location', 'Your country', ['for'=>'country']) !!}
                {!! Form::radio('location', 'country', (isset($location) && $location=='country') ? true : false) !!}

                {!! Form::label('location', 'Your region', ['for'=>'department']) !!}
                {!! Form::radio('location', 'department', (isset($location) && $location=='department') ? true : false) !!}

                {!! Form::label('location', 'Your city', ['for'=>'city']) !!}
                {!! Form::radio('location', 'city', (isset($location) && $location=='city') ? true : false) !!}
              </div>
            <?php } ?>
              <h4 class='lead'>Display lans where opening date is between :</h4>
              <div class="form-group">
                {!! Form::date('date1', (isset($date1)) ? $date1 : null, ['class' => 'form-control']) !!}
                <h4 class="mt-2"> and </h4>
                {!! Form::date('date2', (isset($date2)) ? $date2 : null, ['class' => 'form-control']) !!}
              </div>
            </div>
            <div class="form-group row text-center">
              <div class="col">
                <button type="submit" class="btn btn-primary"><i class='fa fa-search'></i> Rechercher</button>
              </div>
            </div>
          {!! Form::close() !!}
        </div>

        <div id="lanList">
          @include('home_list_lans',$lans)
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js_includes')
<script src="/js/ajax/home/ajax_lan_list.js"></script>
@endsection
