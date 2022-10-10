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

use Barrio\Barrio as Barrio;
use Text\Text as Text;

if (!function_exists('posts')) {
    /**
     * Obtener un lista articulos.
     *
     * @param string $name
     * @param int    $num
     * @param string $nav
     */
    function posts($name, $num = 0, $nav = true)
    {
        // obtenemos las cabeceras
        $posts = Barrio::run()->getHeaders($name, 'date', 'DESC', ['index', '404']);
        // limit de la paginacion
        $limit = ($num) ? $num : Barrio::$config['pagination'];
        // init
        $blogPosts = [];

        // si hay articulos y si es array
        if ($posts && is_array($posts)) {
            foreach ($posts as $f) {
                // push on blogposts
                array_push($blogPosts, $f);
            }
            // dividimos en fragmentos para la paginacion
            $articulos = array_chunk($blogPosts, $limit);
            // obtenemos el numero
            $pgkey = isset($_GET['page']) ? $_GET['page'] : 0;
            $items = $articulos[$pgkey];
            $html = '<div class="row">';
            foreach ($items as $articulo) {
                $date = (date('d/m/Y', (int) $articulo['date'])) ? date('d/m/Y', (int) $articulo['date']) : date('d/m/Y');
                $html .= '<div class="col-xl-6 col-md-6 mb-4">
                <div class="card shadow mb-3">';
                if (preg_match('/http/s', $articulo['image'])) {
                    if ($articulo['image']) {
                        $html .= '<img src="'.$articulo['image'].'"/>';
                    } else {
                        $html .= '<div class="box-post ratio ratio-16x9">'.$articulo['title'].'</div>';
                    }
                } else {
                    if ($articulo['image']) {
                        $src = Barrio::urlBase().'/'.$articulo['image'];
                        $html .= '<img src="'.imageToDataUri($src).'" alt="'.$articulo['title'].'"/>';
                    } else {
                        $html .= '<div class="box-post ratio ratio-16x9">'.$articulo['title'].'</div>';
                    }
                }
                $html .= '<div class="card-body">
                    <h4 class="card-title mb-3">'.$articulo['title'].'</h4>
                    <p class="card-subtitle mb-3"><b>'.Barrio::$config['blogdate'].':</b> '.$date.'</p>
                    <p class="card-text mb-2">'.Text::short($articulo['description'], 50).'</p>
                    <a href="'.$articulo['url'].'" class="btn btn-sm btn-dark my-3 float-end"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-folder-symlink" viewBox="0 0 16 16"><path d="M11.798 8.271l-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742z"/><path d="M.5 3l.04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm.694 2.09A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09l-.636 7a1 1 0 0 1-.996.91H2.826a1 1 0 0 1-.995-.91l-.637-7zM6.172 2a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/></svg><span class="ms-2">'.Barrio::$config['readmore'].'</span></a>
                  </div>
                </div></div><!-- / post -->';
            }
            $html .= '</div><!-- / posts -->';

            // print
            echo $html;

            // total = post / limit - 1
            $total = ceil(count($posts) / $limit);

            // if empty start in 0
            $p = 0;
            if (empty($_GET['page'])) {
                $p = 0;
            } else {
                $p = isset($_GET['page']) ? $_GET['page'] : 0;
            }

            if (count($posts) > $limit) {
                // pagination
                $pagination = '<nav class="pt-3 overflow-hidden">';
                if ($p > 0) {
                    $pagination .= '<a class="btn btn-dark float-start me-2" href="'.url().'/'.urlCurrent().'?page='.($p - 1).'"><span aria-hidden="true">&laquo;</span> Anteriores</a>';
                }

                $disabled = ($p == ($total - 1)) ? 'class="btn-dark btn disabled"' : 'class="btn float-end btn-dark" href="'.url().'/'.urlCurrent().'?page='.($p + 1).'"';

                $pagination .= '<a  '.$disabled.'> Siguientes <span aria-hidden="true">&raquo;</span></a>';
                $pagination .= '</nav>';
                // print
                if ($nav) {
                    echo $pagination;
                }
            }
        }
    }
}