@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
					<h3 class="lead-title">Viewing : {{$material->name_material}}</h3>
				</div>

				<div class="card-body">
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Name</label>
						<label class="form-control col-8">{{$material->name_material}}</label>
					</div>
					<div class="row">
						<label class="lead col-3 mt-1 text-center">Description of the material</label>
						<label class="form-control col-8">{{$material->desc_material}}</label>
					</div>
        </div>
			</div>
    </div>
  </div>
</div>
@endsection
