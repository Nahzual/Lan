					<div class="card">
						<div class="card-header" id="heading-shopping">
							<div class="row">
								<div class="col mt-2">
									<h4>Shopping</h4>
								</div>

								<div class="col">
									<button class="btn btn-outline-dark shadow-sm float-right ml-2" data-toggle="collapse" data-target="#lan_shopping" aria-expanded="false" aria-controls="lan_shopping">Show/hide</button>
									@if ($userIsLanAdminOrHelper)<a class="btn btn-success shadow-sm float-right ml-2" href="{{ route('shopping.create', $lan->id) }}"><i class='fa fa-plus'></i></a>@endif
									<a class="btn btn-outline-primary shadow-sm float-right" href="{{ route('lan.shopping_list', $lan->id) }}"><i class='fa fa-list'></i> All</a>
								</div>

							</div>
						</div>
						<div class="collapse" id="lan_shopping" aria-labelledby="heading-shopping">
							<div class="card-body">
								<div class="table-responsive">
									<table class="text-center table card-table table-bordered">
										<thead class="card-table text-center">
											<th scope="col" >#</th>
											<th scope="col" >Name</th>
											<th scope="col" >Cost</th>
											<th scope="col" >Quantity</th>
											<th scope="col" ></th>
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
													<th scope="row">{{$shopping->cost_shopping}} €</th>
													<th scope="row">{{$shopping->quantity_shopping}}</th>
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
									<table class="text-center table card-table table-bordered">
										<thead class="card-table text-center">
											<th scope="col" >Total Price</th>
											<th scope="col" >Budget</th>
											<th scope="col" >remaining money</th>
										</thead>
										<tbody>
											<tr id="row-shopping-lan-totalprice_shopping">
												<td scope="col" class=" text-center">
													<div class="btn-group">
														{!!$totalprice_shopping!!} €
													</div>
												</td>
												<td scope="col" class="text-center">
													<div class="btn-group text-success">
														{!!$lan->budget!!} €
													</div>
												</td>
												<td scope="col" class=" text-center">
													@if($lan->budget-$totalprice_shopping > 0)
														<div class="btn-group text-success">
															{!!$lan->budget-$totalprice_shopping!!} €
														</div>
													@else
														<div class="btn-group text-danger">
															{!!$lan->budget-$totalprice_shopping!!} €
														</div>
													@endif
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				@foreach($shoppings as $shopping)
				<div id="popup-shopping-{{$shopping->id}}" class="popup">
					<div class="popup-content">
						<span onclick="closeShopping({{$shopping->id}})" class="close">&times;</span>
						@include('shopping.show', array('shopping'=>$shopping,'material'=>$shopping->material))
					</div>
				</div>
				@endforeach
