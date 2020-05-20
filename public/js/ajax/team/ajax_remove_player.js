function removePlayer(e, teamId, userId){
	if(e!=null) e.preventDefault();

	$.ajax({
		type: "DELETE",
		url: '/team/'+teamId+'/leave',
		dataType: 'json',
		data: "_token="+$("[name='_token']").val()
					+'&_method=delete'
					+'&user_id='+userId,
		success: function(data){
			var success=$('#response-success');
			var error=$('#response-error');
			if(data.success != undefined){
				$('#row-user-team-'+userId).remove();
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
