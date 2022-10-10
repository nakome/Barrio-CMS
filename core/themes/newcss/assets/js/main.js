/**
 * Short selectors 
 */
const _id = (el) => document.getElementById(el);
const _ = el => document.querySelector(el);
const __ = el => document.querySelectorAll(el);


let darkMode = _id('darkMode'),
	darkLabel = "darkModeLabel",
	darkLang = "Noche",
	lightLang = "Dia";

window.addEventListener('load', function() {
	if (darkMode) {
		initTheme();
		darkMode.addEventListener('change', function() {
			resetTheme();
		});
	}
});

// or with onreadystatechange…
let stateCheck = setInterval(() => {
  if (document.readyState === 'complete') {
    clearInterval(stateCheck);
    // document ready
    _id('progress').style.display='none';
  }
}, 100);

function initTheme() {
	let darkThemeSelected = localStorage.getItem('darkMode') !== null && localStorage.getItem('darkMode') === 'dark';
	darkMode.checked = darkThemeSelected;
	darkThemeSelected ? document.body.setAttribute('data-theme', 'dark') : document.body.removeAttribute('data-theme');
	//darkThemeSelected ? _id(imgID).src = darkImg : _id(imgID).src = lightImg;
	darkThemeSelected ? _id(darkLabel).innerHTML = darkLang : _id(darkLabel).innerHTML = lightLang;
}

function resetTheme() {
	if (darkMode.checked) {
		document.body.setAttribute('data-theme', 'dark');
		localStorage.setItem('darkMode', 'dark');
		//_id(imgID).src = darkImg;
		_id(darkLabel).innerHTML = darkLang;
	} else {
		document.body.removeAttribute('data-theme');
		localStorage.removeItem('darkMode');
		//_id(imgID).src = lightImg;
		_id(darkLabel).innerHTML = lightLang;
	}
}