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
	        success.html('Your account has been successfully deleted, you will be redirected in few seconds.');
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
	      error.show();
	      success.hide();
	      error.html("An error occured on the server, please try again later.");
	    }
	  });
	}

  return false;
}
