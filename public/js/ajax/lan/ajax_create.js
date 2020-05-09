function sendRequest(e){
	e.preventDefault();

	fillRoomPlaces(room);

	$.ajaxSetup({
		headers:{
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		url: '/lan',
		method: 'post',
		data: {
			name: $('#name').val(),
			max_num_registrants: $('#max_num_registrants').val(),
			opening_date: $('#opening_date').val(),
			duration: $('#duration').val(),
			budget: $('#budget').val(),
			num_location: $('#num_location').val(),
			name_street: $('#name_street').val(),
			name_city: $('#name_city').val(),
			zip_city: $('#zip_city').val(),
			name_department: $('#name_department').val(),
			name_country: $('#name_country').val(),
      room_width: $('#room_width').val(),
      room_length: $('#room_length').val(),
			room: JSON.stringify(room)
		},
		success: function(result){
			var success=$('#response-success');
			var error=$('#response-error');
			if(result.success!=undefined){
				success.show();
				error.hide();
				success.html(result.success);
			}else{
				error.show();
				success.hide();
				error.html(result.error);
			}
		},
		error: function(xhr,error,status){
			var success=$('#response-success');
			var error=$('#response-error');
			error.show();
      success.hide();
      error.html("An error occured on the server, please try again later.");
		}
	});
}
