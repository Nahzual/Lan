@extends('mails.notification_layout')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<h1>LAN Creator</h1>
		</div>
		<div class="card-body">
			<p>Your LAN {!!$lan->name!!}<small>#{{$lan->id}}</small> has been rejected, please edit its informations before submitting it again.</p>
		</div>
	</div>
</div>
@endsection
