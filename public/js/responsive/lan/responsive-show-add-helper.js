function resize(){
  if($(window).width()<=1000){
    $(".changeSize").addClass("col-6");
    $(".changeSize").removeClass("col-4");
  }else{
    $(".changeSize").addClass("col-4");
    $(".changeSize").removeClass("col-6");
  }
}

$(document).ready(function() {
  resize();
  $(window).resize(resize);
});
