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

if (!function_exists('primary_post')) {
    /**
     * Obtener el primer articulo.
     */
    function primary_post(string $name = 'blog', int $num = 1)
    {
        $articulos = Barrio::run()->getHeaders($name, 'date', 'DESC', ['index', '404'], $num);

        $html = '';
        foreach ($articulos as $articulo) {
            
            $date = date('d/m/Y', $articulo['date']);
            $image = '';

            if ($articulo['image']) {
                $src = '';
                if (preg_match('/http/s', $articulo['image'])) {
                    $src = $articulo['image'];
                } else {
                    $src = $articulo['image'];
                }
                $image = '<div class="box-post ratio ratio-16x9">
                    <img class="img-thumbnail shadow" src="'.$src.'" />
                </div>';
            }

            $html .= '<div class="row mb-5"><div class="col-md-6">';
            if ($articulo['image']) {
                $html .= $image;
            } elseif ($articulo['video']) {
                $html .= '<div class="box-post ratio ratio-16x9">
                            <video
                                src="'.$articulo['video'].'"
                                autoplay=""
                                autobuffer=""
                                muted=""
                                loop=""> </video>';
                $html .= '</div>';
            } else {
                $html .= '<div class="box-post ratio ratio-16x9">'.$articulo['title'].'</div>';
            }
            $html .= '  </div>';
            $html .= '  <div class="col-md-6">';
            $html .= '      <h2 class="text-ultra mb-3">'.$articulo['title'].'</h2>';
            $html .= '      <p class="mb-3">'.$articulo['description'].'</p>';

            // atributos
            if ($articulo['attrs']) {
                $attrs = $articulo['attrs'];
                $html .= generateAttrs($attrs);
            }
            $html .= '      <p><a class="btn btn-sm btn-dark" href="'.$articulo['url'].'"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-folder-symlink" viewBox="0 0 16 16"><path d="M11.798 8.271l-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742z"/><path d="M.5 3l.04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm.694 2.09A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09l-.636 7a1 1 0 0 1-.996.91H2.826a1 1 0 0 1-.995-.91l-.637-7zM6.172 2a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/></svg><span class="ms-2">Ver mas</span></a></p>';
            $html .= '  </div>';
            $html .= '</div>';
        }
        echo $html;
    }
}