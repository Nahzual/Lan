function deleteTask(e,idLan,idTask){
  if(e!=null) e.preventDefault();

	if(confirm("Do you really want to delete this task ?")){
		$.ajax({
	    type: "DELETE",
	    url: 'lan/'+idLan+'/task/'+idTask+'/destroy',
	    dataType: 'json',
	    data: "_token="+$("[name='_token']").val()
	          +'&_method='+'DELETE',
	    success: function(data){
				var success=$('#response-success-delete-task');
				var error=$('#response-error-delete-task');
	      if(data.success != undefined){
					$('#row-task-'+id).html('');
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
				var success=$('#response-success-delete-task');
				var error=$('#response-error-delete-task');
	      error.show();
	      success.hide();
	      error.html("An error occured on the server, please try again later.");
	    }
	  });
	}

  return false;
}
