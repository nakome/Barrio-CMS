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

use Arr\Arr as Arr;
use File\File as File;
use Filter\Filter as Filter;

/**
 * Trait Pages
 *
 * @author    Moncho Varela / Nakome <nakome@gmail.com>
 * @copyright 2016 Moncho Varela / Nakome <nakome@gmail.com>
 *
 * @version 0.0.1
 *
 */
trait Pages
{
    /**
     *  Obetener las cabeceras
     *
     * <code>
     *  $posts = Barrio::getHeaders('blog','date','DESC',array('index','404'),null);
     * </code>
     *
     * @param string $url        Url
     * @param string $order_by   Order by
     * @param string $order_type Order type
     * @param array  $ignore     Pages to ignore
     * @param int    $limit      Limit of pages
     *
     * @return array
     */
    public function getHeaders(string $url, string $order_by = 'date', string $order_type = 'DESC', array $ignore = array('404'), int $limit = null)
    {
        $headers = $this->headers;
        // Escaneamos en la carpeta content solo los archivos con extensión md.
        $pages = File::scan(CONTENT . '/' . $url, 'md');
        foreach ($pages as $key => $page) {

            if (!in_array(basename($page, '.md'), $ignore)) {

                $content = file_get_contents($page);
                $_headers = explode(self::SEPARATOR, $content);

                foreach ($headers as $var => $regex) {
                    if (preg_match('/^[ \\t\\/*#@]*' . preg_quote($regex, '/') . ':(.*)$/mi', $_headers[0], $match) && $match[1]) {
                        $_pages[$key][$var] = trim($match[1]);
                    } else {
                        $_pages[$key][$var] = '';
                    }
                }

                // si no existe fecha usa filemtime
                // y si existe usa timestamp
                if (!$_pages[$key]['date']) {
                    $_pages[$key]['date'] = filemtime((string) $page);
                } else {
                    // probar primero fecha d/m/Y
                    $currentDate = $_pages[$key]['date'];
                    // separa la fecha
                    $d = explode('/', $currentDate);
                    if (preg_match("/-/s", $currentDate)) {
                        $d = explode('-', $currentDate);
                    }
                    if (checkdate((int) $d[0], (int) $d[1], (int) $d[2])) {
                        // fecha valida ...
                        $valid = "$d[2]-$d[1]-$d[0]";
                        $_pages[$key]['date'] = strtotime($valid);
                    } else {
                        $date = str_replace('/', '-', $_pages[$key]['date']);
                        $_pages[$key]['date'] = strtotime($date);
                    }
                }

                // convertir url
                $url = str_replace(CONTENT, self::urlBase(), $page);
                $url = str_replace('index.md', '', $url);
                $url = str_replace('.md', '', $url);
                $url = str_replace('\\', '/', $url);
                $url = rtrim($url, '/');

                $_pages[$key]['url'] = $url;
                $_pages[$key]['slug'] = basename($page, '.md');
            }
        }
        $_pages = Arr::short($_pages, $order_by, $order_type);
        if ($limit != null) {
            $_pages = array_slice($_pages, (int) 0, (int) $limit);
        }
        return $_pages;
    }

