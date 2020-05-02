function deleteShopping(e,shoppingID){
  if(e!=null) e.preventDefault();

	if(confirm("Do you really want to delete this shopping ?")){
		$.ajax({
			type: "DELETE",
			url: '/shopping/'+shoppingID,
			dataType: 'json',
			data: "_token="+$("[name='_token']").val(),
			success: function(data){
				if(data.success != undefined){
					$('#row-shopping-'+shoppingID).html('');
					$('#response-success').show();
					$('#response-error').hide();
					$('#response-success').html(data.success);
				}else{
					$('#response-error').show();
					$('#response-success').hide();
					$('#response-error').html(data.error);
				}
			},
			error: function(xhr,status,error){
			$('#response-error').show();
			$('#response-success').hide();
			$('#response-error').html("An error occured on the server, please try again later.");
			}
		});
	}
	return false;
}

function searchShoppings(e){
	if(e!=null) e.preventDefault();

	$.ajax({
		type: "GET",
		url: '/search/shopping/',
		dataType: 'html',
		data: "_token="+$("[name='_token']").val()
			+'&name_shopping='+$("[name='name_shopping']").val()
			+'&view_path='+$('[name=view_path]').val(),
		success: function(data){
			$('#request-result').html(data);
		},
		error: function(xhr,status,error){
			$('#response-error').show();
			$('#response-success').hide();
			$('#response-error').html("An error occured on the server, please try again later.");
		}
	});

	return false;
}
