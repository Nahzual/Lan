@extends('layouts.dashboard')

@section('content')

<div class="card ">
	<div class="card-header">
			<div class="row">
				<div class="col mt-2">
					<h3 >List of available LANs</h3>
				</div>
				</div>
			</div>

        <div class="card-body">
          {!! Form::open(['method' => 'post','onsubmit'=>'sendRequest(event)']) !!}

              <?php if(Auth::check()){ ?>
              <h4>I want to see LANs from :</h4>
             
		 <div class="form-group">
		        {!! Form::label('location', 'Everywhere', ['for'=>'everywhere']) !!}
		        {!! Form::radio('location', 'everywhere', (isset($location) && $location=='everywhere') ? true : false) !!}

		        {!! Form::label('location', 'My country', ['for'=>'country']) !!}
		        {!! Form::radio('location', 'country', (isset($location) && $location=='country') ? true : false) !!}

		        {!! Form::label('location', 'My region', ['for'=>'department']) !!}
		        {!! Form::radio('location', 'department', (isset($location) && $location=='department') ? true : false) !!}

		        {!! Form::label('location', 'My city', ['for'=>'city']) !!}
		        {!! Form::radio('location', 'city', (isset($location) && $location=='city') ? true : false) !!}
              	</div>
            <?php } ?>
              <h4>I want to see LANS available between ... </h4>
              <div class="form-group">
                {!! Form::date('date1', (isset($date1)) ? $date1 : null, ['class' => 'form-control']) !!}
                <h4 class="mt-2"> and </h4>
                {!! Form::date('date2', (isset($date2)) ? $date2 : null, ['class' => 'form-control']) !!}
              </div>
            
            <div class="form-group row text-center">
              <div class="col esp">
                <button type="submit" class="btn  btn-outline-dark shadow-sm"><i class='fa fa-search'></i> Rechercher</button>
              </div>
            </div>
          {!! Form::close() !!}


  <div id="lanList">
	 @include('lan.all_lans_list',$lans)
  </div>
</div>
</div>
@endsection

@section('js_includes')
<script src="/js/ajax/lan/ajax_all_lans_list.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
