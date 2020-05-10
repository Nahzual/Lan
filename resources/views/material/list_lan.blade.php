
<div class="table-responsive">
  <table class="table card-table text-center">
    <thead class="card-table text-center">
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Actions</th>
    </thead>

    <tbody>
      @if(count($materials)==0)
      <tr>
        <td colspan="6"><h3 class="text-center">No materials to show</h3></td>
      </tr>
      @endif

      @foreach($materials as $material)
      <tr id="row-material-lan-{{$material->id}}">
        <th scope="row" class="text-center">{{$material->id}}</th>
        <td scope="col" class="text-center">{{$material->desc_material}}</td>
        <td scope="col" class="text-center">
					{!! Form::number('quantity-'.$material->id,$material->quantity,['class'=>'form-control text-center','min'=>'1']) !!}
          {!! Form::open(['method' => 'put','url'=>'', 'onsubmit'=>'return editQuantity(event,'.$lan->id.','.$material->id.')']) !!}
            <div class="form-group text-center mt-2">
              <div class="col">
                <button type="submit" class="btn btn-primary"><i class='fa fa-edit'></i> Edit quantity</button>
              </div>
            </div>
          {!! Form::close() !!}
        </td>

        <td scope="col">
					<button class="btn btn-success mb-1" onclick="openMaterial({{$material->id}})"><i class='fa fa-eye'></i></button>
          {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeMaterial(event,'.$lan->id.','.$material->id.')']) !!}
            <button type="submit" class="d-inline btn btn-danger"><i class='fa fa-trash'></i></button>
          {!! Form::close() !!}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
