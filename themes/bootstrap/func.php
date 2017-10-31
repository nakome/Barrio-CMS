<?php


/**
 * Acortar enlace a la carpeta assets
 * 
 * @return string
 */
function assets()
{
    return Barrio::urlBase().'/themes/'.Barrio::$config['theme'].'/assets';
}

/**
 * Obtiene la direccion web
 * 
 * @return string
 */
function url()
{
    return Barrio::urlBase();
}

/**
 * Obtiene la direccion web en ese momento
 * 
 * @return string
 */
function urlCurrent()
{
    return  Barrio::urlBase().'/'.Barrio::urlCurrent();
}

/**
*  Comprobar que es la pagina de inicio
*
* @return boolean
*/
function isHome(){
    $url = Barrio::urlSegment(0);
    if(empty($url)){
        return true;
    }
}

/**
 * Navegacion
 *
 * @param string $link el link
 * @param string $name el nombre
 *
 * @return string
 */
function nav($link = '', $name = 'inicio',$target = false)
{
    // segementos
    $url = Barrio::urlSegment(0);
    $external = '';
    if($target) $external = 'target="_black"';
    // si es igual hacerlo activo
    if ($url == $link) {
        return '<li class="nav-item active"><a '.$external.' class="nav-link"href="'.trim(Barrio::urlBase().'/'.$link).'">'.ucfirst($name).'</a></li>';
    } else {
        return '<li class="nav-item"><a '.$external.' class="nav-link"href="'.trim(Barrio::urlBase().'/'.$link).'">'.ucfirst($name).'</a></li>';
    }
}




/**
 * Navegacion interna
 * 
 * @param string $link el link 
 * @param string $name el nombre
 * 
 * @return string
 */
function dropdown($link = '', $name = '')
{
    return '<a class="dropdown-item" href="'.trim(Barrio::urlBase().'/'.$link).'">'.$name.'</a>';
}


// Shortcodes theme
require 'funciones/shortcodes.php';
require 'funciones/aciones.php';
