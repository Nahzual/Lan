function sendRequestAccept(e,id){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "PUT",
    url: '/lan/validation/'+id,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()+'&_method='+$("[name='_method']").val()+'&waiting_lan='+$("#waiting_lan_accept").val(),
    success: function(data){
			var success=$('#response-success-lans');
			var error=$('#response-error-lans');
      if(data.success != undefined){
				$('#row-waiting-lan-'+id).remove();
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
			var success=$('#response-success-lans');
			var error=$('#response-error-lans');
      error.show();
      success.hide();
      error.html("An error occured on the server, please try again later.");
    }
  });

  return false;
}

function sendRequestReject(e,id){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "PUT",
    url: '/lan/validation/'+id,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()+'&_method='+$("[name='_method']").val()+'&waiting_lan='+$("#waiting_lan_reject").val(),
    success: function(data){
			var success=$('#response-success-lans');
			var error=$('#response-error-lans');
      if(data.success != undefined){
				$('#row-waiting-lan-'+id).html('');
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
			var success=$('#response-success-lans');
			var error=$('#response-error-lans');
      error.show();
      success.hide();
      error.html("An error occured on the server, please try again later.");
    }
  });

  return false;
}
