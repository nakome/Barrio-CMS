$.fn.goto = function(selector,time){
    this.on('click',function(e){
        console.log('Go to '+$(selector));
        $('html,body').animate({
            scrollTop: (selector) ? $(selector).offset().top : 0
        },time);
    })
}

$(document).ready(function(){

    $('.toTop').goto(null,800);

    $('#goHome').goto('#home',800);

    $(window).scroll(function() {
        if ($(this).scrollTop()) {
            $('.toTop:hidden').stop(true, true).fadeIn();
        } else {
            $('.toTop').stop(true, true).fadeOut();
        }
    });

});