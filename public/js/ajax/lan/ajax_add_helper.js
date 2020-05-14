function searchHelper(e,lanID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "GET",
    url: '/search/user/',
    dataType: 'html',
    data: "_token="+$("[name='_token']").val()
          +'&pseudo='+$("[name='pseudo']").val()
          +'&lan_id='+lanID
          +'&view_path='+$('[name=view_path]').val(),
    success: function(data){
      $('#requestResult').html(data);
    },
    error: function(xhr,status,error){
			var success=$('#response-success');
			var error=$('#response-error');
      error.show();
      success.hide();
      error.html("An error occured on the server, please try again later.");
    }
  });

  return false;
}

function addHelper(e,lanID,helperID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "POST",
    url: '/lan/helper/'+lanID,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&id_user='+helperID,
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
    error: function(xhr,status,error){
			var success=$('#response-success');
			var error=$('#response-error');
      error.show();
      success.hide();
      error.html("An error occured on the server, please try again later.");
    }
  });

  return false;
}

function removeHelper(e,lanID,helperID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "DELETE",
    url: '/lan/helper/'+lanID,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&id_user='+helperID,
    success: function(data){
			var success=$('#response-success-helper');
			var error=$('#response-error-helper');
      if(data.success != undefined){
				$('#row-helper-lan-'+helperID).remove();
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
			var success=$('#response-success-helper');
			var error=$('#response-error-helper');
      error.show();
      success.hide();
      error.html("An error occured on the server, please try again later.");
    }
  });

  return false;
}
