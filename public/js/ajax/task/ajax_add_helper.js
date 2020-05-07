function searchHelper(e,taskID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "GET",
    url: '/search/helper/'+taskID,
    dataType: 'html',
    data: "_token="+$("[name='_token']").val()
          +'&pseudo='+$("[name='pseudo']").val(),
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

function assign(e,lanID,taskID,helperID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "POST",
    url: '/lan/'+lanID+'/task/'+taskID+'/assign',
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&user_id='+helperID,
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

function unassign(e,lanID,taskID,helperID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "DELETE",
    url: '/lan/'+lanID+'/task/'+taskID+'/unassign',
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&user_id='+helperID,
    success: function(data){
      if(data.success != undefined){
				$('#task-helper-'+helperID).hide('');
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
