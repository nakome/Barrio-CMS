<?php
/*
 * Declara al principio del archivo, las llamadas a las funciones respetarán
 * estrictamente los indicios de tipo (no se lanzarán a otro tipo).
 */
declare(strict_types=1);

/*
 * Acceso restringido
 */
defined('ACCESS') or exit('No tiene acceso a este archivo');

use Barrio\Barrio as Barrio;

include 'functions/ResizeImages.php';
include 'functions/Api.php';

if (array_key_exists('api', $_GET)) {
    // enable Cors
    Barrio::cors();
    // method
    $method = ($_GET['api']) ? $_GET['api'] : null;
    // init api
    $api = new Api();
    // Switch method
    switch ($method) {
        //index.php?api=help
        case 'help':$api->help();
            break;

        //index.php?api=file&data=pages&name=blog
        //index.php?api=file&data=pages&name=blog&limit=2
        //index.php?api=file&data=pages&name=blog&filter=title
        //index.php?api=file&data=pages&name=blog&filter=images
        //index.php?api=file&data=pages&name=blog&filter=videos
        case 'file':$api->file();
            break;

        //index.phpv[public url]
        //index.php?api=image&url=[public url]&w=[size width]
        //index.php?api=image&url=[public url]&w=[size width]&h=[size height]
        case 'image':$api->image();
            break;

        //index.php?api=manifest
        case 'manifest':$api->manifest();
            break;

        //index.php?api=sitemap
        case 'sitemap':$api->sitemap();
            break;
    }
}
