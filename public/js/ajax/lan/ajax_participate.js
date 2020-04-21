function sendRequest(e,id){
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
