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
 * Trait debug
 *
 * @author    Moncho Varela / Nakome <nakome@gmail.com>
 * @copyright 2016 Moncho Varela / Nakome <nakome@gmail.com>
 *
 * @version 0.0.1
 *
 */
trait Debuging
{
    /**
     * Depurar
     *
     * <code>
     *  Barrio::debug($array);
     * </code>
     *
     * @param array $a the array to debug
     *
     * @return string
     */
    public static function debug($a = array())
    {
        return die(print("<pre>" . print_r($a, true) . "</pre>"));
    }
}
