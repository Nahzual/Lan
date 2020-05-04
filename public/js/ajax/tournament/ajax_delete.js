function removeTournament(e, lanId, tournamentId){
  if(e!=null) e.preventDefault();

	if(confirm("Do you really want to delete this tournament ?")){
	  $.ajax({
	    type: "DELETE",
	    url: '/lan/'+lanId+'/tournament/'+tournamentId+'/destroy',
	    dataType: 'json',
	    data: "_token="+$("[name='_token']").val()
	          +'&_method='+$("[name='_method']").val(),
	    success: function(data){
	      if(data.success != undefined){
					$('#row-tournament-lan-'+tournamentId).html('');
	        $('#response-success-tournament').show();
	        $('#response-error-tournament').hide();
	        $('#response-success-tournament').html(data.success);
	      }else{
	        $('#response-error-tournament').show();
	        $('#response-success-tournament').hide();
	        $('#response-error-tournament').html(data.error);
	      }
	    },
	    error: function(data){
	      $('#response-error-tournament').show();
	      $('#response-success-tournament').hide();
	      $('#response-error-tournament').html("An error occured on the server, please try again later.");
	    }
	  });
	}

  return false;
}
