function deleteLan(e,id){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "DELETE",
    url: '/lan/'+id,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&_method='+'DELETE',
    success: function(data){
      if(data.success != undefined){
				$('#row-my-lan-'+id).html('');
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
