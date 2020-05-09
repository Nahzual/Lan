function deleteLan(e,id){
  if(e!=null) e.preventDefault();

	if(confirm("Do you really want to delete this LAN ?")){
		$.ajax({
	    type: "DELETE",
	    url: '/lan/'+id,
	    dataType: 'json',
	    data: "_token="+$("[name='_token']").val()
	          +'&_method='+'DELETE',
	    success: function(data){
				var success=$('#response-success-delete');
				var error=$('#response-error-delete');
	      if(data.success != undefined){
					$('#row-my-lan-'+id).html('');
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
				var success=$('#response-success-delete');
				var error=$('#response-error-delete');
	      error.show();
	      success.hide();
	      error.html("An error occured on the server, please try again later.");
	    }
	  });
	}

  return false;
}
