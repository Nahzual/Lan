
// this function is used to restore a user account on the admin dashboard
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
			var success=$('#response-success-users-deleted');
			var error=$('#response-error-users-deleted');
			error.show();
			success.hide();
			error.html("An error occured on the server, please try again later.");
		}
	});

  return false;
}

// this function is used to restore a user account on the complete user list
function restoreUserList(e,idUser){
  if(e!=null) e.preventDefault();

	$.ajax({
		type: "POST",
		url: '/user/'+idUser+'/restore',
		dataType: 'json',
		data: "_token="+$("[name='_token']").val(),
		success: function(data){
			var success=$('#response-success');
			var error=$('#response-error');
			if(data.success != undefined){
				// update html
				$('#form-ban-'+idUser).show();
				$('#form-undo-'+idUser).hide();

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
