@extends('mails.notification_layout')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<h1>LAN Creator</h1>
		</div>
		<div class="card-body">
			<p>{{ __('messages.game_over') }}</p>
			<p>{{ __('messages.ban_mistake') }}</p>
		</div>
	</div>
</div>
@endsection
