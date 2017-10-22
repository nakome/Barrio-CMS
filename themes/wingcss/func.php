<?php



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
        return '<div class="nav-item active"><a '.$external.' href="'.trim(Barrio::urlBase().'/'.$link).'">'.ucfirst($name).'</a></div>';
    } else {
        return '<div class="nav-item"><a '.$external.' href="'.trim(Barrio::urlBase().'/'.$link).'">'.ucfirst($name).'</a></div>';
    }
}

/**
 * Acortar enlace a la carpeta theme
 *
 * @return string
 */
function theme()
{
    echo Barrio::urlBase().'/themes/'.Barrio::$config['theme'];
}

/**
 * Acortar enlace a la carpeta assets
 *
 * @return string
 */
function assets()
{
    echo Barrio::urlBase().'/themes/'.Barrio::$config['theme'].'/assets';
}

/**
 * Acortar enlace a la carpeta assets
 *
 * @return string
 */
function imagenes()
{
    return Barrio::urlBase().'/content/imagenes';
}



/**
 * Obtiene la direccion web
 *
 * @return string
 */
function url()
{
    echo Barrio::urlBase();
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




include 'funciones/shortcodes.php';
include 'funciones/acciones.php';
