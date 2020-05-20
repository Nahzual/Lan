@extends('layouts.app')

@section('content')
<div class="container esp">
		<section id="jumbotron">
			<div class="jumbotron" >
				<div class="container">
					<h1 class="display-3">{{ __('messages.error_500') }}</h1>
					<p>{{ __('messages.error_500_message') }}</p>
				</div>
			</div>
		</section>
</div>
@endsection
