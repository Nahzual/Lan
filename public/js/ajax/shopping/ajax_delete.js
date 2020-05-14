function removeShopping(e, lanId, shoppingId){
	if(e!=null) e.preventDefault();
	$.ajax({
		type: "DELETE",
		url: '/lan/'+lanId+'/shopping/'+shoppingId+'/destroy',
		dataType: 'json',
		data: "_token="+$("[name='_token']").val()
		+'&_method='+$("[name='_method']").val(),
		success: function(data){
			var success=$('#response-success-shopping');
			var error=$('#response-error-shopping');
			if(data.success != undefined){
				var budget=parseFloat($('#lan-budget').html().replace(' €',''));
				var remaining_element=$('#lan-shopping-remaining-money');
				var remaining=parseFloat(remaining_element.html().replace(' €',''));

				var total_price_element=$('#lan-totalprice_shopping');
				var total_price=parseFloat(total_price_element.html().replace(' €',''));

				var cost=parseFloat($('#row-shopping-cost-'+shoppingId).html().replace(' €',''));
				var quantity=parseFloat($('#row-shopping-quantity-'+shoppingId).html());

				total_price=(total_price-cost*quantity).toFixed(2);
				remaining=(budget-total_price).toFixed(2);
				total_price_element.html(total_price+' €');
				remaining_element.html(remaining+' €');

				if(remaining>=0){
					remaining_element.removeClass('text-danger');
					remaining_element.addClass('text-success');
				}

				$('#row-shopping-lan-'+shoppingId).remove();
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
			var success=$('#response-success');
			var error=$('#response-error');
			error.show();
			success.hide();
			error.html("An error occured on the server, please try again later.");
		}
	});

	return false;
}
