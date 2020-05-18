@extends('mails.notification_layout')

@section('content')
	<div class="card">
		<div class="card-header">
			<p>From : {!!$name!!} {!!$lastname!!}</p>
		</div>
		<div class="card-body">
			<p>{!!$content!!}</p>
		</div>
	</div>
@endsection
