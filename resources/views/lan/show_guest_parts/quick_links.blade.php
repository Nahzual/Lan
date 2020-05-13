				<div class="card">
					<div class="card-header">
						<div class="row">
							<h4 class="mt-2">Reminder</h4>
						</div>
					</div>
					<div class="card-body ">
					<div class="row justify-content-center">
						<p>LANs are managed by external Users</p>
						<p>Please, be careful and never leak your credentials</p>

						<p> (even to a "close" friend)</p>
						<p>If you desire, you can also create your own LAN !</p>

					</div>

					<div class="row justify-content-center">
			@if($time_left->invert || $time_left->days==0)
				<a class="btn btn-success disabled"> LAN closed</a>
			@else
				<a class="btn btn-success" href="{{ route('lan.participate', $lan->id) }}"><i class="fa fa-sign-in"></i> Join this LAN</a>
			@endif

													<form method="GET" action="{{ route('lan.create') }}">
										@csrf
										@method('GET')
										<button type="submit" class="btn  btn-outline-dark shadow-sm"><i class='fa fa-plus-square'></i> Create a LAN</button>
									</form>
					</div>
					</div>
				</div>
