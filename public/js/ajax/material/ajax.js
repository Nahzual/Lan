function deleteMaterial(e,materialID){
  if(e!=null) e.preventDefault();

	if(confirm("Do you really want to delete this material ?")){
	  $.ajax({
	    type: "DELETE",
	    url: '/material/'+materialID,
	    dataType: 'json',
	    data: "_token="+$("[name='_token']").val(),
	    success: function(data){
				var success=$('#response-success');
				var error=$('#response-error');
	      if(data.success != undefined){
					$('#row-material-'+materialID).html('');
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
	}

  return false;
}

function searchMaterials(e){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "GET",
    url: '/search/material/',
    dataType: 'html',
    data: "_token="+$("[name='_token']").val()
          +'&name_material='+$("[name='name_material']").val()
          +'&view_path='+$('[name=view_path]').val(),
    success: function(data){
      $('#request-result').html(data);
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
