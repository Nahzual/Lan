function sendRequest(e,id){
  if(e!=null) e.preventDefault();

	// in a copy of the room, rebuild the places array in case some were added/deleted
	// room_copy will replace the content of the json file on the server
	// and room will be used to delete lan_user entries whose place_number has been deleted by the resizing of the room
	var room_copy=JSON.parse(JSON.stringify(room));
	fillRoomPlaces(room_copy);

  $.ajax({
    type: "PUT",
    url: '/lan/'+id,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&_method='+$("[name='_method']").val()
          +'&name='+$("[name='name']").val()
          +'&max_num_registrants='+$("[name='max_num_registrants']").val()
          +'&opening_date='+$("[name='opening_date']").val()
          +'&duration='+$("[name='duration']").val()
          +'&budget='+$("[name='budget']").val()
          +'&num_street='+$("[name='num_street']").val()
          +'&name_street='+$("[name='name_street']").val()
          +'&name_city='+$("[name='name_city']").val()
          +'&zip_city='+$("[name='zip_city']").val()
          +'&name_department='+$("[name='name_department']").val()
          +'&name_country='+$("[name='name_country']").val()
          +'&room_length='+$("[name='room_length']").val()
          +'&room_width='+$("[name='room_width']").val()
					+'&room_with_places='+JSON.stringify(room)
					+'&room='+JSON.stringify(room_copy),
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
