<?php


/**
 * Menu for diferent languages
 * Check config file
 */
function menu(){
    $navigation = Barrio::$config['menu'];

    $url = Barrio::urlSegment(0);
    $active = $url.'/'.Barrio::urlSegment(1);

    $html = '';
    if(array_key_exists($url, $navigation)){
        foreach($navigation[$url] as $key => $value){
            if(is_array($value)){
                $dropdown =  '<li class="nav-item dropdown">';
                $dropdown .= '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> ';
                $dropdown .=  $key;
                $dropdown .= '</a> ';
                $dropdown .= '<div class="dropdown-menu" aria-labelledby="navbarDropdown"> ';
                foreach($value as $dkey => $dvalue){
                    $dropdown .= '  <a class="dropdown-item" href="'.trim(Barrio::urlBase().'/'.$dkey).'">'.ucfirst($dvalue).'</a> ';
                }
                $dropdown .= '</div> ';
                $dropdown .=  '</li>';
                $html .=$dropdown;
            }else{
                if($active == $key){
                    $html .= '<li class="nav-item "><a  class="nav-link active"href="'.trim(Barrio::urlBase().'/'.$key).'">
                        '.ucfirst($value).'
                    </a></li>';
                }else{
                    $html .= '<li class="nav-item"><a  class="nav-link"href="'.trim(Barrio::urlBase().'/'.$key).'">
                        '.ucfirst($value).'
                    </a></li>';
                }
            }
        }
    }
    return $html;
}


/**
 * Get blog info fron config
 */
function blog($name = ''){
    $blog = Barrio::$config['blog'];
    $lang = (Barrio::urlSegment(0)) ?  Barrio::urlSegment(0) : 'es';
    if(array_key_exists($lang, $blog)){
        return $blog[$lang][$name];
    }
}


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
function isHome()
{
    $url = Barrio::urlSegment(0);
    if (empty($url)) {
        return true;
    }
}




// Shortcodes theme
require 'funciones/shortcodes.php';
require 'funciones/aciones.php';
