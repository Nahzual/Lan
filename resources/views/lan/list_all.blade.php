@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col mt-2">
							<h3 class="lead-title">List of available LANs</h3>
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
      </div>
    </div>
  </div>
  <div id="lanList">
   <div class="table-responsive">
	<table class="table card-table table-bordered">
		<thead class="text-center">
			<th scope="col" class="lead">#</th>
			<th scope="col" class="lead ">Name</th>
			<th scope="col" class="lead">Participants</th>
			<th scope="col" class="lead ">Date</th>
			<th scope="col" class="lead "></th>
			<th scope="col" class="lead "></th>
		</thead>

		<tbody>
			<tr>
				@foreach($lans as $lan)
				<?php $date = date_create($lan->opening_date); ?>
				<th class="lead-text text-center">{{$lan->id}}</th>
				<td class="lead-text text-center">{{$lan->name}}</td>
				<td class="lead-text text-center">{{ $lan->real_user_count() }}/{{ $lan->max_num_registrants }}</td>
				<td class="lead-text text-center">{{date_format($date, config("display.DATE_FORMAT"))}}</td>

				<td class="text-center">
					<a class="btn btn-success" href="{{ route('lan.show', $lan->id) }}"><i class='fa fa-eye'></i> View</a>
				</td>
				<td class="text-center">
					<a class="btn btn-success" href="{{ route('lan.participate', $lan->id) }}"><i class="fa fa-sign-in"></i> Participate</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
  </div>
</div>
@endsection

@section('js_includes')
<script src="/js/ajax/home/ajax_lan_list.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
