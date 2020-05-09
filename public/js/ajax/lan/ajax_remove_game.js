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
			var success=$('#response-success-game');
			var error=$('#response-error-game');
      if(data.success != undefined){
				$('#row-game-lan-'+idGame).html('');
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
			var success=$('#response-success-game');
			var error=$('#response-error-game');
      error.show();
      success.hide();
      error.html("An error occured on the server, please try again later.");
    }
  });

  return false;
}
