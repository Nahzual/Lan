function closeMaterial(materialID){
	popup=document.getElementById("popup-material-"+materialID);
	popup.style.animationName="out";
	setTimeout(() => { popup.style.display="none"; }, 400);

}

function openMaterial(materialID){
	popup=document.getElementById("popup-material-"+materialID);
	popup.style.animationName="in";
	popup.style.display="block";
}
