function removeTeam(e, tournamentId, teamId){
  if(e!=null) e.preventDefault();

	if(confirm("Do you really want to delete this team ?")){
	  $.ajax({
	    type: "DELETE",
	    url: '/tournament/'+tournamentId+'/team/'+teamId+'/destroy',
	    dataType: 'json',
      data: "_token="+$("[name='_token']").val()
	          +'&_method='+$("[name='_method']").val(),
	    success: function(data){
				var success=$('#response-success-team');
				var error=$('#response-error-team');
	      if(data.success != undefined){
					$('#row-team-lan-'+teamId).html('');
	        success.show();
	        error.hide();
	        success.html(data.success);
	      }else{
	        error.show();
	        success.hide();
	        error.html(data.error);
	      }
	    },
	    error: function(data){
				var success=$('#response-success-team');
				var error=$('#response-error-team');
	      error.show();
	      success.hide();
	      error.html("An error occured on the server, please try again later.");
	    }
	  });
	}
  return false;
}
