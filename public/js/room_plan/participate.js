function documentReady(){
	room=JSON.parse($('[name=room_plan]').val());
	drawRoom(room);
}

var room;
$('document').ready(documentReady);


function drawRoom(room_plan){
	board = $('#plateau');
	board.html('');

	$('#result').html('');

	border = document.createElement('table');
	border.setAttribute('oncontextmenu', 'return false;');
	field = document.createElement('tbody');
	border.appendChild(field);
	border.className = 'field table table-bordered table-dark table-responsive';

	board.append(border);

	for (i = 1; i <= room_plan.settings['lines']; i++) {
			line = document.createElement('tr');

			for (j = 1; j <= room_plan.settings['columns']; j++) {
					cell = document.createElement('td');
					cell.id = 'cell-'+i+'-'+j;
					if(changeColor.is_player_placed && i==changeColor.y && j==changeColor.x){
						cell.className = 'cell user';
					}else{
						switch(room_plan.room.field[i][j]){
							case 1: cell.className = 'cell wall'; break;
							case 2: cell.className = 'cell table'; break;
							case 3: cell.className = 'cell chairNull'; break;
							case 4: cell.className = 'cell chair'; break;
							case 5: cell.className = 'cell null'; break;
							default: break;
						}
					}

					// if(room_plan.room.field[i][j]==3 || room_plan.room.field[i][j]==4){
					// 	for(var k=1 ; k <= room_plan.places.length; ++k){
					// 		if(room_plan.places[k][1]==i && room_plan.places[k][2]==j){
					// 			cell.innerHTML=k;
					// 			break;
					// 		}
					// 	}
					// }



					cell.setAttribute('onclick','changeColor('+room_plan.name+', '+i+', '+j+');');
					cell.setAttribute('oncontextmenu','changeAutherColor('+room_plan.name+', '+i+', '+j+'); return false;');
					line.appendChild(cell);
			}
			field.appendChild(line);
	}
}

function changeColor(room_plan,y,x){
	/* determiner le numero d'etat de la cellule
	3 : chairNull ->chaise libre
	4 : chair
	5 : null*/

	if(changeColor.is_player_placed==undefined && changeColor.x==undefined && changeColor.y==undefined && changeColor.prevState==undefined){
		changeColor.is_player_placed=false;
		changeColor.x=0;
		changeColor.y=0;
	}

	if(!changeColor.is_player_placed && room_plan.room.field[y][x]==3){
		changeColor.x=x;
		changeColor.y=y;
		console.log('placed at ('+y+','+x+')');
		changeColor.is_player_placed=true;

		document.getElementById('cell-'+y+'-'+x).className = 'cell user';
		document.getElementById('cell-'+y+'-'+x).innerHTML = '';
		room_plan.room.field[y][x] = 4;

	}else if(changeColor.is_player_placed && room_plan.room.field[y][x]==4 && x==changeColor.x && y==changeColor.y){
		document.getElementById('cell-'+y+'-'+x).className = 'cell chairNull';
		document.getElementById('cell-'+y+'-'+x).innerHTML = '';
		room_plan.room.field[y][x] = 3;
		changeColor.is_player_placed=false;
	}else if(room_plan.room.field[y][x]==3){
		alert('You can only choose one place.');
	}else{
		alert('You can\'t choose this place.');
	}
}
