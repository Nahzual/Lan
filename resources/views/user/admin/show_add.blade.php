      <div class="card">
        <div class="card-header text-center">
          <h3 class="lead-title">Users</h3>
          <div class="row lead">
            <div class="hideOnSmallScreens col-2">#</div>
            <div class="changeSize col-4">Username</div>
            <div class="col-3"></div>
            <div class="col-3"></div>
          </div>
        </div>
        <div class="card-body text-center">
          @foreach($users as $admin)
          <div class="row">
            <div class="hideOnSmallScreens col-2 mt-2 lead-text">{{$admin->id}}</div>
            <div class="changeSize col-4 mt-2 lead-text">{{$admin->pseudo}}</div>

            <div class="col-3 mt-2 lead-text">
              <a class="btn btn-success" href="{{ route('user.show', $admin->id) }}"><i class='fa fa-eye'></i> View</a>
            </div>
            <div class="col-3 mt-2 lead-text">
              {!! Form::open(['method' => 'post','url'=>'', 'onsubmit'=>'addAdmin(event,'.$lan->id.','.$admin->id.')']) !!}
                <div class="form-group row text-center">
                  <div class="col">
                    <button type="submit" class="btn btn-primary"><i class='fa fa-plus-square'></i> Add</button>
                  </div>
                </div>
              {!! Form::close() !!}
            </div>
          </div>
          <br>
          @endforeach
        </div>
      </div>
