function addPort(e,lanID,gameID){
  if(e!=null) e.preventDefault();
	var port=$("[name='port']").val();
	var ports_column=$("#game-ports-"+gameID);

  $.ajax({
    type: "POST",
    url: '/lan/'+lanID+'/game/'+gameID+'/port',
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&port='+port,
    success: function(data){
      if(data.success != undefined){
				ports_column.html(ports_column.html().trim());
				if(ports_column.html().length===0){
					ports_column.html(port);
				}else{
					ports_column.html(ports_column.html()+', '+port+' ');
				}
				$('#response-success').show();
				$('#response-error').hide();
				$('#response-success').html(data.success);
      }else{
        $('#response-error').show();
        $('#response-success').hide();
        $('#response-error').html(data.error);
      }
    },
    error: function(data){
      $('#response-error').show();
      $('#response-success').hide();
      $('#response-error').html("An error occured on the server, please try again later.");
    }
  });

  return false;
}

function removePort(e,lanID,gameID){
  if(e!=null) e.preventDefault();
	var port=$("[name='port']").val();
	var ports_column=$("#game-ports-"+gameID);

  $.ajax({
    type: "DELETE",
    url: '/lan/'+lanID+'/game/'+gameID+'/port',
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&port='+port,
    success: function(data){
      if(data.success != undefined){
				ports_column.html(data.new_port_list);
        $('#response-success').show();
        $('#response-error').hide();
        $('#response-success').html(data.success);
      }else{
        $('#response-error').show();
        $('#response-success').hide();
        $('#response-error').html(data.error);
      }
    },
    error: function(data){
      $('#response-error').show();
      $('#response-success').hide();
      $('#response-error').html("An error occured on the server, please try again later.");
    }
  });

  return false;
}
