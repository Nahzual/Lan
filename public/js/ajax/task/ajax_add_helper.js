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
			var success=$('#response-success');
			var error=$('#response-error');
      error.show();
      success.hide();
      error.html("An error occured on the server, please try again later.");
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

function unassign(e,lanID,taskID,helperID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "DELETE",
    url: '/lan/'+lanID+'/task/'+taskID+'/unassign',
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&user_id='+helperID,
    success: function(data){
			var success=$('#response-success');
			var error=$('#response-error');
      if(data.success != undefined){
				$('#task-helper-'+helperID).hide('');
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
