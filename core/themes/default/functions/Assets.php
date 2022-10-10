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

if (!function_exists('assets')) {
    /**
     * Assets.
     *
     * @return string
     */
    function assets(string $source = '')
    {
        $themeName = config('theme');
        $folder = url().'/core/themes/'.$themeName.'/assets/'.$source;

        return $folder;
    }
}