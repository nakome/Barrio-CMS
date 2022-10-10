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

use Action\Action as Action;
use Barrio\Barrio as Barrio;

if (!function_exists('action')) {
    /**
     * Action.
     *
     * @return Action
     */
    function action(string $name = '')
    {
        return Action::run($name);
    }
}

/*
 * ====================================
 *      incluimos el plugin de cookie
 * ====================================
 */
Action::add('head', function () {
    $src = [
        'style' => 'https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css',
        'javascript' => 'https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js',
    ];

    $html = '<link rel="stylesheet" href="'.$src['style'].'"/>';
    $html .= '<script rel="javascript" src="'.$src['javascript'].'"></script>';
    $html .= '<script>
        window.addEventListener("load", function(){
        window.cookieconsent.initialise({
          "position": "bottom-right",
          "content": {
            "message": "Utilizamos cookies propias y de terceros. Si continúa navegando acepta su uso.",
            "dismiss": "Aceptar",
            "link": "Leer mas",
            "href": "'.Barrio::urlBase().'/politica-de-cookies"
          }
        })});
        </script>';

    echo $html;
});
