
<div class="table-responsive">
  <table class="table card-table">
    <thead class="card-table text-center">
      <th scope="col" class="lead">#</th>
      <th scope="col" class="lead">Name</th>
      <th scope="col" class="lead">Description</th>
      <th scope="col" class="lead">Quantity</th>
      <th scope="col" class="lead "></th>
			<th scope="col" class="lead "></th>
    </thead>

    <tbody>
      @if(count($materials)==0)
      <tr>
        <td colspan="6"><h3 class="text-center">No materials to show</h3></td>
      </tr>
      @endif

      @foreach($materials as $material)
      <tr id="row-material-lan-{{$material->id}}">
        <th scope="row" class="text-center lead-text">{{$material->id}}</th>
        <td scope="col" class="text-center lead-text"><a href="{{ route('material.show', $material->id) }}">{{$material->name_material}}</a></td>
        <td scope="col" class="text-center lead-text">{{$material->desc_material}}</td>
        <td scope="col" class="text-center lead-text">{!! Form::number('quantity-'.$material->id,$material->quantity,['class'=>'form-control text-center','min'=>'1']) !!}</td>

				<td scope="col" class="lead-text">
          {!! Form::open(['method' => 'put','url'=>'', 'onsubmit'=>'return editQuantity(event,'.$lan->id.','.$material->id.')']) !!}
            <div class="form-group row text-center">
              <div class="col">
                <button type="submit" class="btn btn-primary"><i class='fa fa-edit'></i> Edit quantity</button>
              </div>
            </div>
          {!! Form::close() !!}
        </td>

        <td scope="col" class="lead-text">
          {!! Form::open(['method' => 'delete','url'=>'', 'onsubmit'=>'return removeMaterial(event,'.$lan->id.','.$material->id.')']) !!}
            <div class="form-group row text-center">
              <div class="col">
                <button type="submit" class="btn btn-warning"><i class='fa fa-times'></i> Remove</button>
              </div>
            </div>
          {!! Form::close() !!}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
