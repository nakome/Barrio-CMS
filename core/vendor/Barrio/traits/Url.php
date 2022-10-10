<?php
/*
 * Declara al principio del archivo, las llamadas a las funciones respetarán
 * estrictamente los indicios de tipo (no se lanzarán a otro tipo).
 */
declare (strict_types = 1);

namespace traits;

/**
 * Acceso restringido
 */
defined("ACCESS") or die("No tiene acceso a este archivo");

/**
 * Trait url
 *
 * @author    Moncho Varela / Nakome <nakome@gmail.com>
 * @copyright 2016 Moncho Varela / Nakome <nakome@gmail.com>
 *
 * @version 0.0.1
 *
 */
trait Url
{

    /**
     * Obtiene la Salida en formato Json.
     *
     * @param array $array array
     */
    public static function urlJson($array)
    {
        // set headers
        @header('Content-Type: application/json');
        // print json
        return print_r(json_encode($array));
    }

    /**
     * Obtener la base de la url
     *
     * <code>
     *   Barrio::urlBase();
     * </code>
     *
     * @return string url
     */
    public static function urlBase()
    {
        /**
         * En el caso que se use una url con puerto tipo localhost:8000
         * hay que descomentar base_url y comentar el otro
         */
        $https = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? 'https://' : 'http://';
        //return App::config('base_url');
        return $https . rtrim(rtrim($_SERVER['HTTP_HOST'], '\\/') . dirname($_SERVER['PHP_SELF']), '\\/');
        // si tenemos un servidor con puerto podemos usar la url de config.php base_url
        //return self::$config['base_url'];
    }

    /**
     * Consigue la url actual.
     *
     * <code>
     *  Barrio::urlCurrent();
     * </code>
     *
     * @return string url
     */
    public static function urlCurrent()
    {
        $url = '';
        $request_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        $script_url = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : '';
        if ($request_url != $script_url) {
            $url = trim(preg_replace('/' . str_replace('/', '\\/', str_replace('index.php', '', $script_url)) . '/', '', $request_url, 1), '/');
        }
        $url = preg_replace('/\\?.*/', '', $url);

        return $url;
    }

    /**
     * Segmentos de la url
     *
     * <code>
     *  Barrio::urlSegments();
     * </code>
     *
     * @return array
     */
    public static function urlSegments()
    {
        return explode('/', self::urlCurrent());
    }

    /**
     * Segmento de la url
     *
     * <code>
     *  Barrio::urlSegment(1);
     * </code>
     *
     * @param string $name the name
     *
     * @return string
     */
    public static function urlSegment($name)
    {
        $segments = self::UrlSegments();

        return isset($segments[$name]) ? $segments[$name] : null;
    }

    /**
     *  Sanear Url.
     *
     * @param string $url the url
     *
     * @return string url
     */
    public static function urlSanitize($url)
    {
        $url = trim($url);
        $url = rawurldecode($url);
        $url = str_replace(array('--', '&quot;', '!', '@', '#', '$', '%', '^', '*', '(', ')', '+', '{', '}', '|', ':', '"', '<', '>', '[', ']', '\\', ';', "'", ',', '*', '+', '~', '`', 'laquo', 'raquo', ']>', '&#8216;', '&#8217;', '&#8220;', '&#8221;', '&#8211;', '&#8212;'), array('-', '-', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''), $url);
        $url = str_replace('--', '-', $url);
        $url = rtrim($url, '-');
        $url = str_replace('..', '', $url);
        $url = str_replace('//', '', $url);
        $url = preg_replace('/^\//', '', $url);
        $url = preg_replace('/^\./', '', $url);

        return $url;
    }

    /**
     * Ejecutar saneo
     *
     * @return <type>
     */
    public static function runSanitize()
    {
        $_GET = array_map('Barrio\Barrio::urlSanitize', $_GET);
    }
}
