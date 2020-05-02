function sendRequest(e,id){
	if(e!=null) e.preventDefault();
	$.ajax({
		type: "DELETE",
		url: '/shopping/'+id,
		dataType: 'json',
		data: "_token="+$("[name='_token']").val()
		+'&_method='+$("[name='_method']").val(),
		success: function(data){
			if(data.success != undefined){
				$('#response-success').show();
				$('#response-error').hide();
				$('#response-success').html(data.success);
			}else{
				$('#response-error').show();
				$('#response-success').hide();
				$('#response-error').html(data.error);
			}
		},
		error: function(data){
			$('#response-error').show();
			$('#response-success').hide();
			$('#response-error').html("An error occured on the server, please try again later.");
		}
	});

	return false;
}
