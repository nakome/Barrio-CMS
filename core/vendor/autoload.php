<?php

/*
 * Declara al principio del archivo, las llamadas a las funciones respetarán
 * estrictamente los indicios de tipo (no se lanzarán a otro tipo).
 */
declare (strict_types = 1);

/**
 * Prevenir accesso
 */
defined('ACCESS') or die('Sin accesso al script.');

/**
 * Cargamos las clases
 */
spl_autoload_register(function ($className) {
    include_once dirname(__DIR__) . '/vendor/' . str_replace("\\", "/", $className . '.php');
});
