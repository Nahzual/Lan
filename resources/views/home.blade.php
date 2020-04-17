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

                <div class="card-header text-center">
					<div class="row lead">
						<div class="col">Name</div>
						<div class="col">Participants</div>
						<div class="col">Date</div>
					</div>
				</div>

                <div class="card-body text-center">
						@foreach($lans as $lan)
							<div class="row">
								<div class="col mt-2 lead-text">{{$lan->name}}</div>
								<div class="col mt-2 lead-text">1/{{$lan->max_num_registrants}}</div>
								<div class="col mt-2 lead-text">{{$lan->opening_date}}</div>

								<div class="col">
									<a class="btn btn-success" href="{{ route('lan.show', $lan->id) }}"><i class='fa fa-eye'></i> View</a>
								</div>
							</div>
							<br>
						@endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
