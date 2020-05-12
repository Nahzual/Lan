function sendRequest(e,userID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "POST",
    url: '/contact/'+userID,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val(),
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
