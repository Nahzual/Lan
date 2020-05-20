@extends('layouts.app')

@section('content')
<div class="container esp">
		<section id="jumbotron">
			<div class="jumbotron" >
				<div class="container">
					<h1 class="display-3">{{ __('messages.error_404') }}</h1>
					<p>{{ __('messages.error_404_message') }}</p>
				</div>
			</div>
		</section>
</div>
@endsection
