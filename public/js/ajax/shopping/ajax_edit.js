function sendRequest(e,lanId,shoppingId){
	if(e!=null) e.preventDefault();

	$.ajax({
		type: "PUT",
		url: '/lan/'+lanId+'/shopping/'+shoppingId+'/edit',
		dataType: 'json',
		data: "_token="+$("[name='_token']").val()
			+'&_method='+$("[name='_method']").val()
			+'&name_material='+$("[name='name_material']").val()
			+'&desc_material='+$("[name='desc_material']").val()
			+'&price_material='+$("[name='price_material']").val()
			+'&cost_shopping='+$("[name='cost_shopping']").val()
			+'&quantity_shopping='+$("[name='quantity_shopping']").val(),
		success: function(data){
			var success=$('#response-success');
			var error=$('#response-error');
			if(data.success != undefined){
				success.show();
				error.hide();
				success.html(data.success);
			}else{
				error.show();
				success.hide();
				error.html(data.error);
			}
		},
		error: function(data){
			var success=$('#response-success');
			var error=$('#response-error');
			error.show();
			success.hide();
			error.html("An error occured on the server, please try again later.");
		}
	});
	return false;
}
