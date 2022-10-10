<?php
/*
 * Declara al principio del archivo, las llamadas a las funciones respetarán
 * estrictamente los indicios de tipo (no se lanzarán a otro tipo).
 */
declare (strict_types = 1);

namespace Text;

/**
 * Acceso restringido
 */
defined("ACCESS") or die("No tiene acceso a este archivo");

/**
 * Trait text
 *
 * @author    Moncho Varela / Nakome <nakome@gmail.com>
 * @copyright 2016 Moncho Varela / Nakome <nakome@gmail.com>
 *
 * @version 0.0.1
 *
 */
class Text
{

    /**
     *  Acortar texto
     *
     *  @param string $text
     *  @param integer $int
     *
     *  @return string
     */
    public static function short(string $text, int $chars_limit)
    {
        // Compruebe si la longitud es mayor que el límite de caracteres
        if (strlen($text) > $chars_limit) {
            // resolver ñ bug
            $text = htmlentities(html_entity_decode($text));
            // Si es así, acorta en el límite de caracteres
            $new_text = substr($text, 0, $chars_limit);
            // Recortar los espacios en blanco
            $new_text = trim($new_text);
            // Añadir al final ...
            return $new_text . "...";
        } else {
            return $text;
        }
    }
}
