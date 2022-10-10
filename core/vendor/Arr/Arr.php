<?php
/*
 * Declara al principio del archivo, las llamadas a las funciones respetarán
 * estrictamente los indicios de tipo (no se lanzarán a otro tipo).
 */
declare (strict_types = 1);

namespace Arr;

/**
 * Acceso restringido
 */
defined("ACCESS") or die("No tiene acceso a este archivo");

/**
 * Class Arr
 *
 * @author    Moncho Varela / Nakome <nakome@gmail.com>
 * @copyright 2016 Moncho Varela / Nakome <nakome@gmail.com>
 *
 * @version 0.0.1
 *
 */
class Arr
{

    /**
     *  Acortar un array
     *
     * @param array $a      array
     * @param array $subkey array
     * @param array $order  null
     *
     * @return value
     */
    public static function short(array $a = array(), string $subkey = "", string $order = null)
    {
        if (count($a) != 0 || (!empty($a))) {
            foreach ($a as $k => $v) {
                // si resulta ser string convertir a minúsculas
                if (is_string($v[$subkey])) {
                    $b[$k] = function_exists('mb_strtolower') ? mb_strtolower($v[$subkey]) : strtolower($v[$subkey]);
                } else {
                    $b[$k] = $v[$subkey];
                }
            }
            // Orden ascendente
            if ($order == null || $order == 'ASC') {
                asort($b);
                // Orden descendente
            } elseif ($order == 'DESC') {
                arsort($b);
            }

            foreach ($b as $key => $val) {
                $c[] = $a[$key];
            }

            return $c;
        }
    }
}
