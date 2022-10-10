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
 * Trait Pages
 *
 * @author    Moncho Varela / Nakome <nakome@gmail.com>
 * @copyright 2016 Moncho Varela / Nakome <nakome@gmail.com>
 *
 * @version 0.0.1
 *
 */
trait Navigation
{

    /**
     * Crear menu
     */
    public static function renderNavigation(array $nav = array()): array
    {
        $output = array();
        foreach ($nav as $k => $v) {
            // key exists
            if (array_key_exists($k, $nav)) {
                // not empty
                if ($k != '') {

                    // external page
                    if (preg_match("/http/i", $k)) {

                        $output[] = array($k => ucfirst($v));

                    } elseif (preg_match("/#/i", $k)) {

                        $output[] = array('#' => ucfirst($v));

                    } else {

                        // is array
                        if (is_array($v)) {

                            // dropdown
                            $output[] = array('dropdown' => static::renderNavigation($v));

                        } else {

                            // active page
                            $active = static::urlCurrent();
                            $activeurl = str_replace('/', '', $k);
                            if ($active == $activeurl) {

                                $output[] = array('active' => array(trim(static::urlBase() . $k) => ucfirst($v)));

                            } else {

                                $output[] = array(trim(static::urlBase() . $k) => ucfirst($v));

                            }

                        }
                    }
                }
            }
        }
        return $output;
    }
}
