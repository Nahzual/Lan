@extends('mails.notification_layout')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<h1>LAN Creator</h1>
		</div>
		<div class="card-body">
			<p>{!! $from->name !!} {{ $from->lastname }} ({!!$from->pseudo!!}) tried to contact you using our website. If you want, you can reply at : {{$from->email}}</p>

			<p>If you think this is a mistake, you can ignore this message.</p>
			<p>If you feel like this user is spamming you, or causing you any type of trouble, you can contact a site administrator using the "Contact" page. Feel free to include screenshots, or any other file that can make us better understand your issue.</p>
		</div>
	</div>
</div>
@endsection
