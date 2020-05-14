function addPlayer(e,id){
  if(e!=null) e.preventDefault();

	if(changeColor.is_player_placed==undefined || changeColor.is_player_placed==false){
		alert('Please choose a place to participate to this LAN.');
	}else{
		$.ajax({
			type: "POST",
			url: '/lan/participate/'+id,
			dataType: 'json',
			data: "_token="+$("[name='_token']").val()
						+'&place_number_x='+changeColor.x
						+'&place_number_y='+changeColor.y
						+'&new_room='+JSON.stringify(room),
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

// this function is used when a player chooses to quit a LAN
function removePlayer(e,id){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "DELETE",
    url: '/lan/participate/'+id,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val(),
    success: function(data){
			var success=$('#response-success-player');
			var error=$('#response-error-player');
      if(data.success != undefined){
				$('#row-player-lan-'+id).html('');
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
			var success=$('#response-success-player');
			var error=$('#response-error-player');
      error.show();
      success.hide();
      error.html("An error occured on the server, please try again later.");
    }
  });

  return false;
}

// this function is used when a LAN admin removes a player from a LAN
function removePlayerLAN(e,idLan,idPlayer){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "DELETE",
    url: '/lan/participate/'+idLan,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
					+"&player_id="+idPlayer,
    success: function(data){
			var success=$('#response-success-player');
			var error=$('#response-error-player');
      if(data.success != undefined){
				$('#row-player-lan-'+idPlayer).html('');
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
			var success=$('#response-success-player');
			var error=$('#response-error-player');
      error.show();
      success.hide();
      error.html("An error occured on the server, please try again later.");
    }
  });

  return false;
}
