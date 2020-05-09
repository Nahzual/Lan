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
			var success=$('#response-success-material');
			var error=$('#response-error-material');
      if(data.success != undefined){
				$('#row-material-lan-'+idMaterial).html('');
        success.show();
        error.hide();
        success.html(data.success);
      }else{
        error.show();
        success.hide();
        error.html(data.error);
      }
    },
    error: function(data){
			var success=$('#response-success-material');
			var error=$('#response-error-material');
			error.show();
      success.hide();
      error.html("An error occured on the server, please try again later.");
    }
  });

  return false;
}
