@extends('layouts.dashboard')

@section('content')

      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col mt-2">
              <h3>All the players for the LAN {{ $nlan }}</h3>
            </div>
        
	 </div>
        </div>

        <div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
        <div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

        <div class="card-body">
          

			<div class="table-responsive">
			  <table class="text-center table card-table table-bordered">
			    <thead class="card-table text-center">
			      <th scope="col">#</th>
			      <th scope="col">Username</th>
			      <th scope="col">Actions</th>
			    </thead>

			    <tbody>

			    @if (isset($users))
						@if(count($users)==0)
						<tr>
							<td colspan="3"><h3>No helpers to show</h3></td>
						</tr>
						@endif

			      @foreach($users as $helper)
			      <tr id="row-user-lan-{{$helper->id}}">
							<th>{{$helper->id}}</th>
							<td>{!!$helper->pseudo!!}</td>
							<td scope="col" class="text-center">
								<div class="btn-group text-center">
									{!! Form::open(['method' => 'get','url'=>route('user.show', $helper->id)]) !!}
										<button type="submit" class="mr-2 btn btn-success"><i class='fa fa-eye'></i></button>
									{!! Form::close() !!}
							  	{!! Form::open(['method' => 'delete','onsubmit'=>'return removeHelper(event,'.$id.','.$helper->id.')']) !!}
										<button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i></button>
									{!! Form::close() !!}
								</div>
							</td>
			    	</tr>
			      @endforeach
			    @endif
			    </tbody>
			  </table>
			</div>






		<nav aria-label="page navigation">
		  <ul class="pagination justify-content-end">
			<li class="page-item">
		      <a class="btn btn-info" href="{{ url('/lan/'.$id) }}" tabindex="-2">Return to the LAN</a>

		    <li class="page-item">
		      <a class="btn btn-secondary" href="{{ url('/lan/'.$id.'/users/') }}" tabindex="-2">First</a>
		    </li>
		    <li class="page-item @if($previous == 0) disabled @endif">
		      <a class="btn btn-outline-info" href="{{ $previous!=0 ?  url('/lan/'.$id.'/users/'.($previous)) : '#' }}" tabindex="-1">Back</a>
		    </li>
		    <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/users/'.($page)) }}">{{ $page }}</a></li>
		    @if(($page+1)<=$max) <li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/users/'.($page+1)) }}">{{ ($page+1) }}</a></li>@endif
		    @if(($page+2)<=$max)<li class="page-item"><a class="btn btn-outline-dark" href="{{ url('/lan/'.$id.'/users/'.($page+2)) }}">{{ ($page+2) }}</a></li>@endif
		    <li class="page-item @if($next) @else disabled @endif">
		      <a class="btn btn-outline-info" href="{{ $next ? url('/lan/'.$id.'/users/'.($next)) : '#' }}">Next</a>
		    </li>
		    <li class="page-item">
		      <a class="btn btn-secondary" href="{{ url('/lan/'.$id.'/users/'.$max) }}">Last</a>
		    </li>
		  </ul>
</nav>

        </div>

      </div>
@endsection

@section('js_includes')
<script type="text/javascript" src="/js/ajax/game/ajax.js"></script>
@endsection

@section('css_includes')
<link href="{{ asset('css/game/game.css') }}" rel="stylesheet">
<link href="{{ asset('css/table-style.css') }}" rel="stylesheet">
@endsection
