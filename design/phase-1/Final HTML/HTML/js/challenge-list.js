(function($){
  
  $(function(){

    $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();
        if(scroll >= 100)
        {
            $(".nav-bar").removeClass("blue-grey darken-4");
            //$(".nav-bar").addClass("deep-orange darken-3");
        }
        else
        {
            //$(".nav-bar").removeClass("deep-orange darken-3");
            $(".nav-bar").addClass("blue-grey darken-4");
        }
    });

    $(".game-banner").hover(
        function() {
            $( this ).stop().animate({
                height: "200px"
            },500);
        }, function() {
             $( this ).stop().animate({
                height: "130px"
            },500);
        }
    );

    $('select').material_select();

  }); // end of document ready


})(jQuery); // end of jQuery name space
