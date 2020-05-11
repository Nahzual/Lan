@extends('layouts.app')

@section('content')
	
		
		<section id="jumbotron">
			<div class="jumbotron" >
				<div class="container">
					<h1 class="display-3 text-right">Create your LAN now !</h1>
					todopage : remplacer img et le noir
				</div>
			</div>
		</section>

		
		<section id="features" style="background-color:black">

			<div class="container" style="background-color:white">
				<div class="row">
					<div class="col-md-6 text-center home_txt_block">
						<h2  class="title-bebas">Select your Games</h2>
						<p>Link your Games to your LAN, review the connexion ports and choose your must-haves with our "fav" system ! You might even find some new ones... </p>
					</div>
					<div class="col-md-6 home_img_block home_img_block_1">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 home_img_block home_img_block_2">
					</div>
					<div class="col-md-6 text-center home_txt_block">
						<h2 class="title-bebas">Host unique Activities</h2>
						<p>Create heavily-customised tournaments, define what your own LAN is and more ! With our room mapping application, you also can see how everyone can fit !</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 text-center home_txt_block">
						<h2  class="title-bebas">Organization is key</h2>
						<p>Don't do it alone ! Add helpers, news admins, deploy tasks, define a shopping list and a to-do list to avoid some last-minute expenses !</p>
					</div>
					<div class="col-md-6 home_img_block home_img_block_3">
						
					</div>
				</div>
			</div>

		</section>
		@if($lan)
		<section id="discover" >
			<div class="jumbotron home_div" >
				<div class="container">
					
					<p>The latest LAN was created on<?php $date = date_create($lan->opening_date); ?> {{date_format($date, config("display.DATE_FORMAT"))}} with {{ $lan->real_user_count() }}/{{ $lan->max_num_registrants }} registrants !</p>
					<p>Sign-in now to create your first LAN !</p>
					
				</div>
			</div>
		</section>
		@endif
</div>

	
@endsection

@section('js_includes')
<script src="/js/ajax/home/ajax_lan_list.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
