<?php
/*
 * Declara al principio del archivo, las llamadas a las funciones respetarán
 * estrictamente los indicios de tipo (no se lanzarán a otro tipo).
 */
declare (strict_types = 1);

namespace Action;

use Arr\Arr as Arr;

/**
 * Acceso restringido
 */
defined("ACCESS") or die("No tiene acceso a este archivo");

/**
 * Class Action
 *
 * @author    Moncho Varela / Nakome <nakome@gmail.com>
 * @copyright 2016 Moncho Varela / Nakome <nakome@gmail.com>
 *
 * @version 0.0.1
 *
 */
class Action
{

    /**
     * Static action
     */
    private static $actions = array();

    /**
     * Crear una acción.
     *
     *  <code>
     *      Action::add('demo',function(){});
     *  </code>
     *
     * @param <type> $name     The name
     * @param <type> $func     The function
     * @param int    $priority The priority
     * @param array  $args     The arguments
     *
     * @return static
     */
    public static function add($name, $func, $priority = 10, array $args = null)
    {
        // Argumentos para crear la acción
        static::$actions[] = array(
            'name' => (string) $name,
            'func' => $func,
            'priority' => (int) $priority,
            'args' => $args,
        );
    }

    /**
     * Ejecutar la acción.
     *
     *  <code>
     *      Action::run('demo',array());
     *  </code>
     *
     * @param string $name   The name
     * @param array  $args   The arguments
     * @param bool   $return The return
     *
     * @return function
     */
    public static function run($name, $args = array(), $return = false)
    {
        // Redefinir los argumentos
        $name = (string) $name;
        $return = (bool) $return;
        // Run action
        if (count(static::$actions) > 0) {
            // Ordenar las acciones por prioridad
            $actions = Arr::short(static::$actions, 'priority');
            foreach ($actions as $action) {
                // Ejecutar una acción específica
                if ($action['name'] == $name) {
                    // hay argumentos ?
                    if (isset($args)) {
                        if ($return) {
                            return call_user_func_array($action['func'], $args);
                        } else {
                            call_user_func_array($action['func'], $args);
                        }
                    } else {
                        if ($return) {
                            return call_user_func_array($action['func'], $action['args']);
                        } else {
                            call_user_func_array($action['func'], $action['args']);
                        }
                    }
                }
            }
        }
    }
}
