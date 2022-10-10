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
 * Trait info
 *
 * @author    Moncho Varela / Nakome <nakome@gmail.com>
 * @copyright 2016 Moncho Varela / Nakome <nakome@gmail.com>
 *
 * @version 0.0.1
 *
 */
trait Info
{

    /**
     * Información error
     *
     * @param string $txt The text
     *
     * @return string
     */
    public static function error(string $txt): string
    {
        return "<span style=\"display: inline-block; background: #f55; color: white; padding: 4px 10px; border-radius: 4px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b style=\"color:#FFEB3B;\">Error</b>: {$txt}</span>";
    }

    /**
     * Información texto
     *
     * @param string $txt The text
     *
     * @return string
     */
    public static function info(string $txt): string
    {
        return "<span style=\"display: inline-block; background: #2196F3; color: white; padding: 4px 10px; border-radius: 4px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b style=\"color:#FFEB3B;\">Info</b>: {$txt}</span>";
    }
}
