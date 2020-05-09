function sendRequest(e,lanId,activityId){
	if(e!=null) e.preventDefault();

	$.ajax({
		type: "PUT",
		url: '/lan/'+lanId+'/activity/'+activityId+'/edit',
		dataType: 'json',
		data: "_token="+$("[name='_token']").val()
		+'&_method='+$("[name='_method']").val()
		+'&name_activity='+$("[name='name_activity']").val()
		+'&desc_activity='+$("[name='desc_activity']").val(),
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
