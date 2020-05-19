function sendRequest(e,materialID){
  if(e!=null) e.preventDefault();

	if(confirm("Do you really want to delete this material ?")){
	  $.ajax({
	    type: "DELETE",
	    url: '/material/'+materialID,
	    dataType: 'json',
	    data: "_token="+$("[name='_token']").val(),
	    success: function(data){
				var success=$('#response-success');
				var error=$('#response-error');
	      if(data.success != undefined){
					$('#row-material-'+materialID).html('');
	        success.show();
	        error.hide();
	        success.html(data.success);
	      }else{
	        error.show();
	        success.hide();
	        error.html(data.error);
	      }
	    },
	    error: function(xhr,status,error){
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
