function sendRequest(e){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "POST",
    url: '/all_lans',
    dataType: 'html',
    data: "_token="+$("[name='_token']").val()
          +'&location='+$("input[name=location]:checked").val()
          +'&date1='+$('[name=date1]').val()
          +'&date2='+$('[name=date2]').val(),
    success: function(html_content){
      $('#lanList').html(html_content);
    },
    error: function(xhr,status,error){
			var success=$('#response-success');
			var error=$('#response-error');
			error.show();
      success.hide();
      error.html("An error occured on the server, please try again later.");
    }
  });

  return false;
}
