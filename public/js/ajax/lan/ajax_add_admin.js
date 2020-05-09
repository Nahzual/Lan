function searchAdmin(e,lanID){
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

function addAdmin(e,lanID,adminID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "POST",
    url: '/lan/admin/'+lanID,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&id_user='+adminID,
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

function removeAdmin(e,lanID,adminID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "DELETE",
    url: '/lan/admin/'+lanID,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&id_user='+adminID,
    success: function(data){
			var success=$('#response-success-admin');
			var error=$('#response-error-admin');
      if(data.success != undefined){
				$('#row-admin-lan-'+adminID).html('');
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
			var success=$('#response-success-admin');
			var error=$('#response-error-admin');
      error.show();
      success.hide();
      error.html("An error occured on the server, please try again later.");
    }
  });

  return false;
}
