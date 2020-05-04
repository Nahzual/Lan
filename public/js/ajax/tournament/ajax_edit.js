function sendRequest(e,lanId,tournamentId){
	if(e!=null) e.preventDefault();

	$.ajax({
		type: "PUT",
		url: '/lan/'+lanId+'/tournament/'+tournamentId+'/edit',
		dataType: 'json',
		data: "_token="+$("[name='_token']").val()
		+'&_method='+$("[name='_method']").val()
		+'&name_tournament='+$("[name='name_tournament']").val()
		+'&desc_tournament='+$("[name='desc_tournament']").val()
		+'&opening_date_tournament='+$("[name='opening_date_tournament']").val()
		+'&max_player_count_tournament='+$("[name='max_player_count_tournament']").val()
		+'&match_mod_tournament='+$("[name='match_mod_tournament']").val()
		+'&id_game='+$("[name='id_game']").val(),

		success: function(data){
			if(data.success != undefined){
				$('#response-success').show();
				$('#response-error').hide();
				$('#response-success').html(data.success);
			}else{
				$('#response-error').show();
				$('#response-success').hide();
				$('#response-error').html(data.error);
			}
		},
		error: function(data){
			$('#response-error').show();
			$('#response-success').hide();
			$('#response-error').html("An error occured on the server, please try again later.");
		}
	});

	return false;
}
