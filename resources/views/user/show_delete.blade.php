<tr scope="row" id="row-user-{{$user->id}}">
	<th scope="col">{{ $user->id }}</th>
	<td scope="col">{!! $user->name.' '.$user->lastname !!}</td>
	<td scope="col">{!! $user->pseudo !!}</td>
	<td scope="col">
		<a class="btn btn-success" href="{{ route('user.show', $user->id) }}"><i class='fa fa-eye'></i> {{ __('messages.view') }}</a>
		<a class="btn btn-warning" href="{{ route('user.edit', $user->id) }}"><i class='fa fa-edit'></i> {{ __('messages.edit') }}</a>
		{!! Form::open(['method' => 'put', 'onsubmit' => 'return banUser(event,'.$user->id.')']) !!}
			<button type="submit" class="btn btn-danger mt-1"><i class="fa fa-ban" aria-hidden="true"></i> {{ __('messages.ban') }}</button>
		{{ Form::close() }}
	</td>
</tr>
