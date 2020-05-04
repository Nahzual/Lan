@extends('layouts.dashboard')

@section('content')

<div class="card">
	<div class="card-header">
		<h2>Dashboard</h2>
	</div>
	<div class="card-body">
		<div class="container col">
			<div class="row justify-content-center">
				<div class="col-xl-6">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col mt-2">
									<h3>My LANs</h3>
								</div>
								<div class="col mt-1">
									<form method="GET" action="{{ route('lan.create') }}">
										@csrf
										@method('GET')
										<button type="submit" class="btn  btn-outline-dark shadow-sm float-right"><i class='fa fa-plus-square'></i> Create New Lan</button>
									</form>
								</div>
							</div>
						</div>
					</div>
							<div class="table-responsive">
								<table class="table card-table table-bordered">
									<thead class="card-table text-center">
									<th scope="col" >#</th>
									<th scope="col" >Name</th>
									<th scope="col" >Participants</th>
									<th scope="col" >State</th>
									<th scope="col" >View</th>
									<th scope="col">Edit</th>
									<th scope="col">Delete</th>
									</thead>

									<tbody>
										@each('lan.my_lans',$admin_lans,'lan')
									</tbody>
								</table>
							</div>

				</div>
			</div>
		</div>
	</div>


@yield('admin_section')



<!-- Admin LANs -->
<div id="response-success-delete" class="container alert alert-success mt-2" style="display:none"></div>
<div id="response-error-delete" class="container alert alert-danger mt-2" style="display:none"></div>

<!-- Helper LANs -->
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col mt-2">
              <h3>LANs on which I am helper</h3>
            </div>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table card-table table-bordered">
          <thead class="card-table text-center">
            <th scope="col" >#</th>
            <th scope="col" >Name</th>
            <th scope="col" >Participants</th>
            <th scope="col">State</th>
            <th scope="col">View</th>
          </thead>

          <tbody>
            @each('lan.helper_lans',$helper_lans,'lan')
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<br><br>

<!-- Player LANs -->

<div id="response-success-player" class="container alert alert-success mt-2" style="display:none"></div>
<div id="response-error-player" class="container alert alert-danger mt-2" style="display:none"></div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col mt-2">
              <h3>LANs on which I am player</h3>
            </div>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="text-center table card-table table-bordered">
          <thead class="card-table text-center">
            <th scope="col" >#</th>
            <th scope="col" >Name</th>
            <th scope="col" >Participants</th>
            <th scope="col" >View</th>
            <th scope="col">Quit</th>
          </thead>

          <tbody>
            @each('lan.player_lans',$player_lans,'lan')
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

@section('js_includes')
<script src="/js/ajax/lan/ajax_participate.js"></script>
<script src="/js/ajax/lan/ajax_delete.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
