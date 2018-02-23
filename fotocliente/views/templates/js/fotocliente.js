$(document).ready(function(){

    $(".fotocliente_img").click(function(){
       var src = $(this).attr('src');
       var html = "<div id='fotocliente_popup'><img src='"+src+"' ></div>";
       $("body").append($(html).click(function(){
           $(this).remove();
       }));
    });
});