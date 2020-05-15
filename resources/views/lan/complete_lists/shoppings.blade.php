@extends('layouts.dashboard')

@section('title')
The Shopping List for the LAN {{ $lan->name }}
@endsection

@section('page-title')
LAN's shopping
@endsection

@section('title-buttons')

<div class="col-2 mt-1">
	<form method="GET" action="{{ route('shopping.create', $lan->id) }}">
		@csrf
		@method('GET')
		<button type="submit" class="btn btn-outline-success float-right"><i class='fa fa-plus-square'></i> To buy</button>
	</form>
</div>

<div class="col mt-1">
	<table class="text-center table card-table table-bordered">
		<thead class="card-table text-center">
			<th scope="col" >Total Price</th>
			<th scope="col" >Budget</th>
			<th scope="col" >Remaining money</th>
		</thead>
		<tbody>
			<tr>
				<td scope="col" class=" text-center">
					<div class="btn-group" id="lan-totalprice_shopping">
						{!!$totalprice_shopping!!} €
					</div>
				</td>
				<td scope="col" class="text-center">
					<div class="btn-group text-success" id="lan-budget">
						{!!$lan->budget!!} €
					</div>
				</td>
				<td scope="col" class=" text-center">
					@if($lan->budget-$totalprice_shopping > 0)
						<div class="btn-group text-success" id="lan-shopping-remaining-money">
							{!!$lan->budget-$totalprice_shopping!!} €
						</div>
					@else
						<div class="btn-group text-danger" id="lan-shopping-remaining-money">
							{!!$lan->budget-$totalprice_shopping!!} €
						</div>
					@endif
				</td>
			</tr>
		</tbody>
	</table>
</div>
@endsection

@section('content')

<div id="response-success-shopping" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error-shopping" class="alert alert-danger mt-2" style="display:none"></div>

<div class="table-responsive">
	<table class="text-center table card-table table-bordered">
		<thead class="card-table text-center">
			<th scope="col" >#</th>
			<th scope="col" >Name</th>
			<th scope="col" >Cost</th>
			<th scope="col" >Quantity</th>
			<th scope="col"></th>
		</thead>

		<tbody>
			@if(count($shoppings)==0)
			<tr>
				<td colspan="5"><h3 class="text-center">No shoppings to show</h3></td>
			</tr>
			@endif
			@foreach($shoppings as $shopping)
			<tr id="row-shopping-lan-{{$shopping->id}}">
				<th scope="row">{{$shopping->id}}</th>
				<td scope="col">{{$shopping->material->name_material}}</td>
				<th scope="row" id="row-shopping-cost-{{$shopping->id}}">{{$shopping->cost_shopping}} €</th>
				<th scope="row" id="row-shopping-quantity-{{$shopping->id}}">{{$shopping->quantity_shopping}}</th>
				<td scope="col" class=" text-center">
					<div class="btn-group">
						{!! Form::open(['onsubmit'=>'return false;']) !!}
						<button class="btn btn-success mr-2" id="shopping-view-{{$shopping->id}}" onclick="openShopping({{$shopping->id}})"><i class='fa fa-eye'></i> View</button>
						{{ Form::close() }}
						{!! Form::open(['method'=>'get','url'=>route('shopping.edit', array('lan' => $lan->id, 'shopping' => $shopping->id))]) !!}
						<button class="btn btn-warning mr-2"><i class='fa fa-edit'></i> Edit</button>
						{{ Form::close() }}
						{!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeShopping(event, '.$lan->id.', '.$shopping->id.')']) !!}
						<button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> Delete</button>
						{!! Form::close() !!}
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<nav aria-label="page navigation">
	<ul class="pagination justify-content-end">
		<li class="page-item">
			<a class="btn btn-info" href="{{ url('/lan/'.$lan->id) }}" tabindex="-2">Return to the LAN</a>
		</li>

		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/lan/'.$lan->id.'/shoppings/') }}" tabindex="-2">First</a>
		</li>
		<li class="page-item @if($previous == 0) disabled @endif">
			<a class="btn btn-outline-info" href="{{ $previous!=0 ?  url('/lan/'.$lan->id.'/shoppings/'.($previous)) : '#' }}" tabindex="-1">Back</a>
		</li>
		<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$lan->id.'/shoppings/'.($page)) }}">{{ $page }}</a></li>
		@if(($page+1)<=$max) <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$lan->id.'/shoppings/'.($page+1)) }}">{{ ($page+1) }}</a></li>@endif
		@if(($page+2)<=$max)<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$lan->id.'/shoppings/'.($page+2)) }}">{{ ($page+2) }}</a></li>@endif
		<li class="page-item @if($next) @else disabled @endif">
			<a class="btn btn-outline-info" href="{{ $next ? url('/lan/'.$lan->id.'/shoppings/'.($next)) : '#' }}">Next</a>
		</li>
		<li class="page-item">
			<a class="btn btn-secondary" href="{{ url('/lan/'.$lan->id.'/shoppings/'.$max) }}">Last</a>
		</li>
	</ul>
</nav>

@foreach($shoppings as $shopping)
<div id="popup-shopping-{{$shopping->id}}" class="popup">
	<div class="popup-content">
		<span onclick="closeShopping({{$shopping->id}})" class="close">&times;</span>
		@include('shopping.show', array('shopping'=>$shopping,'material'=>$shopping->material))
	</div>
</div>
@endforeach

@endsection

@section('js_includes')
<script src="/js/ajax/shopping/ajax_delete.js"></script>
<script src="/js/windows/shopping/display_window.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/game/game.css') }}" rel="stylesheet">
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
<link href="{{ asset('css/popup.css') }}" rel="stylesheet">
@endsection
