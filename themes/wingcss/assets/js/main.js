var tooggleAccordion = function() {
    var elements = document.querySelectorAll('.accordion-title');
    Array.from(elements).forEach(function(item) {
        item.querySelector('a').addEventListener('click', function() {
            if (item.querySelector('a').classList.contains('active')) {
                item.querySelector('a').classList.remove('active');
                item.nextElementSibling.classList.remove('show');
                item.nextElementSibling.classList.add('hide');
            } else {
                item.querySelector('a').classList.add('active');
                item.nextElementSibling.classList.add('show');
                item.nextElementSibling.classList.remove('hide');
            }
        });
    });
}

tooggleAccordion();


var images = document.querySelectorAll('img');
var imgLoad = imagesLoaded(images);
imgLoad.on('progress', function(instance, image) {
    if (image.isLoaded) {
        // cualquier cosa....
    }
    if (!image.isLoaded) {
        // si la imagen no se carga se pondra
        // el logo en su vez
        image.img.src = assets + '/img/logo.svg';
    }
});


var navigation = function() {
    var nav = document.querySelector('#navigation');
    var navOpen = document.querySelector('#nav-open');
    var navClose = document.querySelector('#nav-close');
    navOpen.addEventListener('click', function() {
        document.body.style.overflow = 'hidden';
        nav.classList.add('show-navigation');
    });
    navClose.addEventListener('click', function() {
        nav.classList.add('hide-navigation');
        var wait = setTimeout(function(){
            document.body.style.overflow = 'auto';
            nav.classList.remove('hide-navigation');
            nav.classList.remove('show-navigation');
            clearTimeout(wait);
        },800);
    });
}

navigation();