function closeGame(gameID){
	popup=document.getElementById("popup-game-"+gameID);
	popup.style.animationName="out";
	setTimeout(() => { popup.style.display="none"; }, 400);
	window.onclick=function(){};
}

function openGame(gameID){
	popup=document.getElementById("popup-game-"+gameID);
	popup.style.animationName="in";
	popup.style.display="block";

	window.onclick = function(event) {
		if (event.target == popup) {
			closeGame(gameID);
		}
	};
}
