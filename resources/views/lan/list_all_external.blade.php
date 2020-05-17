@extends('layouts.app')



@section('content')
<div class="container esp">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card besp">
        <div class="card-header bg-dark">
				<div class="row">
						<div class="col mt-2">
							<h3 class="text-light" >List of available LANs</h3>
						</div>
				</div>
	</div>
	<div class="card-body">
		<div class="bg-light">
			<div id="response-success" class ="alert alert-success" style="display:none"></div>
			{!! Form::open(['method' => 'post','onsubmit'=>'sendRequest(event)']) !!}
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
		</div>
	</div>
	</div>
	</div>
	</div>
	

<div id="lanList">
	@include('lan.all_lans_list_external',$lans)
</div>

	</div>

@endsection


@section('js_includes')
<script src="/js/ajax/lan/ajax_all_lans_list_external.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
