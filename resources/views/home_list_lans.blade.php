<div class="table-responsive">
	<table class="table card-table table-bordered">
		<thead class="text-center">
			<th scope="col" class="lead">#</th>
			<th scope="col" class="lead ">Name</th>
			<th scope="col" class="lead">Participants</th>
			<th scope="col" class="lead ">Date</th>
			<th scope="col" class="lead "></th>
			<th scope="col" class="lead "></th>
		</thead>

		<tbody>
			<tr>
				@foreach($lans as $lan)
				<?php $date = date_create($lan->opening_date); ?>
				<th class="lead-text text-center">{{$lan->id}}</th>
				<td class="lead-text text-center">{{$lan->name}}</td>
				<td class="lead-text text-center">{{ $lan->real_user_count() }}/{{ $lan->max_num_registrants }}</td>
				<td class="lead-text text-center">{{date_format($date, config("display.DATE_FORMAT"))}}</td>

				<td class="text-center">
					<a class="btn btn-success" href="{{ route('lan.show', $lan->id) }}"><i class='fa fa-eye'></i> View</a>
				</td>
				<td class="text-center">
					<a class="btn btn-success" href="{{ route('lan.participate', $lan->id) }}"><i class="fa fa-sign-in"></i> Participate</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
