function resize(){
  if($(window).width()<=1000){
    $(".changeSize").addClass("col-3");
    $(".changeSize").removeClass("col-1");

    $(".changeSizeButtons").removeClass("col-1");
    $(".changeSizeButtons").addClass("col-2");

    $(".name_game").addClass("col-4");
    $(".name_game").removeClass("col-2");
  }else{
    $(".changeSize").addClass("col-1");
    $(".changeSize").removeClass("col-3");

    $(".changeSizeButtons").removeClass("col-2");
    $(".changeSizeButtons").addClass("col-1");

    $(".name_game").addClass("col-2");
    $(".name_game").removeClass("col-4");
  }
}

$(document).ready(function() {
  resize();
  $(window).resize(resize);
});
