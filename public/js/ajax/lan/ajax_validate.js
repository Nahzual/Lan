function sendRequestAccept(e,id){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "PUT",
    url: '/lan/'+id,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()+'&_method='+$("[name='_method']").val()+'&waiting_lan='+$("#waiting_lan_accept").val(),
    success: function(data){
      if(data.success!=""){
        $('#response-success').show();
        $('#response-success').html("La LAN a bien été validée.");
      }else{
        $('#response-error').show();
        $('#response-error').html(data.error);
      }
    },
    error: function(data){

    }
  });

  return false;
}

function sendRequestReject(e,id){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "PUT",
    url: '/lan/'+id,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()+'&_method='+$("[name='_method']").val()+'&waiting_lan='+$("#waiting_lan_reject").val(),
    success: function(data){
      if(data.success!=""){
        $('#response-success').show();
        $('#response-success').html("La LAN a bien été refusée.");
      }else{
        $('#response-error').show();
        $('#response-error').html(data.error);
      }
    },
    error: function(data){

    }
  });

  return false;
}
