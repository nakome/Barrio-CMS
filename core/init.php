<?php

defined('ACCESS') or die('No direct script access.');

/**
 * --------------------------
 *    Definiciones básicas
 * --------------------------
 */
define('CORE', ROOT_DIR . '/core');
define('CONTENT', ROOT_DIR . '/content');
define('MODULES', CORE . '/modules');
define('STORAGE', CORE . '/storage');
define('THEMES', CORE . '/themes');
define('VENDOR', CORE . '/vendor');

/**
 * Ver errores en el código
 */
define('DEV_MODE', true);

// Mostrar errores si dev_mode es true
if (DEV_MODE) {
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

// Cargar autoload
require_once VENDOR . '/autoload.php';

Barrio\Barrio::run()->init(STORAGE . '/config.php');
