function documentReady(){
	room=JSON.parse($('[name=room_plan]').val());
	changeDimensions(room);
}

var room;
$('document').ready(documentReady);
