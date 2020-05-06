
<div class="table-responsive col">
  <table class="table card-table">
    <thead class="card-table text-center">
      <th scope="col" >#</th>
      <th scope="col">Name</th>
      <th scope="col">Description of the material</th>
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
      <tr>
        <th scope="row" class="text-center">{{$material->id}}</th>
        <td scope="col" class="text-center"><a href="{{ route('material.show', $material->id) }}">{{$material->name_material}}</a></td>
        <td scope="col" class="text-center">{{$material->desc_material}}</td>

				<td scope="col" class="lead-text">
					{!! Form::number('quantity-'.$material->id,null, ['min'=>1, 'class'=>'form-control'])!!}
				</td>

        <td scope="col">
					{!! Form::open(['method' => 'post','url'=>'', 'onsubmit'=>'return addMaterial(event,'.$lan->id.','.$material->id.')']) !!}
	          <div class="form-group row text-center">
	            <div class="col">
	              <button type="submit" class="btn btn-success shadow-sm"><i class='fa fa-plus-square'></i> Add material</button>
	            </div>
	          </div>
					{!! Form::close() !!}
        </td>
			</tr>
      @endforeach
    </tbody>
  </table>
</div>
