<div class="table-responsive esp">
	<table class="table card-table table-bordered box_shadow">
		<thead class="text-center">
			<th scope="col">#</th>
			<th scope="col">Name</th>
			<th scope="col">Participants</th>
			<th scope="col">Date</th>
			<th scope="col"></th>
			<th scope="col"></th>
		</thead>

		<tbody>
			<tr>
				@foreach($lans as $lan)
				<?php $date = date_create($lan->opening_date); ?>
				<th class="text-center">{{$lan->id}}</th>
				<td class="text-center">{{$lan->name}}</td>
				<td class="text-center">{{ $lan->real_user_count() }}/{{ $lan->max_num_registrants }}</td>
				<td class="text-center">{{date_format($date, config("display.DATE_FORMAT"))}}</td>

				<td class="text-center">
					<a class="btn btn-success" href="{{ route('lan.guest_show', $lan->id) }}"><i class='fa fa-eye'></i> View</a>
				</td>
				<td class="text-center">
					<a class="btn btn-success" href="{{ route('lan.participate', $lan->id) }}"><i class="fa fa-sign-in"></i> Participate</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
