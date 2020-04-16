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
						<div class="col mt-1">
							<form method="GET" action="{{ route('lan.create') }}">
							@csrf
							@method('GET')
								<button type="submit" class="btn btn-primary float-right"><i class='fa fa-plus-square'></i> Create New Lan</button>
							</form>
						</div>
					</div>
				</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
