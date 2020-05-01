function sendRequest(e,id){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "PUT",
    url: '/lan/'+id,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()
          +'&_method='+$("[name='_method']").val()
          +'&name='+$("[name='name']").val()
          +'&max_num_registrants='+$("[name='max_num_registrants']").val()
          +'&opening_date='+$("[name='opening_date']").val()
          +'&duration='+$("[name='duration']").val()
          +'&budget='+$("[name='budget']").val()
          +'&num_street='+$("[name='num_street']").val()
          +'&name_street='+$("[name='name_street']").val()
          +'&name_city='+$("[name='name_city']").val()
          +'&zip_city='+$("[name='zip_city']").val()
          +'&name_department='+$("[name='name_department']").val()
          +'&name_country='+$("[name='name_country']").val()
          +'&room_length='+$("[name='room_length']").val()
          +'&room_width='+$("[name='room_width']").val()
					+'&room='+JSON.stringify(room),
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
