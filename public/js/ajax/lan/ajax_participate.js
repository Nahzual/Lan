function addPlayer(e,id){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "POST",
    url: '/lan/participate/'+id,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&place_number='+$("[name='place_number']").val(),
    success: function(data){
      if(data.success != undefined){
        $('#response-success').show();
        $('#response-success').html(data.success);
      }else{
        $('#response-error').show();
        $('#response-error').html(data.error);
      }
    },
    error: function(xhr,status,error){

    }
  });

  return false;
}

function removePlayer(e,id){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "DELETE",
    url: '/lan/participate/'+id,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val(),
    success: function(data){
      if(data.success != undefined){
        $('#response-success-player').show();
        $('#response-success-player').html(data.success);
      }else{
        $('#response-error-player').show();
        $('#response-error-player').html(data.error);
      }
    },
    error: function(xhr,status,error){

    }
  });

  return false;
}
