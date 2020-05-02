function searchMaterials(e,lanID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "GET",
    url: '/search/material/',
    dataType: 'html',
    data: "_token="+$("[name='_token']").val()
          +'&name_material='+$("[name='name_material']").val()
          +'&view_path='+$('[name=view_path]').val()
          +'&lan_id='+lanID,
    success: function(data){
      $('#request-result').html(data);
    },
    error: function(xhr,status,error){
      $('#response-error').show();
      $('#response-success').hide();
      $('#response-error').html("An error occured on the server, please try again later.");
    }
  });

  return false;
}

function addMaterial(e,lanID,materialID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "POST",
    url: '/lan/material/'+lanID,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&material_id='+materialID
					+'&quantity='+$("[name='quantity-"+materialID+"']").val(),
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
