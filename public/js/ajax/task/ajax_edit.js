function sendRequest(e,lanID,taskID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "PUT",
    url: '/lan/'+lanID+'/task/'+taskID+'/edit',
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&_method='+$("[name='_method']").val()
          +'&name_task='+$("[name='name_task']").val()
					+'&desc_task='+$("[name='desc_task']").val()
          +'&deadline_task='+$("[name='deadline_task']").val(),
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

  return false;
}
