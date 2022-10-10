<?php
/*
 * Declara al principio del archivo, las llamadas a las funciones respetarán
 * estrictamente los indicios de tipo (no se lanzarán a otro tipo).
 */
declare (strict_types = 1);

namespace Shortcode;

/**
 * Acceso restringido
 */
defined("ACCESS") or die("No tiene acceso a este archivo");

/**
 * Trait Shortcode
 *
 * @author    Moncho Varela / Nakome <nakome@gmail.com>
 * @copyright 2016 Moncho Varela / Nakome <nakome@gmail.com>
 *
 * @version 0.0.1
 *
 */
class Shortcode
{

    /**
     * static shortcode_tags
     */
    protected static $shortcode_tags = array();

    /**
     * Shortcode Función.
     *
     *  <code>
     *      Shortcode::add('demo',function($args){
     *         // shortcode
     *      });
     *  </code>
     *
     * @param string $shortcode         the name
     * @param function  $cb The arguments
     *
     */
    public static function add($shortcode, $cb)
    {
        $shortcode = (string) $shortcode;

        if (is_callable($cb)) {
            self::$shortcode_tags[$shortcode] = $cb;
        }

    }

    /**
     * Analizar Shortcode.
     *
     * @param string $content the shortcode content
     */
    public static function parse($content)
    {
        if (!self::$shortcode_tags) {
            return $content;
        }

        $shortcodes = implode('|', array_map('preg_quote', array_keys(self::$shortcode_tags)));
        // old tags {Shortcode attr=''}
        //$pattern1 = "/(.?)\\{([{$shortcodes}]+)(.*?)(\\/)?\\}(?(4)|(?:(.+?)\\{\\/\\s*\\2\\s*\\}))?(.?)/s";
        // [Shortcode attr='']
        $pattern2 = "/(.?)\\[([{$shortcodes}]+)(.*?)(\\/)?\\](?(4)|(?:(.+?)\\[\\/\\s*\\2\\s*\\]))?(.?)/s";
        return preg_replace_callback($pattern2, 'self::handle', $content);
    }

    /**
     * Manejar Shortcode
     *
     * @param array $matches the matche
     */
    protected static function handle($matches)
    {
        $prefix = $matches[1];
        $suffix = $matches[6];
        $shortcode = $matches[2];

        if ($prefix == '{' && $suffix == '}') {
            return substr($matches[0], 1, -1);
        }

        $attributes = array();
        if (preg_match_all('/(\\w+) *= *(?:([\'"])(.*?)\\2|([^ "\'>]+))/', $matches[3], $match, PREG_SET_ORDER)) {
            foreach ($match as $attribute) {
                if (!empty($attribute[4])) {
                    $attributes[strtolower($attribute[1])] = $attribute[4];
                } elseif (!empty($attribute[3])) {
                    $attributes[strtolower($attribute[1])] = $attribute[3];
                }
            }
        }
        return isset(self::$shortcode_tags[$shortcode]) ? $prefix . call_user_func(self::$shortcode_tags[$shortcode], $attributes, $matches[5], $shortcode) . $suffix : '';
    }
}
