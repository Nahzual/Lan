function searchHelper(e,lanID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "GET",
    url: '/search/user/',
    dataType: 'html',
    data: "_token="+$("[name='_token']").val()
          +'&pseudo='+$("[name='pseudo']").val()
          +'&lan_id='+lanID
          +'&view_path='+$('[name=view_path]').val(),
    success: function(data){
      $('#requestResult').html(data);
    },
    error: function(xhr,status,error){

    }
  });

  return false;
}

function addHelper(e,lanID,helperID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "POST",
    url: '/lan/helper/'+lanID,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&id_user='+helperID,
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

function removeHelper(e,lanID,helperID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "DELETE",
    url: '/lan/helper/'+lanID,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&id_user='+helperID,
    success: function(data){
      if(data.success != undefined){
        $('#response-success-helper').show();
        $('#response-success-helper').html(data.success);
      }else{
        $('#response-error-helper').show();
        $('#response-error-helper').html(data.error);
      }
    },
    error: function(xhr,status,error){

    }
  });

  return false;
}
