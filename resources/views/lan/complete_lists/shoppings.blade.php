@extends('layouts.dashboard')

@section('content')

      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col mt-2">
              <h3>The Shopping List for the LAN {{ $nlan }}</h3>
            </div>
         
		<div class="col mt-1">
              <form method="GET" action="{{ route('shopping.create', $id) }}">
              @csrf
              @method('GET')
                <button type="submit" class="btn btn-outline-success float-right"><i class='fa fa-plus-square'></i> To buy</button>
              </form>
            </div>
	 </div>
        </div>

        <div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
        <div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

        <div class="card-body">
          

								<div class="table-responsive">
									<table class="text-center table card-table table-bordered">
										<thead class="card-table text-center">
											<th scope="col" >#</th>
											<th scope="col" >Name</th>
											<th scope="col" >Cost</th>
											<th scope="col" >Quantity</th>
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
													<td scope="col">{{$shopping->materials()->first()->name_material}}</td>
													<th scope="row">{{$shopping->cost_shopping}} €</th>
													<th scope="row">{{$shopping->quantity_shopping}}</th>
													<td scope="col" class=" text-center">
														<div class="btn-group">
															{!! Form::open(['onsubmit'=>'return false;']) !!}
																<button class="btn btn-success mr-2" id="shopping-view-{{$shopping->id}}" onclick="openActivity({{$shopping->id}})"><i class='fa fa-eye'></i> View</button>
															{{ Form::close() }}
															{!! Form::open(['method'=>'get','url'=>route('shopping.edit', array('lan' => $id, 'shopping' => $shopping->id))]) !!}
																<button class="btn btn-warning mr-2"><i class='fa fa-edit'></i> Edit</button>
															{{ Form::close() }}
															{!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeShopping(event, '.$id.', '.$shopping->id.')']) !!}
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
		      <a class="btn btn-info" href="{{ url('/lan/'.$id) }}" tabindex="-2">Return to the LAN</a>

		    <li class="page-item">
		      <a class="btn btn-secondary" href="{{ url('/lan/'.$id.'/shoppings/') }}" tabindex="-2">First</a>
		    </li>
		    <li class="page-item @if($previous == 0) disabled @endif">
		      <a class="btn btn-outline-info" href="{{ $previous!=0 ?  url('/lan/'.$id.'/shoppings/'.($previous)) : '#' }}" tabindex="-1">Back</a>
		    </li>
		    <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/shoppings/'.($page)) }}">{{ $page }}</a></li>
		    @if(($page+1)<=$max) <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/shoppings/'.($page+1)) }}">{{ ($page+1) }}</a></li>@endif
		    @if(($page+2)<=$max)<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/shoppings/'.($page+2)) }}">{{ ($page+2) }}</a></li>@endif
		    <li class="page-item @if($next) @else disabled @endif">
		      <a class="btn btn-outline-info" href="{{ $next ? url('/lan/'.$id.'/shoppings/'.($next)) : '#' }}">Next</a>
		    </li>
		    <li class="page-item">
		      <a class="btn btn-secondary" href="{{ url('/lan/'.$id.'/shoppings/'.$max) }}">Last</a>
		    </li>
		  </ul>
</nav>

        </div>

      </div>
@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/game/ajax.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/game/game.css') }}" rel="stylesheet">
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
