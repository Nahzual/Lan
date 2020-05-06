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
	      if(data.success != undefined){
					$('#row-task-'+id).html('');
	        $('#response-success-delete-task').show();
	        $('#response-error-delete-task').hide();
	        $('#response-success-delete-task').html(data.success);
	      }else{
	        $('#response-error-delete-task').show();
	        $('#response-success-delete-task').hide();
	        $('#response-error-delete-task').html(data.error);
	      }
	    },
	    error: function(data){
	      $('#response-error-delete-task').show();
	      $('#response-success-delete-task').hide();
	      $('#response-error-delete-task').html("An error occured on the server, please try again later.");
	    }
	  });
	}

  return false;
}
