(function($){
  
  $(function(){

    $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();
        if(scroll >= $(".banner-container").height()-100)
        {
            $(".nav-bar").removeClass("nav-bar-transparent");
            //$(".nav-bar").addClass("deep-orange darken-3");
        }
        else
        {
            //$(".nav-bar").removeClass("deep-orange darken-3");
            $(".nav-bar").addClass("nav-bar-transparent");
        }
    });

  }); // end of document ready


})(jQuery); // end of jQuery name space


