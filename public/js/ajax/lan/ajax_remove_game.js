function removeGame(e,idLan,idGame){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "DELETE",
    url: '/lan/game/'+idLan,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&_method='+'DELETE'
          +'&game_id='+idGame,
    success: function(data){
      if(data.success != undefined){
        $('#response-success-game').show();
        $('#response-error-game').hide();
        $('#response-success-game').html(data.success);
      }else{
        $('#response-error-game').show();
        $('#response-success-game').hide();
        $('#response-error-game').html(data.error);
      }
    },
    error: function(data){
      $('#response-error-game').show();
      $('#response-success-game').hide();
      $('#response-error-game').html("An error occured on the server, please try again later.");
    }
  });

  return false;
}
