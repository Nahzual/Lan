function sendRequest(e,lanID){
	e.preventDefault();
	$.ajaxSetup({
		headers:{
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		url: '/lan/'+lanID+'/task/store',
		method: 'post',
		data: {
			name_task: $('#name_task').val(),
			desc_task: $('#desc_task').val(),
			deadline_task: $('#deadline_task').val(),
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
