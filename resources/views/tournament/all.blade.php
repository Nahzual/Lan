@extends('layouts.dashboard')

@section('title')
All Tournaments
@endsection

@section('page-title')
All Tournaments
@endsection

@section('content')
<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

<div class="table-responsive">
  <table class="table card-table">
    <thead class="card-table text-center">
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col" >Game</th>
      <th scope="col">Hour</th>
      <th scope="col" >Actions</th>
    </thead>

    <tbody>
      @if(count($tournaments)==0)
      <tr>
        <td colspan="5"><h3 class="text-center">No tournaments to show</h3></td>
      </tr>
      @endif

      @foreach($tournaments as $tournament)

      <tr id="row-tournament-lan-{{$tournament->id}}">
        <th scope="row" class="text-center">{{$tournament->id}}</th>
        <td scope="col" class="text-center ">{{$tournament->name_tournament}}</a></td>
        <td scope="col" class="text-center ">{{ substr(($tournament->desc_tournament), 0, 50) }}</td>
        <td scope="col" class="text-center">{{ $tournament->opening_date_tournament }}</td>


        <td scope="col" class=" text-center">
          <div class="btn-group">
						{!! Form::open(['method' => 'get','url'=>route('tournament.show_tournament', array('lan' => $lan->id, 'tournament' => $tournament->id)) ]) !!}
							<button type="submit" class="btn btn-success mr-2"><i class='fa fa-eye'></i></button>
						{!! Form::close() !!}
		        @if(isset($userIsLanAdmin) && $userIsLanAdmin)
							{!! Form::open(['method' => 'get','url'=>route('tournament.edit_tournament', array('lan' => $lan->id, 'tournament' => $tournament->id)) ]) !!}
									<button type="submit" class="btn btn-warning mr-2"><i class='fa fa-edit'></i></button>
							{!! Form::close() !!}
		          {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeTournament(event,'.$lan->id.','.$tournament->id.')']) !!}
		            <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i></button>
		          {!! Form::close() !!}
		        @endif
					</td>
				</div>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<nav aria-label="page navigation">
	<ul class="pagination justify-content-end">
		<li class="page-item">
			<a class="btn btn-info" href="{{ url('/dashboard/admin') }}" tabindex="-2">{{ __('messages.back_admin_dash') }}</a>

			<li class="page-item">
				<a class="btn btn-secondary" href="{{ url('/adm/users') }}" tabindex="-2">{{ __('messages.first') }}</a>
			</li>
			<li class="page-item @if($previous == 0) disabled @endif">
				<a class="btn btn-outline-info" href="{{ $previous!=0 ?  url('adm/users/'.($previous)) : '#' }}" tabindex="-1">{{ __('messages.back') }}</a>
			</li>
			<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/adm/users/'.($page)) }}">{{ $page }}</a></li>
			@if(($page+1)<=$max) <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/adm/users/'.($page+1)) }}">{{ ($page+1) }}</a></li>@endif
			@if(($page+2)<=$max)<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/adm/users/'.($page+2)) }}">{{ ($page+2) }}</a></li>@endif
			<li class="page-item @if($next) @else disabled @endif">
				<a class="btn btn-outline-info" href="{{ $next ? url('/adm/users/'.($next)) : '#' }}">{{ __('messages.next') }}</a>
			</li>
			<li class="page-item">
				<a class="btn btn-secondary" href="{{ url('/adm/users/'.$max) }}">{{ __('messages.last') }}</a>
			</li>
		</ul>
	</nav>
@endsection

@section('js_includes')

@endsection

@section('css_includes')
<link href="{{ asset('css/game/game.css') }}" rel="stylesheet">
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
