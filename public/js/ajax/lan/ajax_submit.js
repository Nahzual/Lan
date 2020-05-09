function submit(e,id){
  if(e!=null) e.preventDefault();
	console.log('called');
  $.ajax({
    type: "PUT",
    url: '/lan/submit/'+id,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()+'&_method=PUT',
    success: function(data){
			var success=$('#response-success-delete');
			var error=$('#response-error-delete');
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
			var success=$('#response-success-delete');
			var error=$('#response-error-delete');
      error.show();
      success.hide();
      error.html("An error occured on the server, please try again later.");
    }
  });

  return false;
}
