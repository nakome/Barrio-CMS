<?php

/*
 * Declara al principio del archivo, las llamadas a las funciones respetarán
 * estrictamente los indicios de tipo (no se lanzarán a otro tipo).
 */
declare (strict_types = 1);

/**
 * Acceso restringido
 */
defined("ACCESS") or die("No tiene acceso a este archivo");

return array(
    // url de la web
    'base_url' => 'http://localhost/cmsbarrio',
    // color tema
    'theme_color' => '#0d6efd',
    // background color
    'background_color' => '#fff',
    // orientation
    'orientation' => 'portrait',
    // display
    'display' => 'standalone',
    // shortname
    'short_name' => 'BarrioCMS',
    // lenguaje
    'lang' => 'es',
    // charset
    'charset' => 'UTF-8',
    // timezone
    'timezone' => 'Europe/Brussels',
    // plantilla por defecto
    'theme' => 'default',
    // titulo de la web
    'title' => 'Barrio CMS',
    // descripcion de la web
    'description' => 'Flat File CMS',
    // palabras clave
    'keywords' => 'desarrollo,web,cms,php',
    // autor
    'author' => 'Moncho Varela',
    // correo
    'email' => 'nakome@demo.com',
    // imagen por defecto
    'default_image' => 'public/notfound.jpg',
    // paginación por página
    'pagination' => 6,
    // Derechos de autor
    'copyright' => 'Barrio',
    // navegacion
    'menu' => array(
        '/' => 'Inicio',
        '/blog' => 'Blog',
        'Docs' => array(
            '/documentacion/primeros-pasos' => 'Primeros pasos',
            '/documentacion/estructura' => 'Estructura',
            '/documentacion/acciones' => 'Acciones',
            '/documentacion/shortcodes' => 'Shortcodes',
            '/documentacion/test-shortcodes' => 'Test Shortcodes',
            '/index.php?api=help' => 'Api',
        ),
        '/editor' => 'Editor',
        '/contacto' => 'Contacto',
        '/asdfdsaf' => 'Error',
    ),
    // traduciones
    'readmore' => 'Leer mas..',
    'blogdate' => 'Creado el',
    'search' => array(
        'results_of' => 'Resultados de la busqueda',
        'no_results' => 'No hay resultados de:',
        'read' => 'Ir a enlace',
    ),

);
