(function($){
  
  
  $(function(){
    //initialize sidebar pushpin
    //$('.left-side-nav').pushpin({ top: $('.main-container').offset().top,offset: $(".nav-bar").height()+20 });
    $(".left-side-nav").height($(".main-container").height());
    onElementHeightChange($(".main-content")[0], function(){
        $(".left-side-nav").height($(".main-container").height());
    });
    //initialize modal triggers
    $('.modal-trigger').leanModal({
      opacity: .7, // Opacity of modal background
    });

    $(".team-name").on("click",function(){
        var gameid = $(this).data("gameid");
        if($(".game-players-"+gameid).is(":hidden"))
        {
            $(".game-players-"+gameid).fadeIn(600);
        }
        else
        {
            $(".game-players-"+gameid).hide();
        }
        
    });

  }); // end of document ready


})(jQuery); // end of jQuery name space

function onElementHeightChange(elm, callback){
    var lastHeight = elm.clientHeight, newHeight;
    (function run(){
        newHeight = elm.clientHeight;
        if( lastHeight != newHeight )
            callback();
        lastHeight = newHeight;

        if( elm.onElementHeightChangeTimer )
            clearTimeout(elm.onElementHeightChangeTimer);

        elm.onElementHeightChangeTimer = setTimeout(run, 200);
    })();
}
