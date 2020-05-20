@extends('mails.notification_layout')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<h1>LAN Creator</h1>
		</div>
		<div class="card-body">
			<p>{{ __('messages.added_as_admin') }} {!!$lan->name!!}<small>#{{$lan->id}}</small> 
			{{ __('messages.added_as_admin_by', ['name' => $admin->name, lastname => $admin->lastname ]) }}</p>
			<p>{{ __('messages.visit_dashboard') }}</p>
			<p>{{ __('messages.added_as_admin_mistake', ['email' => $admin->email]) }}</p>
		</div>
	</div>
</div>
@endsection
