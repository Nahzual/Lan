function sendRequest(e,id){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "PUT",
    url: '/lan/'+id,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val()+'&_method='+$("[name='_method']").val()+'&name='+$("[name='name']").val()+'&max_num_registrants='+$("[name='max_num_registrants']").val()+'&opening_date='+$("[name='opening_date']").val()+'&duration='+$("[name='duration']").val()+'&budget='+$("[name='budget']").val(),
    success: function(data){
      if(data.success!=""){
        $('#response-success').show();
        $('#response-success').html(data.success);
      }else{
        $('#response-error').show();
        $('#response-error').html(data.error);
      }
    },
    error: function(data){
      
    }
  });

  return false;
}
