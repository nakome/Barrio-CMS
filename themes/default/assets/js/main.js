const lightbox = () =>{
  // select all images
  let images = document.querySelectorAll('.zoom');
  let modal = document.createElement('div');
  let close = document.createElement('span');
  let image = document.createElement('img');
  let caption = document.createElement('div');
  // loop
  Array.from(images).forEach((img) =>{
    // on click open modal with image
    img.onclick = function(e){
       e.preventDefault();
      // create modal
      modal.id = 'lightbox';
      modal.className = 'lightbox';
      // create close
      close.className = 'lightbox-close';
      close.innerHTML = '<img src="'+assets+'/img/close.svg">';
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
    }
    // close on click
    close.onclick = (e) => {
      e.preventDefault();
      modal.remove();
    }
  })
};


const lazyLoad = () => {
  // select all images
  let images = document.querySelectorAll('#pageWrapper img');
  // loop images
  [].forEach.call(images, (img) => {
    img.classList.add('loaded');
    // if has data-src remove and set in src
    if(img.getAttribute('data-src')) img.setAttribute('src', img.getAttribute('data-src'));
    // check if link has url
    if(!img.parentElement.classList.contains('isLink')) img.classList.add('zoom');
    // add lightbox
    lightbox();
    // on load images
    img.onload = () => {
      if(img.getAttribute('data-src')) img.removeAttribute('data-src');
    };
  });
};


const toggleMenu = () => {
  let btnmenu = document.querySelector('.mobile-menu a');
  let btnClose = document.querySelector('.closeMenu');
  let menu = document.querySelector('nav#menu');

  btnmenu.addEventListener('click', (e) => menubar(e));
  btnClose.addEventListener('click', (e) => menubar(e));

  function menubar(e) {
    e.preventDefault();
    menu.classList.toggle('show')
    if (menu.classList.contains('show')) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = 'auto';
    }
  }
}


const linksFx = () =>{
    let links = document.querySelectorAll('li a');
    let arr = Array.prototype.slice.call(links);
    arr.map((item)=>{
        let old = item.textContent;
        item.addEventListener('mouseover',()=>{
            item.classList.add('over');
            item.textContent = '---> '+old;
        });
        item.addEventListener('mouseout',()=>{
            item.classList.remove('over');
            item.textContent = old;
        });
    });
}



/**
 *   @name Loader;
 *   @description Simple progresss bar loader
 */
const loader = (callback) => {
  let l = document.querySelector('.loader span'),
    wrapper = document.querySelector('#page'),
    preloader = document.querySelector('.preloader'),
    // start in 0
    num = 0,
    // interval for  num++
    interval = setInterval(() =>{
      n = ++num;
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
}

document.addEventListener('DOMContentLoaded',()=>{
    loader(() => {
      lazyLoad();
      linksFx();
      toggleMenu();
    });
});