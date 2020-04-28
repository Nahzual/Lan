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
      $('#response-error').show();
      $('#response-success').hide();
      $('#response-error').html("An error occured on the server, please try again later.");
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
      if(data.success != undefined){
        $('#response-success').show();
        $('#response-error').hide();
        $('#response-success').html(data.success);
      }else{
        $('#response-error').show();
        $('#response-success').hide();
        $('#response-error').html(data.error);
      }
    },
    error: function(xhr,status,error){
      $('#response-error').show();
      $('#response-success').hide();
      $('#response-error').html("An error occured on the server, please try again later.");
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
      if(data.success != undefined){
				$('#row-admin-lan-'+adminID).html('');
        $('#response-success-admin').show();
        $('#response-error-admin').hide();
        $('#response-success-admin').html(data.success);
      }else{
        $('#response-error-admin').show();
        $('#response-success-admin').hide();
        $('#response-error-admin').html(data.error);
      }
    },
    error: function(xhr,status,error){
      $('#response-error-admin').show();
      $('#response-success-admin').hide();
      $('#response-error-admin').html("An error occured on the server, please try again later.");
    }
  });

  return false;
}
