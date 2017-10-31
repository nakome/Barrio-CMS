$.fn.tooggleAccordion = function() {
    $(this).on('click', function(e) {
        if ($(this).find('a').hasClass('active')) {
            $(this).find('a').removeClass('active');
            $(this).next().removeClass('show').addClass('hide');
        } else {
            $(this).find('a').addClass('active');
            $(this).next().removeClass('hide').addClass('show');
        }
    });
}

$.fn.goto = function(selector, time) {
    $(this).on('click', function(e) {
        $('html,body').animate({
            scrollTop: (selector) ? $(selector).offset().top : 0
        }, time);
    })
}

$(document).ready(function() {

    $('.accordion-title').tooggleAccordion();

    $('.toTop').goto(null, 800);

    $('#goHome').goto('#home', 800);

    $(window).scroll(function() {
        if ($(this).scrollTop()) {
            $('.toTop:hidden').stop(true, true).fadeIn();
        } else {
            $('.toTop').stop(true, true).fadeOut();
        }
    });

});