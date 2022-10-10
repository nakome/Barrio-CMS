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

if (!function_exists('navFolder')) {
    /**
     * Navegacion de carpetas.
     */
    function navFolder()
    {
        $source = CONTENT.'/'.trim(Barrio::urlSegment(0));
        if (is_dir($source)) {
            $pages = Barrio::run()->getHeaders(trim(Barrio::urlSegment(0)), 'date', 'DESC', ['index', '404']);

            if (count($pages) > 1) {
                $url = trim(Barrio::urlCurrent());
                $site_url = trim(Barrio::urlBase().'/'.Barrio::urlSegment(0));
                $html = '<nav class="my-4 overflow-hidden">';

                if ($pages) {
                    foreach ($pages as $k => $v) {
                        $slug = Barrio::urlSegment(0).'/'.$pages[$k]['slug'];
                        if ($url == $slug) {
                            $separator = '<span style="margin: 0 3em"></span>';

                            if (null != isset($pages[$k - 1])) {
                                $html .= '<a class="btn btn-dark float-start" href="'.$site_url.'/'.$pages[$k - 1]['slug'].'">
                                    <span aria-hidden="true">&laquo;</span>
                                    '.$pages[$k - 1]['title'].'
                                </a>'.$separator;
                            } else {
                                $html .= '<a class="btn btn-dark float-start" href="'.$site_url.'">
                                    <span aria-hidden="true">&laquo;</span>
                                    '.ucfirst(Barrio::urlSegment(0)).'
                                </a>'.$separator;
                            }

                            if (null != isset($pages[$k + 1])) {
                                $html .= '<a class="btn btn-dark float-end" href="'.$site_url.'/'.$pages[$k + 1]['slug'].'">
                                    '.$pages[$k + 1]['title'].'
                                    <span aria-hidden="true">&raquo;</span>
                                </a>';
                            } else {
                                $html .= '<a class="btn btn-dark float-end" href="'.$site_url.'">
                                    '.ucfirst(Barrio::urlSegment(0)).'
                                    <span aria-hidden="true">&raquo;</span>
                                </a>';
                            }
                        }
                    }
                }
                $html .= '</nav>';
                echo $html;
            }
        }
    }
}