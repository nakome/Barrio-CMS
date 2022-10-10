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

if (!function_exists('arrayOfMenu')) {
    /**
     * Generar un menu.
     *
     * @param array $nav
     *
     * @return string
     */
    function arrayOfMenu($nav)
    {
        $html = '';
        foreach ($nav as $k => $v) {
            // key exists
            if (array_key_exists($k, $nav)) {
                // not empty
                if ('' != $k) {
                    // external page
                    if (preg_match('/http/i', $k)) {
                        $html .= '<li class="nav-item"><a class="nav-link fw-ultra" href="'.$k.'">'.ucfirst($v).'</a></li>';
                    } else {
                        // is array
                        if (is_array($v)) {
                            // dropdown
                            $id = uniqid();
                            $html .= '<li class="nav-item dropdown">';
                            $html .= '  <a class="nav-link  fw-ultra dropdown-toggle" data-bs-toggle="dropdown"  id="'.$id.'" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="#">'.ucfirst($k).'</a>';
                            $html .= '<ul class="dropdown-menu" aria-labelledby="'.$id.'">
                            '.arrayOfMenu($v).'</ul>';
                            $html .= '</li>';
                        } else {
                            // active page
                            $active = Barrio::urlSegment(0);
                            $activeurl = str_replace('/', '', $k);
                            if ($active == $activeurl) {
                                $html .= '<li class="nav-item "><a  class="nav-link fw-ultra active"href="'.trim(Barrio::urlBase().$k).'">
                                    '.ucfirst($v).'
                                </a></li>';
                            } else {
                                $html .= '<li class="nav-item"><a  class="nav-link fw-ultra" href="'.trim(Barrio::urlBase().$k).'">
                                    '.ucfirst($v).'
                                </a></li>';
                            }
                        }
                    }
                }
            }
        }
        // show html
        return $html;
    }
}

if (!function_exists('menu')) {
    /**
     * Crear menu.
     */
    function menu()
    {
        // array del menu
        $nav = Barrio::$config['menu'];
        $navigation = arrayOfMenu($nav);

        return $navigation;
    }
}