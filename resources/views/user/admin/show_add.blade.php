

<div class="card">
	<div class="card-header text-center">
    <h3 class="lead-title">Users</h3>
  </div>
</div>

<div class="table-responsive">
  <table class="text-center table card-table table-bordered">
    <thead class="card-table text-center">
      <th scope="col" class="lead">#</th>
      <th scope="col" class="lead ">Username</th>
      <th scope="col" class="lead "></th>
      <th scope="col" class="lead "></th>
    </thead>

    <tbody>
    @foreach($users as $admin)
      <tr>
        <th class="lead-text">{{$admin->id}}</th>
        <td class="lead-text">{{$admin->pseudo}}</td>

        <td>
          <a class="btn btn-success" href="{{ route('user.show', $admin->id) }}"><i class='fa fa-eye'></i> View</a>
        </td>
        <td>
          {!! Form::open(['method' => 'post','url'=>'', 'onsubmit'=>'addAdmin(event,'.$lan->id.','.$admin->id.')']) !!}
            <div class="form-group row text-center">
              <div class="col">
                <button type="submit" class="btn btn-primary"><i class='fa fa-plus-square'></i> Add</button>
              </div>
            </div>
          {!! Form::close() !!}
        </td>
      </tr>
    @endforeach
		</tbody>
  </table>
</div>
