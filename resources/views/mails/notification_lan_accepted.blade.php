@extends('mails.notification_layout')

@section('content')
				<h1>LAN Creator</h1>

				<p>Your LAN {{$lan->name}}<small>#{{$lan->id}}</small> has been accepted ! Players can now join it from the home page.</p>
@endsection
