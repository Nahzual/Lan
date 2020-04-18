function sendRequest(e,id){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "PUT",
    url: '/lan/'+id,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()+'&_method='+$("[name='_method']").val()+'&waiting_lan='+$("[name='waiting_lan']").val(),
    success: function(data){
      if(data.success!=""){
        $('#response-success').show();
        if($("[name='waiting_lan']").val()=='0') $('#response-success').html("La LAN a bien été validée.");
        else $('#response-success').html("La LAN a bien été rejetée.");
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
