function removeMaterial(e,idLan,idMaterial){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "DELETE",
    url: '/lan/material/'+idLan,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&_method='+'DELETE'
          +'&material_id='+idMaterial,
    success: function(data){
      if(data.success != undefined){
				$('#row-material-lan-'+idMaterial).html('');
        $('#response-success-material').show();
        $('#response-error-material').hide();
        $('#response-success-material').html(data.success);
      }else{
        $('#response-error-material').show();
        $('#response-success-material').hide();
        $('#response-error-material').html(data.error);
      }
    },
    error: function(data){
      $('#response-error-material').show();
      $('#response-success-material').hide();
      $('#response-error-material').html("An error occured on the server, please try again later.");
    }
  });

  return false;
}
