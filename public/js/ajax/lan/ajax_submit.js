function submit(e,id){
  if(e!=null) e.preventDefault();
	console.log('called');
  $.ajax({
    type: "PUT",
    url: '/lan/submit/'+id,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()+'&_method=PUT',
    success: function(data){
      if(data.success != undefined){
        $('#response-success-delete').show();
        $('#response-error-delete').hide();
        $('#response-success-delete').html(data.success);
      }else{
        $('#response-error-delete').show();
        $('#response-success-delete').hide();
        $('#response-error-delete').html(data.error);
      }
    },
    error: function(data){
      $('#response-error-delete').show();
      $('#response-success-delete').hide();
      $('#response-error-delete').html("An error occured on the server, please try again later.");
    }
  });

  return false;
}
