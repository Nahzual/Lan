function addPlayer(e,id){
  if(e!=null) e.preventDefault();

	if(changeColor.is_player_placed==undefined || changeColor.is_player_placed==false){
		alert('Please choose a place to participate to this LAN.');
	}else{
		var place_number=1;
		while(room.places[place_number][0]!=changeColor.y || room.places[place_number][1]!=changeColor.x){
			console.log('('+changeColor.y+','+changeColor.x+') != ('+room.places[place_number][0]+','+room.places[place_number][1]+')');
			++place_number;
		}

		$.ajax({
			type: "POST",
			url: '/lan/participate/'+id,
			dataType: 'json',
			data: "_token="+$("[name='_token']").val()
						+'&place_number='+place_number
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
