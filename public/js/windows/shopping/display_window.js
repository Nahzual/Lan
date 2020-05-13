function closeShopping(shoppingID){
	popup=document.getElementById("popup-shopping-"+shoppingID);
	popup.style.animationName="out";
	setTimeout(() => { popup.style.display="none"; }, 400);
	window.onclick=function(){};
}

function openShopping(shoppingID){
	popup=document.getElementById("popup-shopping-"+shoppingID);
	popup.style.animationName="in";
	popup.style.display="block";

	window.onclick = function(event) {
	  if (event.target == popup) {
	    closeShopping(shoppingID);
	  }
	};
}
