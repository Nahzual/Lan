
<div class="table-responsive">
  <table class="table card-table">
    <thead class="card-table text-center">
      <th scope="col" class="lead">#</th>
      <th scope="col" class="lead">Name</th>
      <th scope="col" class="lead">Description</th>
      <th scope="col" class="lead">Quantity</th>
      @if($userIsLanAdmin) <th scope="col" class="lead "></th> @endif

    </thead>

    <tbody>
      @if(count($materials)==0)
      <tr>
        <td colspan="5"><h3 class="text-center">No materials to show</h3></td>
      </tr>
      @endif

      @foreach($materials as $material)
      <tr id="row-material-lan-{{$material->id}}">
        <th scope="row" class="text-center lead-text">{{$material->id}}</th>
        <td scope="col" class="text-center lead-text"><a href="{{ route('material.show', $material->id) }}">{{$material->name_material}}</a></td>
        <td scope="col" class="text-center lead-text">{{$material->desc_material}}</td>
        <td scope="col" class="text-center lead-text">{{$material->quantity}}</td>

        @if($userIsLanAdmin)
          <td scope="col" class="lead-text">
            {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeMaterial(event,'.$lan->id.','.$material->id.')']) !!}
              <div class="form-group row text-center">
                <div class="col">
                  <button type="submit" class="btn btn-warning"><i class='fa fa-times'></i> Remove</button>
                </div>
              </div>
            {!! Form::close() !!}
          </td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
