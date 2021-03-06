function join(e,tournamentId,userId){
	if(e!=null) e.preventDefault();

	$.ajax({
		type: "POST",
		url: '/tournament/'+tournamentId+'/join/'+userId,
		dataType: 'json',
		data: "_token="+$("[name='_token']").val(),
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
		error: function(xhr,status,error){
			$('#response-error').show();
			$('#response-success').hide();
			$('#response-error').html("An error occured on the server, please try again later."+error);
		}
	});

	return false;
}
