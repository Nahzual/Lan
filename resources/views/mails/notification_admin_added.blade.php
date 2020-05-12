@extends('mails.notification_layout')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<h1>LAN Creator</h1>
		</div>
		<div class="card-body">
			<p>You have been added as admin on {!!$lan->name!!}<small>#{{$lan->id}}</small> by {!!$admin->name.' '.$admin->lastname!!}. Your can now edit and delete this LAN, and add admins and helpers to it.</p>
			<p>Visit your dashboard or LAN list to see everything you can do.</p>
			<p>If you think this might be a mistake, you can contact the LAN admin who added you on {{$admin->email}}.</p>
		</div>
	</div>
</div>
@endsection
