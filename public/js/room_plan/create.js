var room = {
    name: 'room',

    settings: {
      lines: 0,
      columns: 0,
    },

    room: {
        status: 0,
        field: new Array(),
    },

    initialise: function() {
        this.startRoom();
    },

    startRoom: function() { //on passera les mesures à startRoom qui seront mises dans setting avec :
        room.drawRoom();
        room.resetRoom();
    },

    drawRoom: function() {

        board = $('#plateau');
        board.html('');

        $('#result').html('');

        border = document.createElement('table');
        border.setAttribute('oncontextmenu', 'return false;');
        field = document.createElement('tbody');
        border.appendChild(field);
        border.className = 'field';

        board.append(border);

        for (i = 1; i <= this.settings['lines']; i++) {
            line = document.createElement('tr');

            for (j = 1; j <= this.settings['columns']; j++) {
                cell = document.createElement('td');
                cell.id = 'cell-'+i+'-'+j;
                switch(this.room.field[i][j]){
									case 1: cell.className = 'cell wall'; break;
									case 2: cell.className = 'cell table'; break;
									case 3: cell.className = 'cell chairNull'; break;
									case 4: cell.className = 'cell chair'; break;
									case 5: cell.className = 'cell null'; break;
								}

                cell.setAttribute('onclick', this.name+'.changeColor('+i+', '+j+', true);');
                cell.setAttribute('oncontextmenu', this.name+'.changeAutherColor('+i+', '+j+'); return false;');
                line.appendChild(cell);
            }
            field.appendChild(line);
        }
    },

    resetRoom: function() {

        /* Creons le champ, vide */
        this.room.field = new Array();
        for (i = 1; i <= this.settings['lines']; i++) {
            this.room.field[i] = new Array();
            for (j = 1; j <= this.settings['columns']; j++) {
                this.room.field[i][j] = 5;
            }
        }

        /* On definit le status au mode jeu */
        this.room.status = 1;
    },

		changeSize: function() {
				/* Creons le champ, vide */
				for (i = 1; i <= this.settings['lines']; i++) {
						if(this.room.field[i]==undefined){
							this.room.field[i] = new Array();
						}
						for (j = 1; j <= this.settings['columns']; j++) {
							if(this.room.field[i][j]==undefined){
								this.room.field[i][j] = 5;
							}
						}
				}
		},

    changeColor: function(x, y, check) {

        /* Verifie si le jeu est en fonctionnement*/
        //if (this.room.status != 1)
          //  return;

        /* determiner le numero d'etat de la cellule
        1 : wall
        2 : table
        3 : chairNull ->chaise libre
        4 : chair
        5 : null*/

        if(this.room.field[x][y]==4){
          document.getElementById('cell-'+x+'-'+y).className = 'cell null';
          document.getElementById('cell-'+x+'-'+y).innerHTML = '';
          this.room.field[x][y] = 5;
          return;
        }
        if(this.room.field[x][y]==3){
          document.getElementById('cell-'+x+'-'+y).className = 'cell chair';
          document.getElementById('cell-'+x+'-'+y).innerHTML = '';
          this.room.field[x][y] = 4;
          return;
        }
        if(this.room.field[x][y]==2){
          document.getElementById('cell-'+x+'-'+y).className = 'cell chairNull';
          document.getElementById('cell-'+x+'-'+y).innerHTML = '';
          this.room.field[x][y] = 3;
          return;
        }
        if(this.room.field[x][y]==1){
          document.getElementById('cell-'+x+'-'+y).className = 'cell table';
          document.getElementById('cell-'+x+'-'+y).innerHTML = '';
          this.room.field[x][y] = 2;
          return;
        }
        else {
            document.getElementById('cell-'+x+'-'+y).className = 'cell wall';
            document.getElementById('cell-'+x+'-'+y).innerHTML = '';
            this.room.field[x][y] = 1;
            return;
        }

    },

    changeAutherColor: function(x, y, check) {

          /* determiner le numero d'etat de la cellule
          1 : wall
          2 : table
          3 : chairNull ->chaise libre
          4 : chair
          5 : null*/


        if(this.room.field[x][y]==4){
          document.getElementById('cell-'+x+'-'+y).className = 'cell chairNull';
          document.getElementById('cell-'+x+'-'+y).innerHTML = '';
          this.room.field[x][y] = 3;
          return;
        }
        if(this.room.field[x][y]==3){
          document.getElementById('cell-'+x+'-'+y).className = 'cell table';
          document.getElementById('cell-'+x+'-'+y).innerHTML = '';
          this.room.field[x][y] = 2;
          return;
        }
        if(this.room.field[x][y]==2){
          document.getElementById('cell-'+x+'-'+y).className = 'cell wall';
          document.getElementById('cell-'+x+'-'+y).innerHTML = '';
          this.room.field[x][y] = 1;
          return;
        }
        if(this.room.field[x][y]==1){
          document.getElementById('cell-'+x+'-'+y).className = 'cell null';
          document.getElementById('cell-'+x+'-'+y).innerHTML = '';
          this.room.field[x][y] = 5;
          return;
        }
        else {
            document.getElementById('cell-'+x+'-'+y).className = 'cell chair';
            document.getElementById('cell-'+x+'-'+y).innerHTML = '';
            this.room.field[x][y] = 4;
            return;
        }

    },
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
