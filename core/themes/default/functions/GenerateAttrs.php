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


if (!function_exists('generateAttrs')) {
    /**
     * Generar atributos.
     *
     * @param array $attrs
     */
    function generateAttrs($attrs)
    {
        $html = '<div class="my-4">';
        $toJson = json_decode((string) $attrs, true);
        if (is_array($toJson)) {
            // si hay colores
            if ($toJson['colores']) {
                $colores = explode(',', $toJson['colores']);
                $html .= '<p class="m-0"><b>Colores usados: </b></p>';
                $html .= '<div class="colors">';
                foreach ($colores as $color) {
                    $html .= '<div class="color float-start" style="background:'.$color.';"><span>'.$color.'</span></div>';
                }
                $html .= '</div>';
            }
            // si hay codigo
            if ($toJson['code']) {
                $code = explode(',', $toJson['code']);
                $html .= '<p class="mb-1"><b class="me-2">Codigo: </b> ';
                foreach ($code as $cod) {
                    $html .= '<span class="me-1 badge bg-dark text-light">'.ucfirst($cod).'</span>';
                }
                $html .= '</p>';
            }
            // si hay cms
            if ($toJson['cms']) {
                $html .= '<p class="mb-1"><b class="me-2">CMS: </b> '.$toJson['cms'].'</p>';
            }
        }
        $html .= '</div>';

        return $html;
    }
}