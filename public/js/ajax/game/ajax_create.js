function sendRequest(e){
	e.preventDefault();
	$.ajaxSetup({
		headers:{
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		url: "/game",
		method: 'post',
		dataType: 'json',
		data: {
			name_game: $('#name_game').val(),
			desc_game: $('#desc_game').val(),
			release_date_game: $('#release_date_game').val(),
			cost_game: $('#cost_game').val(),
			is_multiplayer_game: $('#is_multiplayer_game').val(),
		},
		success: function(result){
			if(result.success!=undefined){
				$('#response-success').show();
				$('#response-error').hide();
				$('#response-success').html(result.success);
			}else{
				$('#response-error').show();
				$('#response-success').hide();
				$('#response-error').html(result.error);
			}
		},
		error: function(xhr, error, status){
			$('#response-error').show();
			$('#response-success').hide();
			$('#response-error').html(result.error);
		}
	});
}
