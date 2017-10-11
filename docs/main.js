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