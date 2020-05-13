function restoreUser(e,idUser){
  if(e!=null) e.preventDefault();

	$.ajax({
		type: "POST",
		url: '/user/'+idUser+'/restore',
		dataType: 'json',
		data: "_token="+$("[name='_token']").val(),
		success: function(data){
			var success=$('#response-success-users-deleted');
			var error=$('#response-error-users-deleted');
			if(data.success != undefined){
				// update html
				$('#row-user-deleted-'+idUser).remove();
				table=$('#table-users');
				table.html(table.html()+data.html);
				$('#row-user-empty').html('');

				// success
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
