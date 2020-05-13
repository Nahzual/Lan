function sendRequest(e,lanID){
	e.preventDefault();

	$.ajaxSetup({
		headers:{
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		url: '/lan/'+lanID+'/shopping/store',
		method: 'post',
		data: {
			name_material: $('#name_material').val(),
			desc_material: $('#desc_material').val(),
			category_material: $('#category_material').val(),
			cost_shopping: $('#cost_shopping').val(),
			quantity_shopping: $('#quantity_shopping').val(),
			material_id: $('#material_id').val(),
		},
		success: function(result){
			var success=$('#response-success');
			var error=$('#response-error');
			if(result.success!=undefined){
				success.show();
				error.hide();
				success.html(result.success);
			}else{
				error.show();
				success.hide();
				error.html(result.error);
			}
		},
		error: function(xhr,status,error){
			var success=$('#response-success');
			var error=$('#response-error');
			error.show();
			success.hide();
			error.html("An error occured on the server, please try again later.");
		}
	});
}
