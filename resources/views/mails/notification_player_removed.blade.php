@extends('mails.notification_layout')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<h1>LAN Creator</h1>
		</div>
		<div class="card-body">
			<p>{{ __('messages.player_removed_retry') }} {!!$lan->name!!}<small>#{{$lan->id}}</small> 
			{{ __('messages.player_removed_p2') }}</p>
			<p>{{ __('messages.player_removed_retry') }}</p>
		</div>
	</div>
</div>	
@endsection
