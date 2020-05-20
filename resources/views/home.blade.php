@extends('layouts.app')

@section('content')

		<section id="jumbotron">
			<div class="jumbotron" >
				<div class="container">

					<h1 class="display-3 text-right">{{ __('messages.hometitle') }}</h1>
					@if($lan)
						<div id="homediscover" class="alert alert-dark text-center" role="alert">
							<span>{{ __('homestats', ['date' => date_format(date_create($lan->created_at), config("display.DATE_FORMAT")), 'reg' => $lan->real_user_count(), 'maxreg' => $lan->max_num_registrants]) }}
							
							The latest LAN was created on<?php $date = date_create($lan->created_at); ?> {{date_format($date, config("display.DATE_FORMAT"))}} with {{ $lan->real_user_count() }}/{{ $lan->max_num_registrants }} registrants !</span>
							<span>{{ __('messages.homejoin') }}</span>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>	
					@endif
				</div>

			</div>


		</section>

		<section id="features" style="background-color:#212529">

			<div class="container" style="background-color:white">
				<div class="row">
					<div class="col-md-6 text-center home_txt_block">
						<h2  class="title-bebas">{{ __('messages.home_p1t') }}</h2>
						<p>{{ __('messages.home_p1') }}</p>
					</div>
					<div class="col-md-6 home_img_block home_img_block_1">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 home_img_block home_img_block_2">
					</div>
					<div class="col-md-6 text-center home_txt_block">
						<h2 class="title-bebas">{{ __('messages.home_p2t') }}</h2>
						<p>{{ __('messages.home_p2') }}</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 text-center home_txt_block">
						<h2  class="title-bebas">{{ __('messages.home_p3t') }}</h2>
						<p>{{ __('messages.home_p3') }}</p>
					</div>
					<div class="col-md-6 home_img_block home_img_block_3">

					</div>
				</div>
			</div>

		</section>

</div>


@endsection

@section('js_includes')
<script src="/js/ajax/home/ajax_lan_list.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
