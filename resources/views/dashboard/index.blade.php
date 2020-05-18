@extends('layouts.dashboard')

@section('title')
Dashboard
@endsection

@section('page-title')
Dashboard
@endsection

@section('title-buttons')

@endsection

@section('content')

<div class="container esp besp">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col mt-2">
							<h3>{{ __('messages.my_lans') }}</h3>
						</div>
						<div class="col mt-1">
							<form method="GET" action="{{ route('lan.create') }}">
								@csrf
								@method('GET')
								<button type="submit" class="btn  btn-outline-dark shadow-sm float-right"><i class='fa fa-plus-square'></i>{{ __('messages.create_new_lan') }}</button>
							</form>
						</div>
						<div class="col mt-1">
							<button class="btn btn-outline-dark shadow-sm float-right" data-toggle="collapse" data-target="#my_lans" aria-expanded="false" aria-controls="my_lans">{{ __('messages.show_hide') }}</button>
						</div>
					</div>
				</div>
			</div>
			<div class="table-responsive collapse" id="my_lans">
				<table class="table card-table table-bordered">
					<thead class="card-table text-center">
						<th scope="col" >#</th>
						<th scope="col">{{ __('messages.name') }}</th>
						<th scope="col">{{ __('messages.participants') }}</th>
						<th scope="col">{{ __('messages.state') }}</th>
						<th scope="col">{{ __('messages.view') }}</th>
						<th scope="col">{{ __('messages.edit') }}</th>
						<th scope="col">{{ __('messages.delete') }}</th>
					</thead>

					<tbody>
						@each('lan.my_lans',$admin_lans,'lan')
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Admin LANs -->
<div id="response-success-delete" class="container alert alert-success mt-2" style="display:none"></div>
<div id="response-error-delete" class="container alert alert-danger mt-2" style="display:none"></div>

<!-- Helper LANs -->
<div class="container esp besp">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card ">
				<div class="card-header">
					<div class="row">
						<div class="col mt-2">
							<h3>{{ __('messages.my_lans_helper') }}</h3>
						</div>
						<div class="col mt-1">
							<button class="btn btn-outline-dark shadow-sm float-right" data-toggle="collapse" data-target="#helper_lans" aria-expanded="false" aria-controls="helper_lans">{{ __('messages.show_hide') }}</button>
						</div>
					</div>
				</div>
			</div>

			<div class="table-responsive collapse" id="helper_lans">
				<table class="table card-table table-bordered">
					<thead class="card-table text-center">
						<th scope="col">#</th>
						<th scope="col">{{ __('messages.name') }}</th>
						<th scope="col">{{ __('messages.participants') }}</th>
						<th scope="col">{{ __('messages.state') }}</th>
						<th scope="col">{{ __('messages.view') }}</th>
					</thead>

					<tbody>
						@each('lan.helper_lans',$helper_lans,'lan')
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Player LANs -->

<div id="response-success-player" class="container alert alert-success mt-2" style="display:none"></div>
<div id="response-error-player" class="container alert alert-danger mt-2" style="display:none"></div>

<div class="container esp besp">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col mt-2">
							<h3>{{ __('messages.my_lans_player') }}</h3>
						</div>
						<div class="col mt-1">
							<button class="btn btn-outline-dark shadow-sm float-right" data-toggle="collapse" data-target="#player_lans" aria-expanded="false" aria-controls="player_lans">{{ __('messages.show_hide') }}</button>
						</div>
					</div>
				</div>
			</div>

			<div class="table-responsive collapse" id="player_lans">
				<table class="text-center table card-table table-bordered">
					<thead class="card-table text-center">
						<th scope="col" >#</th>
						<th scope="col">{{ __('messages.name') }}</th>
						<th scope="col">{{ __('messages.participants') }}</th>
						<th scope="col">{{ __('messages.view') }}</th>
						<th scope="col">{{ __('messages.quit') }}</th>
					</thead>

					<tbody>
						@each('lan.player_lans',$player_lans,'lan')
					</tbody>
				</table>
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
