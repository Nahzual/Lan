@extends('mails.notification_layout')

@section('content')
				<h1>LAN Creator</h1>

				<p>You are no longer registered to the LAN {!!$lan->name!!}<small>#{{$lan->id}}</small> because the place you choosed is no longer available.</p>

				<p>You will have to choose an other place, but you can still join this LAN on the home page if there are places left.</p>
@endsection
