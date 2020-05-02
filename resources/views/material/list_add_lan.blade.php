
<div class="table-responsive">
  <table class="table card-table">
    <thead class="card-table text-center">
      <th scope="col" class="lead">#</th>
      <th scope="col" class="lead">Name</th>
      <th scope="col" class="lead">Description of the material</th>
      <th scope="col" class="lead">Price</th>
      <th scope="col" class="lead "></th>
    </thead>

    <tbody>
      @if(count($materials)==0)
      <tr>
        <td colspan="6"><h3 class="text-center">No materials to show</h3></td>
      </tr>
      @endif

      @foreach($materials as $material)
      <tr>
        <th scope="row" class="text-center lead-text">{{$material->id}}</th>
        <td scope="col" class="text-center lead-text"><a href="{{ route('material.show', $material->id) }}">{{$material->name_material}}</a></td>
        <td scope="col" class="text-center lead-text">  </td>
        <td scope="col" class="text-center lead-text">  </td>

        <td scope="col" class="lead-text">
          {!! Form::open(['method' => 'post','url'=>'', 'onsubmit'=>'return addMaterial(event,'.$lan->id.','.$material->id.')']) !!}
            <div class="form-group row text-center">
              <div class="col">
                <button type="submit" class="btn btn-success"><i class='fa fa-plus-square'></i> Add material</button>
              </div>
            </div>
          {!! Form::close() !!}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
