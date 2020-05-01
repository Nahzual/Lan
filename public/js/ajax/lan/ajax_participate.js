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
			error: function(xhr,status,error){
				$('#response-error').show();
				$('#response-success').hide();
				$('#response-error').html("An error occured on the server, please try again later.");
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
      if(data.success != undefined){
				$('#row-player-lan-'+id).html('');
        $('#response-success-player').show();
        $('#response-error-player').hide();
        $('#response-success-player').html(data.success);
      }else{
        $('#response-error-player').show();
        $('#response-success-player').hide();
        $('#response-error-player').html(data.error);
      }
    },
    error: function(xhr,status,error){
      $('#response-error-player').show();
      $('#response-success-player').hide();
      $('#response-error-player').html("An error occured on the server, please try again later.");
    }
  });

  return false;
}
