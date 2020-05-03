function sendRequest(e,id){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "PUT",
    url: '/material/'+id,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&_method='+$("[name='_method']").val()
          +'&name_material='+$("[name='name_material']").val()
          +'&desc_material='+$("[name='desc_material']").val(),
    success: function(data){
      if(data.success != undefined){
        $('#response-success').show();
        $('#response-error').hide();
        $('#response-success').html(data.success);
      }else{
        $('#response-error').show();
        $('#response-success').hide();
        $('#response-error').html(data.error);
      }
    },
    error: function(data){
      $('#response-error').show();
      $('#response-success').hide();
      $('#response-error').html("An error occured on the server, please try again later.");
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
      if(data.success != undefined){
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
