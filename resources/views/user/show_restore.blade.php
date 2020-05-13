<tr scope="row" id="row-user-deleted-{{$user->id}}">
	<th scope="col">{{ $user->id }}</th>
	<td scope="col">{!! $user->name.' '.$user->lastname !!}</td>
	<td scope="col">{!! $user->pseudo !!}</td>
	<td scope="col">
		<a class="btn btn-success" href="{{ route('user.show', $user->id) }}"><i class='fa fa-eye'></i> View</a>
		<a class="btn btn-warning" href="{{ route('user.edit', $user->id) }}"><i class='fa fa-edit'></i> Edit</a>
		{!! Form::open(['method' => 'put', 'onsubmit' => 'return restoreUser(event,'.$user->id.')']) !!}
			<button type="submit" class="btn btn-primary mt-1"><i class="fa fa-undo" aria-hidden="true"></i> Restore</button>
		{{ Form::close() }}
	</td>
</tr>
