var room = {
    name: 'room',

		// dimensions of the room
    settings: {
      lines: 0,
      columns: 0,
    },

		// an array containing all the room slots
    room: {
        status: 0,
        field: new Array(),
    },

		// an array containing the coordinates in room.field of each chair of the room
		places: new Array(),
};

function changeDimensions(){
	x=$('[name=room_width]').val();
	y=$('[name=room_length]').val();

	if(x!=undefined && y!=undefined && x!='' && y!=''){
		room.settings.lines=y;
		room.settings.columns=x;
		updateRoom(room);
		drawRoom(room);
	}
}

function documentReady(){
	startRoom(room);
}

$('document').ready(documentReady);
