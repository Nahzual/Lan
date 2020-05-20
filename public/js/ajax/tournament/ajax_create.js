function changementType() {
	var match_mod_tournament = document.getElementById("match_mod_tournament").value;
	var div = document.getElementById("number");
	if (match_mod_tournament == "1") {
		div.style="display:block";
	} else {
		div.style="display:none";
	}
}
