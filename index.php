<?php

/*
 * Declara al principio del archivo, las llamadas a las funciones respetarán
 * estrictamente los indicios de tipo (no se lanzarán a otro tipo).
 */
declare(strict_types=1);

/*
 *  Definir el acceso a los archivos
 */
define('ACCESS', true);

/*
 * Definir el PATH al directorio raíz (sin trailing slash).
 */
define('ROOT_DIR', rtrim(dirname(__FILE__), '\\/'));

// si la version es mas baja salimos
if (version_compare(PHP_VERSION, '7.0.0', '<')) {
    exit('Barrio necesita PHP 7.0.0 en adelante.');
}

include ROOT_DIR.'/core/init.php';
