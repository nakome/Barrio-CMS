<?php  defined('BARRIO') or die('Sin accesso a este script.');

if (!function_exists('arrayOfMenu')) {
    /**
     * Transform array to menu
     *
     * @param array $nav the array of navigaiton
     * 
     * @return string
     */
    function arrayOfMenu($nav)
    {
        $html = '';
        foreach ($nav as $k => $v) {
            // key exists
            if (array_key_exists($k, $nav)) {
                // not empty
                if ($k != '') {
                    // external page
                    if (preg_match("/http/i", $k)) {
                        $html .= '<li class="nav-item"><a class="nav-link" href="'.$k.'">'.ucfirst($v).'</a></li>';
                    } else {
                        // is array
                        if (is_array($v)) {
                            // dropdown
                            $html .= '<li class="nav-item dropdown">';
                            $html .= '  <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">'.ucfirst($k).'</a>';
                            $html .= '<ul class="dropdown-menu" aria-labelledby="navbarDropdown"> '.arrayOfMenu($v).'</ul>';
                            $html .= '</li>';
                        } else {
                            // active page
                            $active = Barrio::urlCurrent();
                            if ($active == $k) {
                                $html .= '<li class="nav-item "><a  class="nav-link active"href="'.trim(Barrio::urlBase().'/'.$k).'">
                                    '.ucfirst($v).'
                                </a></li>';
                            } else {
                                $html .= '<li class="nav-item"><a  class="nav-link"href="'.trim(Barrio::urlBase().'/'.$k).'">
                                    '.ucfirst($v).'
                                </a></li>';
                            }
                        }

                    }
                }
            }
        }
        // show html
        return $html;
    }
}


if (!function_exists('menu')) {
    /**
     * Menu
     *
     * @return string
     */
    function menu()
    {
        $arr = Barrio::$config[ 'menu' ];
        $key = Barrio::urlSegment(0);
        $nav = $arr[$key];
        $html = '';
        // key in array exits !
        if (array_key_exists($key, $arr)) {
            $html .= arrayOfMenu($nav);
            return $html;
        }
    }
}

if (!function_exists('blog')) {
    /**
     * Get blog info fron config
     *
     * @param string $name the name of array
     * 
     * @return string
     */
    function blog($name = '')
    {
        $blog = Barrio::$config['blog'];
        $lang = (Barrio::urlSegment(0)) ?  Barrio::urlSegment(0) : Barrio::$config['lang'];
        if (array_key_exists($lang, $blog)) {
            return $blog[$lang][$name];
        }
    }
}



/**
*  Galeria
*   {Galeria}
*       Imagen
*   {/Galeria}
*/
Barrio::shortCodeAdd('Galeria', function ($attrs, $contenido) {
    extract($attrs);
    $content  = '<div id="mansory">';
    $content .=      $contenido;
    $content .= '</div>';
    $resultado = Barrio::applyFilter('content',$content);
    $resultado = preg_replace('/\s+/', ' ', $resultado);

    if ($contenido) {
        return $resultado;
    } else {
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Este shortocode le falta el contenido</span>";
    }
});

/**
*  Imagen
*  {Imagen title='project' texto='El texto' img='{url}/content/imagenes/pequenas/1.jpg'}
*/
Barrio::shortcodeAdd('Imagen', function ($atributos) {
    extract($atributos);
    // atributos
    $link = (isset($link)) ? $link : '#';
    $img = (isset($img)) ? $img : '';
    $title = (isset($title)) ? $title : '';
    $texto = (isset($texto)) ? $texto : '';

    $discover = (Barrio::urlSegment(0) == 'es') ? 'Descubre' : 'Discover';

    // si no hay imagen el shortcode no funciona
    if ($img) {
        $html = '<div class="grid-image">';
        $html .= '<a href="'.$link.'" class="black-image-project-hover">';
        $html .= '  <img src="'.$img.'" alt="Image" class="img-responsive">';
        $html .= '</a>';
        $html .= '<a href="'.$link.'"  class="card-container">';
        $html .= '  <h3>'.$title.'</h3>';
        $html .= '  <p>'.$texto.'</p>';
        $html .= '</a>';
        $html .= '</div>';
        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
    } else {
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Este shortocode le falta el imagen</span>";
    }
});