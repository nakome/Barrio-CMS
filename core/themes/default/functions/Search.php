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
use Action\Action as Action;


if (!function_exists('search')) {
    /*
     * Accion de buscar
     */
    Action::add('theme_after', 'search');
    function search()
    {
        $language = Barrio::$config['search'];
        // demo http://localhost/cmsbarrio/?buscar=
        if (isset($_POST['buscar'])) {
            // http://localhost/cmsbarrio/?buscar=Hola
            // $query = hola
            $query = $_POST['buscar'];
            // check query
            if ($query) {
                $name = '/';
                $num = 0;
                // get pages
                $data = Barrio::run()->getHeaders($name, 'date', 'DESC', ['index', '404'], $num);
                // get 5 words
                $name = urlencode(substr(trim($query), 0, 5));
                // init results and total
                $results = [];
                $total = 0;
                // loop data
                foreach ($data as $item) {
                    // raplace url with data url
                    $root = str_replace(Barrio::urlBase(), CONTENT, $item['url']);
                    // decode
                    $name = urldecode($name);
                    // check title description and slug
                    if (preg_match("/$name/i", $item['title']) ||
                        preg_match("/$name/i", $item['description']) ||
                        preg_match("/$name/i", $item['slug'])) {
                        // if obtain something show
                        $results[] = [
                            'title' => (string) $item['title'],
                            'description' => (string) $item['description'],
                            'url' => (string) $item['url'],
                        ];
                        // count results
                        ++$total;
                    }
                }

                // template
                $output = '';
                foreach ($results as $page) {
                    $output .= '<article>';
                    $output .= '<h3>'.$page['title'].'</h3>';
                    $output .= '<p>'.$page['description'].'</p>';
                    $output .= '<a href="'.$page['url'].'">'.$language['read'].'</a>';
                    $output .= '</article>';
                }

                $html = '<section class="form-results">';
                // if results show
                if ($results) {
                    $html .= $output;
                } else {
                    $html .= $language['no_results'].' '.$query;
                }
                $html .= '</section>';
                echo $html;
            }
        }
    }
}
