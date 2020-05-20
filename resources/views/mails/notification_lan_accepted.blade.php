@extends('mails.notification_layout')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<h1>LAN Creator</h1>
		</div>
		<div class="card-body">
			<p>{{ __('messages.your_lan') }} {!!$lan->name!!}<small>#{{$lan->id}}</small>{{ __('messages.accepted') }}</p>
		</div>
	</div>
</div>
@endsection
