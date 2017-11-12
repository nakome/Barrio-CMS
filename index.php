<?php

if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    exit('Barrio necesita PHP 5.3.0 en adelante.');
}


define('BARRIO', true);
define('ROOT', rtrim(dirname(__FILE__), '\\/'));
define('CONTENT', ROOT.'/content');
define('THEMES', ROOT.'/themes');
define('EXTENSIONS', ROOT.'/extensions');


// development mode is true
// for production change to false
define('DEV', true);
if (DEV) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    ini_set('track_errors', 1);
    ini_set('html_errors', 1);
    error_reporting(E_ALL | E_STRICT | E_NOTICE);
} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    ini_set('track_errors', 0);
    ini_set('html_errors', 0);
    error_reporting(0);
}

require ROOT.'/Barrio.php';
Barrio::Run()->init('config.php');
