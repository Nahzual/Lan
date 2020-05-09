function sendRequest(e,lanID){
	e.preventDefault();

	$.ajaxSetup({
		headers:{
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		url: '/lan/'+lanID+'/activity/store',
		method: 'post',
		data: {
			name_activity: $('#name_activity').val(),
			desc_activity: $('#desc_activity').val()
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
