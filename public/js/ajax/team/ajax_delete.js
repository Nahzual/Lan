function removeTeam(e, lanId, teamId){
  if(e!=null) e.preventDefault();

	if(confirm("Do you really want to delete this team ?")){
	  $.ajax({
	    type: "DELETE",
	    url: '/tournament/'+tournamentId+'/team/'+teamId+'/destroy',
	    dataType: 'json',
	    data: "_token="+$("[name='_token']").val()
	          +'&_method='+$("[name='_method']").val(),
	    success: function(data){
	      if(data.success != undefined){
					$('#row-team-lan-'+teamId).html('');
	        $('#response-success-team').show();
	        $('#response-error-team').hide();
	        $('#response-success-team').html(data.success);
	      }else{
	        $('#response-error-team').show();
	        $('#response-success-team').hide();
	        $('#response-error-team').html(data.error);
	      }
	    },
	    error: function(data){
	      $('#response-error-team').show();
	      $('#response-success-team').hide();
	      $('#response-error-team').html("An error occured on the server, please try again later.");
	    }
	  });
	}

  return false;
}
