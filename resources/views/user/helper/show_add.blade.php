      <div class="card">
        <div class="card-header text-center">
          <h3 class="lead-title">Users</h3>
          <div class="row lead">
            <div class="col-2 hideOnSmallScreens">#</div>
            <div class="col-4 changeSize">Username</div>
            <div class="col-3"></div>
            <div class="col-3"></div>
          </div>
        </div>
        <div class="card-body text-center">
          @foreach($users as $helper)
          <div class="row">
            <div class="hideOnSmallScreens col-2 mt-2 lead-text">{{$helper->id}}</div>
            <div class="col-4 mt-2 lead-text changeSize">{{$helper->pseudo}}</div>

            <div class="col-3 mt-2 lead-text">
              <a class="btn btn-success" href="{{ route('user.show', $helper->id) }}"><i class='fa fa-eye'></i> View</a>
            </div>
            <div class="col-3 mt-2 lead-text">
              {!! Form::open(['method' => 'post','url'=>'', 'onsubmit'=>'addHelper(event,'.$lan->id.','.$helper->id.')']) !!}
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
