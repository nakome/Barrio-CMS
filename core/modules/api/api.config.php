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
    'name' => 'Api',
    'description' => 'Provide json output for pages and public archivies',
    'enabled' => true,
    //.. custom vars
);
