'use strict';

var lightbox = function lightbox() {
    // select all images
    var images = document.querySelectorAll('.zoom');
    var modal = document.createElement('div');
    var close = document.createElement('span');
    var image = document.createElement('img');
    var caption = document.createElement('div');
    // loop
    Array.from(images).forEach(function(img) {
        // on click open modal with image
        img.onclick = function(e) {
            e.preventDefault();
            // create modal
            modal.id = 'lightbox';
            modal.className = 'lightbox';
            // create close
            close.className = 'lightbox-close';
            close.innerHTML = '<img src="' + assets + '/img/close.svg">';
            // create image
            image.className = 'lightbox-content';
            // create caption
            caption.className = 'lightbox-caption';
            // append modal
            document.body.appendChild(modal);
            // append inside modal all
            modal.appendChild(close);
            modal.appendChild(image);
            modal.appendChild(caption);
            image.src = this.src;
            caption.innerHTML = this.alt;
        };
        // close on click
        close.onclick = function(e) {
            e.preventDefault();
            modal.remove();
        };
    });
};





var images = document.querySelectorAll('#pageWrapper img');
var imgLoad = imagesLoaded(images);
imgLoad.on('progress', function(instance, image) {
    if (image.isLoaded) {
        image.img.classList.add('zoom');
        lightbox();
    }
    if (!image.isLoaded) {
        image.img.src = assets + '/img/logo.svg';
    }
});


var toggleMenu = function toggleMenu() {
    var btnmenu = document.querySelector('.mobile-menu a');
    var btnClose = document.querySelector('.closeMenu');
    var menu = document.querySelector('nav#menu');

    btnmenu.addEventListener('click', function(e) {
        return menubar(e);
    });
    btnClose.addEventListener('click', function(e) {
        return menubar(e);
    });

    function menubar(e) {
        e.preventDefault();
        menu.classList.toggle('show');
        if (menu.classList.contains('show')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = 'auto';
        }
    }
};

/**
 *   @name Loader;
 *   @description Simple progresss bar loader
 */
var loader = function loader(callback) {
    var l = document.querySelector('.loader span'),
        wrapper = document.querySelector('#page'),
        preloader = document.querySelector('.preloader'),
        obj = { charged: '0%' },
        JSobject = anime({
          targets: obj,
          charged: '100%',
          round: 1,
          easing: 'linear',
          update: function() {
              l.style.width = obj.charged;
              // check  in 105
              if (obj.charged === '100%') {
                  obj.charged = '0%';
                  if (callback){
                    // progress with 0
                    l.style.width = obj.charged;

                    var preloadfx = anime({
                      targets: '.preloader',
                      scale: {
                        value: '+=1',
                        duration: 300
                      },
                      direction: 'alternate'
                    });

                    preloadfx.finished.then(function(){
                      wrapper.style.visibility = 'visible';
                      wrapper.style.opacity = '1';
                      wrapper.style.transition = 'all 1s ease';
                      preloader.style.display = 'none';
                      return callback();
                    });
                  }
              }
          }
        });
};



var tooggleAccordion = function(){
   var elements = document.querySelectorAll('.accordion-title');
   Array.from(elements).forEach(function(item){
      item.querySelector('a').addEventListener('click',function(){
        if(item.querySelector('a').classList.contains('active')){
          item.querySelector('a').classList.remove('active');
          item.nextElementSibling.classList.remove('show');
          item.nextElementSibling.classList.add('hide');
        }else{
          item.querySelector('a').classList.add('active');
          item.nextElementSibling.classList.add('show');
          item.nextElementSibling.classList.remove('hide');
        }
      });
   });
}





document.addEventListener('DOMContentLoaded', function() {
    loader(function() {
        toggleMenu();
        tooggleAccordion();
    });
});