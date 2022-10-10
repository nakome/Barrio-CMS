<?php
/*
 * Declara al principio del archivo, las llamadas a las funciones respetarán
 * estrictamente los indicios de tipo (no se lanzarán a otro tipo).
 */
declare(strict_types=1);

/*
 * Acceso restringido
 */
defined('ACCESS') or exit('No tiene acceso a este archivo');

use Barrio\Barrio as Barrio;

if (!function_exists('config')) {
    /**
     * Config.
     *
     * @return string
     */
    function config(string $name = '')
    {
        return (Barrio::$config[$name]) ? Barrio::$config[$name] : '';
    }
}

