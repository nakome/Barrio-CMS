'use strict';

var lightbox = function lightbox() {
  // select all images
  var images = document.querySelectorAll('.zoom');
  var modal = document.createElement('div');
  var close = document.createElement('span');
  var image = document.createElement('img');
  var caption = document.createElement('div');
  // loop
  Array.from(images).forEach(function (img) {
    // on click open modal with image
    img.onclick = function (e) {
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
    close.onclick = function (e) {
      e.preventDefault();
      modal.remove();
    };
  });
};

var lazyLoad = function lazyLoad() {
  // select all images
  var images = document.querySelectorAll('#pageWrapper img');
  // loop images
  [].forEach.call(images, function (img) {
    img.classList.add('loaded');
    // if has data-src remove and set in src
    if (img.getAttribute('data-src')) img.setAttribute('src', img.getAttribute('data-src'));
    // check if link has url
    if (!img.parentElement.classList.contains('isLink')) img.classList.add('zoom');
    // add lightbox
    lightbox();
    // on load images
    img.onload = function () {
      if (img.getAttribute('data-src')) img.removeAttribute('data-src');
    };
  });
};

var toggleMenu = function toggleMenu() {
  var btnmenu = document.querySelector('.mobile-menu a');
  var btnClose = document.querySelector('.closeMenu');
  var menu = document.querySelector('nav#menu');

  btnmenu.addEventListener('click', function (e) {
    return menubar(e);
  });
  btnClose.addEventListener('click', function (e) {
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

var linksFx = function linksFx() {
  var links = document.querySelectorAll('li a');
  var arr = Array.prototype.slice.call(links);
  arr.map(function (item) {
    var old = item.textContent;
    item.addEventListener('mouseover', function () {
      item.classList.add('over');
      item.textContent = '---> ' + old;
    });
    item.addEventListener('mouseout', function () {
      item.classList.remove('over');
      item.textContent = old;
    });
  });
};

/**
 *   @name Loader;
 *   @description Simple progresss bar loader
 */
var loader = function loader(callback) {
  var l = document.querySelector('.loader span'),
      wrapper = document.querySelector('#page'),
      preloader = document.querySelector('.preloader'),

  // start in 0
  num = 0,

  // interval for  num++
  interval = setInterval(function () {
    var n = ++num;
    l.style.width = n + '%';
    // check  in 105
    if (n === 105) {
      n = 0;
      clearInterval(interval);
      if (callback)
        // progress with 0
        l.style.width = n + '%';
      wrapper.style.visibility = 'visible';
      wrapper.style.opacity = '1';
      preloader.style.display = 'none';
      return callback();
    }
  }, 1);
};

document.addEventListener('DOMContentLoaded', function () {
  loader(function () {
    lazyLoad();
    linksFx();
    toggleMenu();
  });
});