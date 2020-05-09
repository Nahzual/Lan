function removeActivity(e, lanId, activityId){
  if(e!=null) e.preventDefault();

	if(confirm("Do you really want to delete this activity ?")){
	  $.ajax({
	    type: "DELETE",
	    url: '/lan/'+lanId+'/activity/'+activityId+'/destroy',
	    dataType: 'json',
	    data: "_token="+$("[name='_token']").val()
	          +'&_method='+$("[name='_method']").val(),
	    success: function(data){
				var success=$('#response-success-activity');
				var error=$('#response-error-activity');
	      if(data.success != undefined){
					$('#row-activity-lan-'+activityId).html('');
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
				var success=$('#response-success-activity');
				var error=$('#response-error-activity');
	      error.show();
	      success.hide();
	      error.html("An error occured on the server, please try again later.");
	    }
	  });
	}

  return false;
}
