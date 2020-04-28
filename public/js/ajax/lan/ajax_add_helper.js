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
      $('#response-error').show();
      $('#response-success').hide();
      $('#response-error').html("An error occured on the server, please try again later.");
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

function removeHelper(e,lanID,helperID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "DELETE",
    url: '/lan/helper/'+lanID,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&id_user='+helperID,
    success: function(data){
      if(data.success != undefined){
				$('#row-helper-lan-'+helperID).html('');
        $('#response-success-helper').show();
        $('#response-error-helper').hide();
        $('#response-success-helper').html(data.success);
      }else{
        $('#response-error-helper').show();
        $('#response-success-helper').hide();
        $('#response-error-helper').html(data.error);
      }
    },
    error: function(xhr,status,error){
      $('#response-error-helper').show();
      $('#response-success-helper').hide();
      $('#response-error-helper').html("An error occured on the server, please try again later.");
    }
  });

  return false;
}
