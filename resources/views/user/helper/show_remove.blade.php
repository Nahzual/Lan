      <div class="card">
        <div class="card-header">
          <div class="col mt-2">
            <h3 class="lead-title">Helpers</h3>
          </div>
          <div class="row lead text-center">
            <div class="col-3">#</div>
            <div class="col">Username</div>
            <div class="col"></div>
            <div class="col"></div>
          </div>
        </div>
        <div class="card-body text-center">
        @if (isset($helpers))
          @foreach($helpers as $helper)
          <div class="row">
            <div class="col-3 mt-2 lead-text">{{$helper->id}}</div>
            <div class="col mt-2 lead-text">{{$helper->pseudo}}</div>

            <div class="col">
              <a class="btn btn-success" href="{{ route('user.show', $helper->id) }}"><i class='fa fa-eye'></i> View</a>
            </div>
            <div class="col">
              {!! Form::open(['method' => 'post','onsubmit'=>'removeHelper(event,'.$lan->id.','.$helper->id.')']) !!}
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
              <a class="btn btn-primary" href="{{ route('lan.add_helper', $lan->id) }}"><i class='fa fa-plus-square'></i> Add helpers</a>
            </div>
          </div>
        </div>
      </div>
