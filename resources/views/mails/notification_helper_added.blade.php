@extends('mails.notification_layout')

@section('content')
				<h1>LAN Creator</h1>

				<p>You have been added as helper on {!!$lan->name!!}<small>#{{$lan->id}}</small> by {!!$admin->name.' '.$admin->lastname!!}. Your can now create tasks for this LAN and edit its shopping list.</p>
				<p>If you think this might be a mistake, you can contact the LAN admin on {{$admin->email}}.</p>
@endsection
