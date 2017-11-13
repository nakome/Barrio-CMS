<?php  defined('BARRIO') or die('Sin accesso a este script.');


if (!function_exists('assets')) {
    /**
     * Acortar enlace a la carpeta assets
     *
     * @return string
     */
    function assets()
    {
        return Barrio::urlBase().'/themes/'.Barrio::$config['theme'].'/assets';
    }
}
if (!function_exists('url')) {
    /**
     * Obtiene la direccion web
     *
     * @return string
     */
    function url()
    {
        return Barrio::urlBase();
    }
}

if (!function_exists('urlCurrent')) {
    /**
     * Obtiene la direccion web en ese momento
     *
     * @return string
     */
    function urlCurrent()
    {
        return  Barrio::urlBase().'/'.Barrio::urlCurrent();
    }
}

if (!function_exists('isHome')) {
    /**
     *  Comprobar que es la pagina de inicio
     *
     * @return boolean
     */
    function isHome()
    {
        $url = Barrio::urlSegment(1);
        if (empty($url)) {
            return true;
        }
    }
}