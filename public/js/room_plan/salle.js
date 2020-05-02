function startRoom(room_plan){
	drawRoom(room_plan);
	resetRoom(room_plan);
}

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
					switch(room_plan.room.field[i][j]){
						case 1: cell.className = 'cell wall'; break;
						case 2: cell.className = 'cell table'; break;
						case 3: cell.className = 'cell chairNull'; break;
						case 4: cell.className = 'cell chair'; break;
						case 5: cell.className = 'cell null'; break;
					}

					cell.setAttribute('onclick','changeColor('+room_plan.name+', '+i+', '+j+');');
					cell.setAttribute('oncontextmenu','changeAutherColor('+room_plan.name+', '+i+', '+j+'); return false;');
					line.appendChild(cell);
			}
			field.appendChild(line);
	}
}

function resetRoom(room_plan){
	/* Creons le champ, vide */
	room_plan.room.field = new Array();
	for (i = 1; i <= room_plan.settings['lines']; i++) {
			room_plan.room.field[i] = new Array();
			for (j = 1; j <= room_plan.settings['columns']; j++) {
					room_plan.room.field[i][j] = 5;
			}
	}

	/* On definit le status au mode jeu */
	room_plan.room.status = 1;
}

function updateRoom(room_plan){
	for (i = 1; i <= room_plan.settings['lines']; i++) {
			if(room_plan.room.field[i]==undefined){
				room_plan.room.field[i] = new Array();
			}
			for (j = 1; j <= room_plan.settings['columns']; j++) {
				if(room_plan.room.field[i][j]==undefined){
					room_plan.room.field[i][j] = 5;
				}
			}
	}
}

function changeColor(room_plan,y,x){
	/* determiner le numero d'etat de la cellule
	1 : wall
	2 : table
	3 : chairNull ->chaise libre
	4 : chair
	5 : null*/

	// if(room_plan.room.field[x][y]==4){
	// 	document.getElementById('cell-'+x+'-'+y).className = 'cell null';
	// 	document.getElementById('cell-'+x+'-'+y).innerHTML = '';
	// 	room_plan.room.field[x][y] = 5;
	// 	return;
	// }

	if(room_plan.room.field[y][x]==3){
		document.getElementById('cell-'+y+'-'+x).className = 'cell null';
		document.getElementById('cell-'+y+'-'+x).innerHTML = '';
		room_plan.room.field[y][x] = 5;
		return;
	}

	if(room_plan.room.field[y][x]==2){
		document.getElementById('cell-'+y+'-'+x).className = 'cell chairNull';
		document.getElementById('cell-'+y+'-'+x).innerHTML = '';
		room_plan.room.field[y][x] = 3;
		return;
	}

	if(room_plan.room.field[y][x]==1){
		document.getElementById('cell-'+y+'-'+x).className = 'cell table';
		document.getElementById('cell-'+y+'-'+x).innerHTML = '';
		room_plan.room.field[y][x] = 2;
		return;
	}

	if(room_plan.room.field[y][x]==5){
			document.getElementById('cell-'+y+'-'+x).className = 'cell wall';
			document.getElementById('cell-'+y+'-'+x).innerHTML = '';
			room_plan.room.field[y][x] = 1;
			return;
	}
}

function changeAutherColor(room_plan,y,x){
		/* determiner le numero d'etat de la cellule
		1 : wall
		2 : table
		3 : chairNull ->chaise libre
		4 : chair
		5 : null*/


	// if(room_plan.room.field[x][y]==4){
	// 	document.getElementById('cell-'+x+'-'+y).className = 'cell chairNull';
	// 	document.getElementById('cell-'+x+'-'+y).innerHTML = '';
	// 	room_plan.room.field[x][y] = 3;
	// 	return;
	// }
	if(room_plan.room.field[y][x]==3){
		document.getElementById('cell-'+y+'-'+x).className = 'cell table';
		document.getElementById('cell-'+y+'-'+x).innerHTML = '';
		room_plan.room.field[y][x] = 2;
		return;
	}
	if(room_plan.room.field[y][x]==2){
		document.getElementById('cell-'+y+'-'+x).className = 'cell wall';
		document.getElementById('cell-'+y+'-'+x).innerHTML = '';
		room_plan.room.field[y][x] = 1;
		return;
	}
	if(room_plan.room.field[y][x]==1){
		document.getElementById('cell-'+y+'-'+x).className = 'cell null';
		document.getElementById('cell-'+y+'-'+x).innerHTML = '';
		room_plan.room.field[y][x] = 5;
		return;
	}

	if(room_plan.room.field[y][x]==5){
		document.getElementById('cell-'+y+'-'+x).className = 'cell chairNull';
		document.getElementById('cell-'+y+'-'+x).innerHTML = '';
		room_plan.room.field[y][x] = 3;
		return;
	}
}

function changeDimensions(room_plan){
	x=$('[name=room_width]').val();
	y=$('[name=room_length]').val();

	if(x!=undefined && y!=undefined && x!='' && y!=''){
		room_plan.settings.lines=y;
		room_plan.settings.columns=x;
		updateRoom(room_plan);
		drawRoom(room_plan);
	}
}

// build the list of the room's chairs
function fillRoomPlaces(room){
	room.places=new Array();
	var i=1;
	for(var y = 1; y <= room.settings.lines; ++y){
		for(var x = 1; x <= room.settings.columns; ++x){
			if(room.room.field[y][x]==3 || room.room.field[y][x]==4){
				room.places[i]=new Array();
				room.places[i].push(y);
				room.places[i].push(x);
				++i;
			}
		}
	}

}
