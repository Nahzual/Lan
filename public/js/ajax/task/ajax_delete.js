function deleteTask(e,idLan,idTask){
  if(e!=null) e.preventDefault();

	if(confirm("Do you really want to delete this task ?")){
		$.ajax({
	    type: "DELETE",
	    url: '/lan/'+idLan+'/task/'+idTask+'/destroy',
	    dataType: 'json',
	    data: "_token="+$("[name='_token']").val()
	          +'&_method='+'DELETE',
	    success: function(data){
				var success=$('#response-success-task');
				var error=$('#response-error-task');
	      if(data.success != undefined){
					$('#row-task-lan-'+idTask).html('');
	        success.show();
	        error.hide();
	        success.html(data.success);
	      }else{
					console.log(data.error);
	        error.show();
	        success.hide();
	        error.html(data.error);
	      }
	    },
	    error: function(data){
				var success=$('#response-success-task');
				var error=$('#response-error-task');
	      error.show();
	      success.hide();
	      error.html("An error occured on the server, please try again later.");
	    }
	  });
	}

  return false;
}

function deleteShow(e,idLan,idTask){
  if(e!=null) e.preventDefault();

	if(confirm("Do you really want to delete this task ?")){
		$.ajax({
	    type: "DELETE",
	    url: '/lan/'+idLan+'/task/'+idTask+'/destroy',
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
