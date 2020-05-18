function sendRequest(e){
	e.preventDefault();

	var file=$('#file')[0].files[0];
	var formData=new FormData();
	formData.append("file",file);
	formData.append("name",$('#name').val());
	formData.append("lastname",$('#lastname').val());
	formData.append("email",$('#email').val());
	formData.append("object",$('#object').val());
	formData.append("description",$('#description').val());

	e.preventDefault();
	$.ajaxSetup({
		headers:{
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		url: "/contact",
		method: 'post',
		data: formData,
		contentType: false,
		processData: false,
		success: function(result){
			if(result.success!=undefined){
				$('#response-success').show();
				$('#response-success').html(result.success);
			}else{
				$('#response-error').show();
				$('#response-error').html(result.error);
			}
		}
	});
	return false;
}
