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
                                $html .= '<li class="nav-item "><a  class="nav-link active"href="'.trim(Barrio::urlBase().$k).'">
                                    '.ucfirst($v).'
                                </a></li>';
                            } else {
                                $html .= '<li class="nav-item"><a  class="nav-link"href="'.trim(Barrio::urlBase().$k).'">
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
        $nav = $arr;
        $html = arrayOfMenu($nav);
        return $html;
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
        return $blog[$name];
    }
}

if (!function_exists('config')) {
    /**
     * Get config data
     *
     * @param string $name the name of array
     * 
     * @return string
     */
    function config($name = '')
    {
        if($name){
            return Barrio::$config[$name];
        }
    }
}

