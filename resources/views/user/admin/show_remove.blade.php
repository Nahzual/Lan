<div class="card">
	<div class="card-header">
    <div class="row">
      <div class="col mt-2">
        <h3 class="lead-title">Admins</h3>
      </div>
      <div class="col">
        <a class="btn btn-primary float-right" href="{{ route('lan.add_admin', $lan->id) }}"><i class='fa fa-plus'></i> Add admins</a>
      </div>
    </div>
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
    @if (isset($admins))
      @foreach($admins as $admin)
      <tr id="row-admin-lan-{{$admin->id}}">
        <th class="lead-text">{{$admin->id}}</th>
        <td class="lead-text">{{$admin->pseudo}}</td>
        <td>
          <a class="btn btn-success" href="{{ route('user.show', $admin->id) }}"><i class='fa fa-eye'></i> View</a>
        </td>
        <td>
          {!! Form::open(['method' => 'delete','onsubmit'=>'return removeAdmin(event,'.$lan->id.','.$admin->id.')']) !!}
            <div class="form-group row text-center">
              <div class="col">
                <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> Remove</button>
              </div>
            </div>
          {!! Form::close() !!}
        </td>
      </tr>
      @endforeach
    @endif
    </tbody>
  </table>
</div>
