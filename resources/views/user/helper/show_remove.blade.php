      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col mt-2">
              <h3 class="lead-title">Helpers</h3>
            </div>
            <div class="col">
              <a class="btn btn-primary float-right" href="{{ route('lan.add_helper', $lan->id) }}"><i class='fa fa-plus'></i> Add helpers</a>
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
          @if (isset($helpers))
            @foreach($helpers as $helper)
            <tr>
              <th class="lead-text">{{$helper->id}}</th>
              <td class="lead-text">{{$helper->pseudo}}</td>

              <td>
                <a class="btn btn-success" href="{{ route('user.show', $helper->id) }}"><i class='fa fa-eye'></i> View</a>
              </td>
              <td>
                {!! Form::open(['method' => 'post','onsubmit'=>'removeHelper(event,'.$lan->id.','.$helper->id.')']) !!}
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