    /**
     *  Obtener paginas
     *
     * <code>
     *  $posts = Barrio::pages('blog','date','DESC',array('index','404'),null);
     * </code>
     *
     * @param string $url        Url
     * @param string $order_by   Order by
     * @param string $order_type Order type
     * @param array  $ignore     Pages to ignore
     * @param int    $limit      Limit of pages
     *
     * @return array
     */
    public function pages($url, $order_by = 'date', $order_type = 'DESC', $ignore = array('404'), $limit = null)
    {

        $headers = $this->headers;
        $pages = File::scan(CONTENT . '/' . $url, 'md');

        foreach ($pages as $key => $page) {

            if (!in_array(basename($page, '.md'), $ignore)) {

                $content = file_get_contents($page);
                $_headers = explode(self::SEPARATOR, $content);

                foreach ($headers as $var => $regex) {
                    if (preg_match('/^[ \\t\\/*#@]*' . preg_quote($regex, '/') . ':(.*)$/mi', $_headers[0], $match) && $match[1]) {
                        $_pages[$key][$var] = trim($match[1]);
                    } else {
                        $_pages[$key][$var] = '';
                    }
                }
                if (!$_pages[$key]['date']) {
                    $_pages[$key]['date'] = filemtime((string) $page);
                } else {
                    if (self::validateDate('d/m/Y', $_pages[$key]['date'])) {
                        $date = str_replace('/', '-', $_pages[$key]['date']);
                        $_pages[$key]['date'] = strtotime($date);
                    }
                }

                $url = str_replace(CONTENT, self::urlBase(), $page);
                $url = str_replace('index.md', '', $url);
                $url = str_replace('.md', '', $url);
                $url = str_replace('\\', '/', $url);
                $url = rtrim($url, '/');

                $_pages[$key]['url'] = $url;

                $_content = $this->parseContent($content);
                if (is_array($_content)) {
                    $_pages[$key]['content_short'] = $_content['content_short'];
                    $_pages[$key]['content'] = $_content['content_full'];
                } else {
                    $_pages[$key]['content_short'] = $_content;
                    $_pages[$key]['content'] = $_content;
                }
                $_pages[$key]['slug'] = basename($page, '.md');
            }
        }

        $_pages = Arr::short($_pages, $order_by, $order_type);
        if ($limit != null) {
            $_pages = array_slice($_pages, 0, $limit);
        }
        return $_pages;
    }

    /**
     *  Get page
     *
     * <code>
     *  $page = Barrio::page('blog');
     * </code>
     *
     * @param string $url the url
     *
     * @return $page (Array)
     */
    public function page($url)
    {

        $headers = $this->headers;

        if ($url) {
            $file = CONTENT . '/' . $url;
        } else {
            $file = CONTENT . '/' . 'index';
        }

        if (is_dir($file)) {
            $file = CONTENT . '/' . $url . '/index.md';
        } else {
            $file .= '.md';
        }

        if (file_exists($file)) {
            $content = file_get_contents($file);
        } else {
            $file = CONTENT . '/404.md';
            if (file_exists($file)) {
                $content = file_get_contents($file);
                header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
            } else {
                die('404, página no encontrada.');
            }
        }

        $_headers = explode(self::SEPARATOR, $content);
        foreach ($headers as $campo => $regex) {
            if (preg_match('/^[ \\t\\/*#@]*' . preg_quote($regex, '/') . ':(.*)$/mi', $_headers[0], $match) && $match[1]) {
                $page[$campo] = trim($match[1]);
            } else {
                $page[$campo] = '';
            }
        }

        $url = str_replace(CONTENT, static::urlBase(), $file);
        $url = str_replace('index.md', '', $url);
        $url = str_replace('.md', '', $url);
        $url = str_replace('\\', '/', $url);
        $url = rtrim($url, '/');

        $pages['url'] = $url;
        $_content = $this->parseContent($content);
        if (is_array($_content)) {
            $page['content_short'] = $_content['content_short'];
            $page['content'] = $_content['content_full'];
        } else {
            $page['content_short'] = $_content;
            $page['content'] = $_content;
        }
        $page['slug'] = basename($file, '.md');

        return $page;
    }

    /**
     *  Analizamos el contenido
     *
     * @param string $content the content
     *
     * @return $content (array)
     */
    protected function parseContent($content)
    {
        $_content = '';
        $i = 0;
        foreach (explode(self::SEPARATOR, $content) as $c) {
            $i++ != 0 and $_content .= $c;
        }

        $content = $_content;
        // añadimos la etiqueta more para acortar el texto
        $pos = strpos($content, '{More}');
        if ($pos === false) {
            $content = Filter::apply('content', $content);
        } else {
            $content = explode('{More}', $content);
            $content['content_short'] = Filter::apply('content', $content[0]);
            $content['content_full'] = Filter::apply('content', $content[0] . $content[1]);
        }
        //$content = preg_replace('/\s+/', ' ', $content);
        $content = static::evalPHP($content);
        return $content;
    }
}
