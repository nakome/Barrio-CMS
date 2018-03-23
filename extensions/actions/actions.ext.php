<?php


/**
 * ================================
 *          Funciones
 * ================================
 */

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


/**
 * ================================
 *          Acciones
 * ================================
 */
Barrio::actionAdd('navigation', function(){
    $arr = Barrio::$config[ 'menu' ];
    $nav = $arr;
    $html = arrayOfMenu($nav);
    echo $html;
});

/** Buscador de archivos
 -------------------------------------------- */
Barrio::actionAdd('theme_before', function () {

    $language = Barrio::$config['search'];

    // en la barra de busqueda seria algo asi
    // http://localhost/cmsbarrio/?buscar=
    if (isset($_POST['buscar'])) {
        // el nombre a buscar
        // http://localhost/cmsbarrio/?buscar=Hola
        // $query = hola
        $query = $_POST['buscar'];
        // comprobamos que hay algo para buscar
        if ($query) {
            // obtenemos todas las paginas que hay en la carpeta content
            // si quisiéramos buscar solo en artículos usamos /articulos
            $data = Barrio::pages('/', 'date', 'DESC', ['404'], '');
            // cogemos las 5 primeras letras
            $name = urlencode(substr(trim($query), 0, 5));
            // iniciamos el array y el total
            $results = array();
            $total = 0;
            // hacemos un loop y buscamos en los resultados
            foreach ($data as $item) {
                // remplazamos la direccion local por la url del dominio
                $root = str_replace(Barrio::urlBase(), CONTENT, $item['url']);
                // decodificamos la url
                $name = urldecode($name);
                // comprobamos que exista con preg_match
                // title, description y slug
                if (preg_match("/$name/i", $item['title']) || preg_match("/$name/i", $item['description']) || preg_match("/$name/i", $item['slug'])) {
                    // si hay éxito lo ponemos en el array
                    $results[]= array(
                      'title' => (string) $item['title'],
                      'description' => (string) $item['description'],
                      'url' => (string) $item['url']
                    );
                    // contamos los resultados
                    $total++;
                }
            }
            // iniciamos el resultado
            $html = '<p class="text-primary">'.$language['results_of'].' <span class="text-danger ml-2">'.$total.'</span></p>';
            // creamos un loop con los resultados
            foreach ($results as $page) {
                $html .= '<div class="card p-3 mb-2">';
                $html .= '  <h3>'.$page['title'].'</h3>';
                $html .= '  <p>'.$page['description'].'</p>';
                // creamos un boton para ir a la pagina con $page['url']
                $html .= '  <a class="btn btn-link" href="'.$page['url'].'">'.$language['read'].'</a>';
                $html .= '</div>';
            }
            // si hay resultados los enseñamos
            if ($results) {
                echo $html;
                // si no ponemos que no hay resultados
            } else {
                $html .= '<div class="card p-3 mb-2">';
                $html .= '  <h3>'.$language['no_results'].' '.$query.'</h3>';
                $html .= '</div>';
                echo $html;
            }
        }
    }
});

/** Paginación
 -------------------------------------------- */
Barrio::actionAdd('Pagination', function ($name, $num = 3) {
    // All pages
    $posts = Barrio::pages($name, 'date', 'DESC', ['index','404']);
    // Limit of pages
    $limit = $num;
    //intialize a new array of files that we want to show
    $blogPosts = array();
    if ($posts) {
        //add a file to the $goodfiles array if its name doesn't begin with a period
        foreach ($posts as $f) {
            // Insert one or more elements in array
            array_push($blogPosts, $f);
        }
        // Divide an array into fragments
        $articulos = array_chunk($blogPosts, $limit);
        // Get page
        $pgkey = isset($_GET['page']) ? $_GET['page'] : 0;

        $items = $articulos[$pgkey];

        $html = '<section class="posts">';
        foreach ($items as $articulo) {

            $date =  date('d/m/Y', $articulo['date']);

            $html .= '<article class="post">';

            if ($articulo['image']) {
                $html .= '<div class="post-image"><img src="'.$articulo['image'].'" /></div>';
            }
            // header
            $html .= '<hgroup class="post-header">';
            $html .= '  <h3 class="post-title"> <a href="'.$articulo['url'].'">'.$articulo['title'].'</a></h3>';
            $html .= '  <p class="post-description">';
            $html .= '     <b>'.$date.' </b>  - '.$articulo['description'];
            $html .= '  </p>';
            $html .= '</hgroup>';

            // body
            $html .= '<section class="post-body">'.$articulo['content_short'].' ... <a class="post-read-more" href="'.$articulo['url'].'">Leer mas &rarr;</a></section>';
            $html .= '</article>';
        }
        $html .= '</section>';

        echo $html;
        

        // total = post / limit - 1
        $total = ceil(count($posts)/$limit);
        // If empty active first
        $p = 0;
        if (empty($_GET['page'])) {
            $p = 0;
        } else {
            $p = isset($_GET['page']) ? $_GET['page'] : 0;
        }

        if(count($posts) > $num){

            // pagination
            $pagination = '<ul class="pagination">';
            // first
            $class = ($p == 0) ? "disabled" : "";
            $pagination .= '<li class="page-item '.$class.'"><a class="page-link" href="?page='.($p - 1).'">&laquo;</a></li>';
            if ($p > 0) {
                $pagination .= '<li class="page-item"><a class="page-link" href="?page=0">Primera</a></li>';
                $pagination .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }

            // loop numbers
            $s = max(1, $p - 5);
            for (; $s < min($p+ 6, ($total - 1)); $s++) {
                if ($s==$p) {
                    $class = ($p == $s) ? "active" : "";
                    $pagination .= '<li class="hide-mobile page-item '.$class.'"><a class="page-link" href="?page='.$s.'">'.$s.'</a></li>';
                } else {
                    $class = ($p == $s) ? "active" : "";
                    $pagination .= '<li class="hide-mobile page-item '.$class.'"><a class="page-link" href="?page='.$s.'">'.$s.'</a></li>';
                }
            }

            // last
            if ($p < ($total - 1)) {
                $pagination .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
                $pagination .= '<li class="page-item"><a class="page-link" href="?page='.($total - 1).'">Ultima</a></li>';
            }
            // arrow right
            $class = ($p == ($total - 1)) ? "disabled" : "";
            $pagination .= '<li class="page-item '.$class.'"><a class="page-link" href="?page=' . ($p + 1) . '">&raquo;</a></li>';
            $pagination .= '</ul>';
            echo $pagination;
        }
    }

});

/** Ultimos Articulos
-------------------------------------------------*/
Barrio::actionAdd('lastPosts', function ($num = 4,$name = '') {
    $articulos = Barrio::pages($name, 'date', 'DESC', ['index','404'], $num);
    $html = '<div class="lastPosts">';
    foreach ($articulos as $articulo) {
        $date =  date('d/m/Y', $articulo['date']);
        $html .= '<div class="lastPost">';
        $html .= '<a href="'.$articulo['url'].'">'.$articulo['title'].'</a> - <span class="date">'.$date.' </span>';
        $html .= '</div>';
    }
    $html .= '</div>';
    echo $html;
});



