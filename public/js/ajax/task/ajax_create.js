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
			if(result.success!=undefined){
				$('#response-success').show();
				$('#response-error').hide();
				$('#response-success').html(result.success);
			}else{
				$('#response-error').show();
				$('#response-success').hide();
				$('#response-error').html(result.error);
			}
		},
		error: function(xhr,status,error){
			$('#response-error').show();
			$('#response-success').hide();
			$('#response-error').html("An error occured on the server, please try again later.");
		}
	});
}
