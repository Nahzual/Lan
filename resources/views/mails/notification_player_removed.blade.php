@extends('mails.notification_layout')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<h1>LAN Creator</h1>
		</div>
		<div class="card-body">
			<p>You are no longer registered to the LAN {!!$lan->name!!}<small>#{{$lan->id}}</small> because the place you choosed is no longer available.</p>
			<p>You will have to choose an other place, but you can still join this LAN on the home page if there are places left.</p>
		</div>
	</div>
</div>	
@endsection
