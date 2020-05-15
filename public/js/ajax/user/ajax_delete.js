// this function lets a user delete his account
function deleteUser(e,idUser){
  if(e!=null) e.preventDefault();

	if(confirm("Do you really want to delete your account ?")){
		$.ajax({
	    type: "DELETE",
	    url: '/user/'+idUser,
	    dataType: 'json',
	    data: "_token="+$("[name='_token']").val()
	          +'&_method='+'DELETE',
	    success: function(data){
				var success=$('#response-success');
				var error=$('#response-error');
	      if(data.success != undefined){
	        success.show();
	        error.hide();
	        success.html(data.success);
					setTimeout(function(){
						header('/');
					},2000);
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
	}

  return false;
}

// this function lets a site admin ban users from his admin dashboard
function banUser(e,idUser){
  if(e!=null) e.preventDefault();

	if(confirm("Do you really want to ban this user ?")){
		$.ajax({
	    type: "DELETE",
	    url: '/user/'+idUser,
	    dataType: 'json',
	    data: "_token="+$("[name='_token']").val()
	          +'&_method='+'DELETE',
	    success: function(data){
				var success=$('#response-success-users');
				var error=$('#response-error-users');
				if(success==null){
					success=$('#response-success');
				}
				if(error==null){
					error=$('#response-error');
				}
	      if(data.success != undefined){

					//update html
					$('#row-user-'+idUser).remove();
					table=$('#table-deleted-users');
					table.html(table.html()+data.html);
					$('#row-user-deleted-empty').html('');

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
				var success=$('#response-success-users');
				var error=$('#response-error-users');
				if(success==null){
					success=$('#response-success');
				}
				if(error==null){
					error=$('#response-error');
				}
	      error.show();
	      success.hide();
	      error.html("An error occured on the server, please try again later.");
	    }
	  });
	}

  return false;
}

// this function is used to ban a user on the complete user list
function banUserList(e,idUser){
  if(e!=null) e.preventDefault();

	if(confirm("Do you really want to ban this user ?")){
		$.ajax({
	    type: "DELETE",
	    url: '/user/'+idUser,
	    dataType: 'json',
	    data: "_token="+$("[name='_token']").val()
	          +'&_method='+'DELETE',
	    success: function(data){
				var success=$('#response-success');
				var error=$('#response-error');
				if(success==null){
					success=$('#response-success');
				}
				if(error==null){
					error=$('#response-error');
				}
	      if(data.success != undefined){
					//update html
					$('#form-ban-'+idUser).hide();
					$('#form-undo-'+idUser).show();

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
				if(success==null){
					success=$('#response-success');
				}
				if(error==null){
					error=$('#response-error');
				}
	      error.show();
	      success.hide();
	      error.html("An error occured on the server, please try again later.");
	    }
	  });
	}

  return false;
}
