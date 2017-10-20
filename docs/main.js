let btnMenu = document.querySelector('.menu'),
    sidebar = document.querySelector('#menu'),
    website = document.querySelector('#website'),
    link = document.querySelectorAll('.link'),
    main = document.querySelector('#wrapper'),
    content = document.querySelector('#content'),
    dropdown = document.querySelectorAll('.has-dropdown > a');

const getPage = (page) => {
    content.innerHTML = 'Cargando..';
    fetch('./pages/' + page + '.html')
        .then((r) => r.text())
        .then(r => {
            content.innerHTML = r;
            let v = setTimeout(()=>{
                tooggleAccordion();
                clearTimeout(v);
            },800);
        });
}


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

const toggleDropdown = (el) => {
    el.addEventListener('click', e => {
        e.preventDefault();
        el.classList.toggle('is-active');
        if (el.nextElementSibling)
            el.nextElementSibling.classList.toggle('show_menu');
    });
}

Array.from(dropdown).forEach((item) => {
    toggleDropdown(item);
});

Array.from(link).forEach((item) => {
    item.addEventListener('click', e => {
        e.preventDefault();
        if(item.parentElement.classList.contains('has-dropdown')){
            sidebar.classList.toggle('is-opened');
            main.classList.toggle('menu-is-open');
        }
        return getPage(item.getAttribute('data-page'));
    });
});

btnMenu.addEventListener('click', e => {
    e.preventDefault();
    sidebar.classList.toggle('is-opened');
    main.classList.toggle('menu-is-open');
})
website.addEventListener('click', e => {
    e.preventDefault();
    location.href = 'http://cmsbarrio.org';
});

getPage('instalacion');