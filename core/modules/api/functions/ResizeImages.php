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

use Barrio\Barrio as Barrio;
use Shortcode\Shortcode as Shortcode;

if(!function_exists('ResizeImages'))
{
    function ResizeImages($url, $width, $height, $quality = 70)
    {
        @header('Content-type: image/jpeg');
        $filePath = ROOT_DIR . '/' . $url;

        list($width_orig, $height_orig) = getimagesize($url);
        $ratio_orig = $width_orig / $height_orig;
        if ($width / $height > $ratio_orig) {
            $width = $height * $ratio_orig;
        } else {
            $height = $width / $ratio_orig;
        }

        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
        $image = '';
        if ($ext == 'png') {
            $image = imagecreatefrompng((string) $filePath);
            $bg = imagecreatetruecolor((int) $width, (int) $height);
            imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
            imagealphablending($bg, true);
            imagecopyresampled($bg, $image, 0, 0, 0, 0, (int) $width, (int) $height, (int) $width_orig, (int) $height_orig);
            imagejpeg($bg, null, $quality);
        } else {
            // This resamples the image
            $image_p = imagecreatetruecolor((int) $width, (int) $height);
            $image = imagecreatefromjpeg((string) $url);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, (int) $width, (int) $height, (int) $width_orig, (int) $height_orig);
            imagejpeg($image_p, null, 100);
            //imagedestroy($bg);
        }
    }
}