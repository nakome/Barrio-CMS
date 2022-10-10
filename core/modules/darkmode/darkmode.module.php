<?php
/*
 * Declara al principio del archivo, las llamadas a las funciones respetarán
 * estrictamente los indicios de tipo (no se lanzarán a otro tipo).
 */
declare (strict_types = 1);

/**
 * Acceso restringido
 */
defined("ACCESS") or die("No tiene acceso a este archivo");

use Action\Action as Action;

Action::add('footer', function () {
    $html = '<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>';
    $html .= "<script>
        function addDarkmodeWidget() {
            var options = {
              bottom: '32px', // default: '32px'
              right: '32px', // default: 'unset'
              time: '0.5s', // default: '0.3s'
              mixColor: '#fff', // default: '#fff'
              backgroundColor: '#fff',  // default: '#fff'
              buttonColorDark: '#100f2c',  // default: '#100f2c'
              buttonColorLight: '#fff', // default: '#fff'
              saveInCookies: false, // default: true,
              label: '🌓', // default: ''
              autoMatchOsTheme: true // default: true
            }

            const darkmode = new Darkmode(options);
            darkmode.showWidget();
        }
        window.addEventListener('load', addDarkmodeWidget);
    </script>";
    echo $html;
});
