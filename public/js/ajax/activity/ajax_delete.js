function removeActivity(e, lanId, activityId){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "DELETE",
    url: '/lan/'+lanId+'/activity/'+activityId+'/destroy',
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&_method='+$("[name='_method']").val(),
    success: function(data){
      if(data.success != undefined){
				$('#row-activity-lan-'+activityId).html('');
        $('#response-success-activity').show();
        $('#response-error-activity').hide();
        $('#response-success-activity').html(data.success);
      }else{
        $('#response-error-activity').show();
        $('#response-success-activity').hide();
        $('#response-error-activity').html(data.error);
      }
    },
    error: function(data){
      $('#response-error-activity').show();
      $('#response-success-activity').hide();
      $('#response-error-activity').html("An error occured on the server, please try again later.");
    }
  });

  return false;
}
