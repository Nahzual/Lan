@extends('layouts.dashboard')

@section('title')
User : {!!$user->pseudo!!}
@if($user->isSiteAdmin())
<i title="Site administrator" class="fa fa-check-circle-o text-success"></i>
@endif
@endsection

@section('page-title')
User page
@endsection

@section('title-buttons')
<div class="col">
	{!! Form::open(['onsubmit'=>'return sendRequest(event,'.$user->id.')']) !!}
		<button type="submit" class="btn btn-dark float-right"><i class="fa fa-send"></i> Contact</button>
	{!! Form::close() !!}
</div>
@endsection

@section('content')
<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

<div class="row d-flex justify-content-center">
	<label class="col-md-2 col-form-label text-md-right">{{ __('messages.name') }}</label>
	<label class="h-100 form-control col-8">{!!$user->lastname.' '.$user->name!!}</label>
</div>
<div class="row d-flex justify-content-center">
	<label class="col-md-2 col-form-label text-md-right">{{ __('messages.email') }}</label>
	<label class="h-100 form-control col-8">{{ ($logged_user->isSiteAdmin()) ? $user->email : '******@****.***' }}</label>
</div>
<div class="row d-flex justify-content-center">
	<label class="col-md-2 col-form-label text-md-right">{{ __('messages.tel') }}</label>
	<label class="h-100 form-control col-8">{{ ($logged_user->isSiteAdmin()) ? $user->tel_user : '**********' }}</label>
</div>
@if($logged_user->isSiteAdmin())
<div class="row d-flex justify-content-center">
	<label class="col-md-2 col-form-label text-md-right">{{ __('messages.address') }}</label>
	<label class="h-100 form-control col-8">{!!$location->num_street.' '.$street->name_street.' '.$city->zip_city.' '.$city->name_city.', '.$department->name_department.', '.$country->name_country!!} </label>
</div>
@else
<div class="row d-flex justify-content-center">
	<small class="text-center">{{ __('messages.want_contact') }}</small>
</div>
@endif


<div class="row d-flex justify-content-center my-4">
	<div class="col-8">
		<div class="card">
			<div class="card-header">
				<h4>{{ __('messages.statistics') }}</h4>
			</div>
			<div class="card-body">
				<p>{{ trans_choice('messages.user_admin_lan', $lans_admin_count, ['count' => $lans_admin_count]) }}
				
				This user is currently administrating {{$lans_admin_count}} {{($lans_admin_count>1) ? 'lans' : 'lan'}}</p>
				<p>This user is currently helping on {{$lans_helper_count}} {{($lans_helper_count>1) ? 'lans' : 'lan'}}</p>
				<p>This user is planning to play in {{$lans_player_count}} {{($lans_player_count>1) ? 'lans' : 'lan'}}</p>
				<hr/>
				<p>This user has been administrating {{$lans_former_admin_count}} {{($lans_former_admin_count>1) ? 'lans' : 'lan'}}</p>
				<p>This user has been helping on {{$lans_former_helper_count}} {{($lans_former_helper_count>1) ? 'lans' : 'lan'}}</p>
				<p>This user has been playing in {{$lans_former_player_count}} {{($lans_former_player_count>1) ? 'lans' : 'lan'}}</p>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/user/ajax_contact.js"></script>
