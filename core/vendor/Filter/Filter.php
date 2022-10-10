<?php
/*
 * Declara al principio del archivo, las llamadas a las funciones respetarán
 * estrictamente los indicios de tipo (no se lanzarán a otro tipo).
 */
declare (strict_types = 1);

namespace Filter;

/**
 * Acceso restringido
 */
defined("ACCESS") or die("No tiene acceso a este archivo");

/**
 * Class Filter
 *
 * @author    Moncho Varela / Nakome <nakome@gmail.com>
 * @copyright 2016 Moncho Varela / Nakome <nakome@gmail.com>
 *
 * @version 0.0.1
 *
 */
class Filter
{

    /**
     * Static filters
     */
    protected static $filters = array();

    /**
     * Aplicar un filtro
     *
     * @param string $filter_name The filter name
     * @param string $value       The value
     *
     * @return string
     */
    public static function apply(string $filter_name, string $value)
    {
        // Redifine argumentos
        $filter_name = (string) $filter_name;
        $args = array_slice(func_get_args(), 2);

        if (!isset(static::$filters[$filter_name])) {
            return $value;
        }

        foreach (static::$filters[$filter_name] as $priority => $functions) {
            if (!is_null($functions)) {
                foreach ($functions as $function) {
                    $all_args = array_merge(array($value), $args);
                    $function_name = $function['function'];
                    $accepted_args = $function['accepted_args'];
                    if ($accepted_args == 1) {
                        $the_args = array($value);
                    } elseif ($accepted_args > 1) {
                        $the_args = array_slice($all_args, 0, $accepted_args);
                    } elseif ($accepted_args == 0) {
                        $the_args = null;
                    } else {
                        $the_args = $all_args;
                    }
                    $value = call_user_func_array($function_name, $the_args);
                }
            }
        }

        return $value;
    }

    /**
     * Añade un filtro
     *
     * @param string  $filter_name     The filter name
     * @param string  $function_to_add The function to add
     * @param integer $priority        The priority
     * @param integer $accepted_args   The accepted arguments
     *
     * @return boolean
     */
    public static function add(string $filter_name, string $function_to_add, int $priority = 10, int $accepted_args = 1)
    {
        // Redefinir los argumentos
        $filter_name = (string) $filter_name;
        $function_to_add = $function_to_add;
        $priority = (int) $priority;
        $accepted_args = (int) $accepted_args;

        // Comprueba que no tenemos ya el mismo filtro con la misma prioridad. Gracias a WP :)
        if (isset(static::$filters[$filter_name]["$priority"])) {
            foreach (static::$filters[$filter_name]["$priority"] as $filter) {
                if ($filter['function'] == $function_to_add) {
                    return true;
                }
            }
        }

        static::$filters[$filter_name]["$priority"][] = array('function' => $function_to_add, 'accepted_args' => $accepted_args);

        // Ordenar
        ksort(static::$filters[$filter_name]["$priority"]);
        return true;
    }

}
