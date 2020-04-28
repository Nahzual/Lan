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
