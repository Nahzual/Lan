function sendRequest(e){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "POST",
    url: '/home',
    dataType: 'html',
    data: "_token="+$("[name='_token']").val()
          +'&location='+$("input[name=location]:checked").val()
          +'&date1='+$('[name=date1]').val()
          +'&date2='+$('[name=date2]').val(),
    success: function(html_content){
      $('#lanList').html(html_content);
    },
    error: function(xhr,status,error){
      $('#response-error').show();
      $('#response-success').hide();
      $('#response-error').html("An error occured on the server, please try again later.");
    }
  });

  return false;
}
