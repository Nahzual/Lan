      <div class="card">
        <div class="card-header">
          <div class="col mt-2">
            <h3 class="lead-title">Admins</h3>
          </div>
          <div class="row lead text-center">
            <div class="col-3 hideOnSmallScreens">#</div>
            <div class="col">Username</div>
            <div class="col"></div>
            <div class="col"></div>
          </div>
        </div>
        <div class="card-body text-center">
        @if (isset($admins))
          @foreach($admins as $admin)
          <div class="row">
            <div class="hideOnSmallScreens col-3 mt-2 lead-text">{{$admin->id}}</div>
            <div class="col mt-2 lead-text">{{$admin->pseudo}}</div>

            <div class="col">
              <a class="btn btn-success" href="{{ route('user.show', $admin->id) }}"><i class='fa fa-eye'></i> View</a>
            </div>
            <div class="col">
              {!! Form::open(['method' => 'post','url'=>'','onsubmit'=>'removeAdmin(event,'.$lan->id.','.$admin->id.')']) !!}
                <div class="form-group row text-center">
                  <div class="col">
                    <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i> Remove</button>
                  </div>
                </div>
              {!! Form::close() !!}
            </div>
          </div>
          <br>
          @endforeach
          @endif
          <div class="form-group row text-center">
            <div class="col">
              <a class="btn btn-primary" href="{{ route('lan.add_admin', $lan->id) }}"><i class='fa fa-plus-square'></i> Add admins</a>
            </div>
          </div>
        </div>
      </div>
