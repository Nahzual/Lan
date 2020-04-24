function addGameToFavourite(e,gameID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "POST",
    url: '/game/favourite/'+gameID,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val(),
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
    error: function(xhr,status,error){
      $('#response-error').show();
      $('#response-success').hide();
      $('#response-error').html("An error occured on the server, please try again later.");
    }
  });

  return false;
}

function removeGameFromFavourite(e,gameID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "DELETE",
    url: '/game/favourite/'+gameID,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val(),
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
    error: function(xhr,status,error){
      $('#response-error').show();
      $('#response-success').hide();
      $('#response-error').html("An error occured on the server, please try again later.");
    }
  });

  return false;
}

function deleteGame(e,gameID){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "DELETE",
    url: '/game/'+gameID,
    dataType: 'json',
    data: "_token="+$("[name='_token']").val(),
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
    error: function(xhr,status,error){
      $('#response-error').show();
      $('#response-success').hide();
      $('#response-error').html("An error occured on the server, please try again later.");
    }
  });

  return false;
}

function searchGames(e){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "GET",
    url: '/search/game/',
    dataType: 'html',
    data: "_token="+$("[name='_token']").val()
          +'&name_game='+$("[name='name_game']").val()
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

function searchFavouriteGames(e){
  if(e!=null) e.preventDefault();

  $.ajax({
    type: "GET",
    url: '/search/game/',
    dataType: 'html',
    data: "_token="+$("[name='_token']").val()
          +'&name_game='+$("[name='name_game']").val()
          +'&view_path='+$('[name=view_path]').val()
          +'&favourite='+true,
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
