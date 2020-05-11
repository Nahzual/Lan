function closeActivity(activityID){
	popup=document.getElementById("popup-activity-"+activityID);
	popup.style.animationName="out";
	setTimeout(() => { popup.style.display="none"; }, 400);
	window.onclick=function(){};
}

function openActivity(activityID){
	popup=document.getElementById("popup-activity-"+activityID);
	popup.style.animationName="in";
	popup.style.display="block";

	window.onclick = function(event) {
	  if (event.target == popup) {
	    closeActivity(activityID);
	  }
	};
}
