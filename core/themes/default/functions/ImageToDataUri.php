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


if (!function_exists('imageToDataUri')) {
    /**
     * Convertir imagen a Data uri.
     *
     * @return string
     */
    function imageToDataUri(string $source)
    {
        $img = str_replace(Barrio::urlBase(), ROOT_DIR, $source);
        // Read image path, convert to base64 encoding
        $imageData = base64_encode((string) file_get_contents($img));
        // Format the image SRC:  data:{mime};base64,{data};
        $src = 'data: '.mime_content_type($img).';base64,'.$imageData;

        return $src;
    }
}
