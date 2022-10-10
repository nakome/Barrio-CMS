<?php
/*
 * Declara al principio del archivo, las llamadas a las funciones respetarán
 * estrictamente los indicios de tipo (no se lanzarán a otro tipo).
 */
declare (strict_types = 1);

namespace Token;

/**
 * Acceso restringido
 */
defined("ACCESS") or die("No tiene acceso a este archivo");

/**
 * Class Token
 *
 * @author    Moncho Varela / Nakome <nakome@gmail.com>
 * @copyright 2016 Moncho Varela / Nakome <nakome@gmail.com>
 *
 * @version 0.0.1
 *
 */
class Token
{

    /**
     * Generar Token
     *
     * @return string $token
     */
    public static function generate()
    {
        if (!session_id()) {
            session_start();
        }
        if (@session_start) {
            $length = 32;
            $uniqId = uniqid((string) mt_rand());
            $sha1 = sha1($uniqId);
            $baseConvert = base_convert($sha1, 16, 36);
            $_SESSION['token'] = substr($baseConvert, 0, $length);
            return $_SESSION['token'];
        }
    }

    /**
     * Check token
     *
     * @return bool
     */
    public static function check($token)
    {
        return $token === $_SESSION['token'];
    }
}
