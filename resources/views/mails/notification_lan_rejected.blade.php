@extends('mails.notification_layout')

@section('content')
				<h1>LAN Creator</h1>

				<p>Your LAN {!!$lan->name!!}<small>#{{$lan->id}}</small> has been rejected, please edit its informations before submitting it again.</p>
@endsection
