@extends('mails.notification_layout')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<h1>LAN Creator</h1>
		</div>
		<div class="card-body">
			<p>{{ __('messages.tried_contact', ['name'=>$from->name,'lastname'=>$from->lastname, 'pseudo'=>$from->pseudo, 'email'=>$from->email]) }}</p>
			<p>{{ __('messages.tried_contact_mistake') }}</p>
			<p>{{ __('messages.tried_contact_spam') }}</p>
		</div>
	</div>
</div>
@endsection
