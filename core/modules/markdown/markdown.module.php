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

use Filter\Filter as Filter;
use Shortcode\Shortcode as Shortcode;

/**
 * Extension Markdown.
 *
 *  @author Moncho Varela / Nakome
 *  @copyright 2016 Moncho Varela / Nakome
 *
 *  @version 1.0.0
 */

include MODULES . '/markdown/Parsedown.php';

Filter::add('content', 'markdown', 1);

function markdown($content)
{
    return Parsedown::instance()->text(Shortcode::parse($content));
}
