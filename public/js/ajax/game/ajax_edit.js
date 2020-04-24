function sendRequest(e,id){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "PUT",
    url: '/game/'+id,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&_method='+$("[name='_method']").val()
          +'&name_game='+$("[name='name_game']").val()
          +'&desc_game='+$("[name='desc_game']").val()
          +'&release_date_game='+$("[name='release_date_game']").val()
          +'&cost_game='+$("[name='cost_game']").val()
          +'&is_multiplayer_game='+$("[name='is_multiplayer_game']").val(),
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
