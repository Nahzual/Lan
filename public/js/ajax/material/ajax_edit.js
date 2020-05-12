function sendRequest(e,id){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "PUT",
    url: '/material/'+id,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&_method='+$("[name='_method']").val()
          +'&name_material='+$("[name='name_material']").val()
          +'&desc_material='+$("[name='desc_material']").val()
					+'&category_material='+$("[name='category_material']").val(),
    success: function(data){
			var success=$('#response-success');
			var error=$('#response-error');
      if(data.success != undefined){
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
			var success=$('#response-success');
			var error=$('#response-error');
      error.show();
      success.hide();
      error.html("An error occured on the server, please try again later.");
    }
  });

  return false;
}

function editQuantity(e,lanID,materialID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "PUT",
    url: '/lan/material/'+lanID,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&_method='+'PUT'
          +'&material_id='+materialID
					+'&quantity='+$("[name='quantity-"+materialID+"']").val(),
    success: function(data){
			var success=$('#response-success-material');
			var error=$('#response-error-material');
      if(data.success != undefined){
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
