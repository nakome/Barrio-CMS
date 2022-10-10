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

use Action\Action as Action;
use Barrio\Barrio as Barrio;

if (!function_exists('assets')) {
    /**
     * Assets
     *
     * @param string $source
     *
     * @return string
     */
    function assets(string $source = "")
    {
        $themeName = config('theme');
        $folder = url() . '/core/themes/' . $themeName . '/assets/' . $source;
        return $folder;
    }
}
if (!function_exists('action')) {
    /**
     * Action
     *
     * @param string $name
     *
     * @return Action
     */
    function action(string $name = "")
    {
        return Action::run($name);
    }
}
if (!function_exists('config')) {
    /**
     * Config
     *
     * @param string $name
     *
     * @return string
     */
    function config(string $name = "")
    {
        return (Barrio::$config[$name]) ? Barrio::$config[$name] : "";
    }
}
if (!function_exists('url')) {
    /**
     * Site url
     *
     * @return string
     */
    function url()
    {
        return Barrio::urlBase();
    }
}
if (!function_exists('urlCurrent')) {
    /**
     * Current url
     *
     * @return string
     */
    function urlCurrent()
    {
        return Barrio::urlCurrent();
    }
}
if (!function_exists('imageToDataUri')) {
    /**
     * Convertir imagen a Data uri
     *
     * @param string $source
     *
     * @return string
     */
    function imageToDataUri(string $source)
    {
        $img = str_replace(Barrio::urlBase(), ROOT_DIR, $source);
        // Read image path, convert to base64 encoding
        $imageData = base64_encode((string) file_get_contents($img));
        // Format the image SRC:  data:{mime};base64,{data};
        $src = 'data: ' . mime_content_type($img) . ';base64,' . $imageData;
        return $src;
    }
}
if (!function_exists('arrayOfMenu')) {
    /**
     * Generar un menu
     *
     * @param array $nav
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
                        $html .= '<a href="' . $k . '">' . ucfirst($v) . '</a>';
                    } else {
                        // is array
                        if (is_array($v)) {
                            // dropdown
                            $id = uniqid();
                            $html .= '<div class="dropdown">';
                            $html .= '  <a id="' . $id . '" href="#">' . ucfirst($k) . '</a>';
                            $html .= '<div class="dropdown-menu" aria-labelledby="' . $id . '">
                            ' . arrayOfMenu($v) . '</div>';
                            $html .= '</div>';
                        } else {
                            $active = Barrio::urlSegment(0);
                            $activeurl = str_replace('/', '', $k);
                            if ($active == $activeurl) {
                                $html .= '<a class="active" href="' . trim(Barrio::urlBase() . $k) . '">
                                    ' . ucfirst($v) . '</a>';
                            } else {
                                $html .= '<a href="' . trim(Barrio::urlBase() . $k) . '">' . ucfirst($v) . '</a>';
                            }
                        }
                    }
                }
            }
        }
        // show html
        // array del menu
        return $html;
    }
}
if (!function_exists('menu')) {
    /**
     * Metodo menu
     *
     * @return array
     */
    function menu()
    {
        // array del menu
        $nav = Barrio::$config['menu'];
        $navigation = arrayOfMenu($nav);
        return $navigation;
    }
}
if (!function_exists('posts')) {
    /**
     * Obtener un lista articulos
     *
     * @param string $name
     * @param int $num
     * @param string $nav
     */
    function posts($name, $num = 0, $nav = true)
    {
        // get pages
        $posts = Barrio::run()->getHeaders($name, 'date', 'DESC', ['index', '404']);
        // limit
        $limit = ($num) ? $num : Barrio::$config['pagination'];
        // init
        $blogPosts = array();

        if ($posts) {
            foreach ($posts as $f) {
                // push on blogposts
                array_push($blogPosts, $f);
            }
            // fragment
            $articulos = array_chunk($blogPosts, $limit);
            // get number
            $pgkey = isset($_GET['page']) ? $_GET['page'] : 0;
            $items = $articulos[$pgkey];
            $html = '';
            foreach ($items as $articulo) {
                $date = date('d/m/Y', (int) $articulo['date']);
                $html .= '<article><header>
                    <h3><a href="' . $articulo['url'] . '">' . $articulo['title'] . '</a></h3>
                    <p><b>' . Barrio::$config['blogdate'] . ':</b> ' . $date . '</p>
                  </header>
                  <section>
                        <p>' . $articulo['description'] . '</p>
                  </section></article><!-- / post -->';
            }
            $html .= '<!-- / posts -->';

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
                $pagination = '<nav>';
                if ($p > 0) {
                    $pagination .= '<a href="?page=' . ($p - 1) . '"><span aria-hidden="true">&laquo;</span> Anteriores</a>';
                }
                $disabled = ($p == ($total - 1)) ? 'class="disabled"' : 'href="?page=' . ($p + 1) . '"';
                $pagination .= '<a  ' . $disabled . '> Siguientes <span aria-hidden="true">&raquo;</span></a>';
                $pagination .= '</nav>';
                // print
                if ($nav) {
                    echo $pagination;
                }
            }
        }
    }
}
if (!function_exists('navFolder')) {
    /**
     * Metodo navFolder
     */
    function navFolder()
    {
        $source = CONTENT . '/' . trim(Barrio::urlSegment(0));
        if (is_dir($source)) {
            $pages = Barrio::run()->getHeaders(trim(Barrio::urlSegment(0)), 'date', 'DESC', array('index', '404'));
            if (count($pages) > 1) {
                $url = trim(Barrio::urlCurrent());
                $site_url = trim(Barrio::urlBase() . '/' . Barrio::urlSegment(0));
                $html = '<nav>';
                if ($pages) {
                    foreach ($pages as $k => $v) {
                        $slug = Barrio::urlSegment(0) . '/' . $pages[$k]['slug'];
                        if ($url == $slug) {
                            $separator = '<span style="margin: 0 3em"></span>';

                            if (isset($pages[$k - 1]) != null) {
                                $html .= '<a href="' . $site_url . '/' . $pages[$k - 1]['slug'] . '">
                                    <span aria-hidden="true">&laquo;</span>
                                    ' . $pages[$k - 1]['title'] . '
                                </a>' . $separator;
                            } else {
                                $html .= '<a href="' . $site_url . '">
                                    <span aria-hidden="true">&laquo;</span>
                                    ' . ucfirst(Barrio::urlSegment(0)) . '
                                </a>' . $separator;
                            }

                            if (isset($pages[$k + 1]) != null) {
                                $html .= '<a href="' . $site_url . '/' . $pages[$k + 1]['slug'] . '">
                                    ' . $pages[$k + 1]['title'] . '
                                    <span aria-hidden="true">&raquo;</span>
                                </a>';
                            } else {
                                $html .= '<a href="' . $site_url . '">
                                    ' . ucfirst(Barrio::urlSegment(0)) . '
                                    <span aria-hidden="true">&raquo;</span>
                                </a>';
                            }
                        }
                    }
                }
                $html .= '</nav>';
                echo $html;
            }
        }
    }
}
if (!function_exists('search')) {
    /**
     * Metodo search
     */
    Action::add('theme_after', "search");
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
                $results = array();
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
                        $results[] = array(
                            'title' => (string) $item['title'],
                            'description' => (string) $item['description'],
                            'url' => (string) $item['url'],
                        );
                        // count results
                        $total++;
                    }
                }

                // template
                $output = '';
                foreach ($results as $page) {
                    $output .= '<article>';
                    $output .= '<h3>' . $page['title'] . '</h3>';
                    $output .= '<p>' . $page['description'] . '</p>';
                    $output .= '<a href="' . $page['url'] . '">' . $language['read'] . '</a>';
                    $output .= '</article>';
                }

                $html = '<section class="form-results">';
                // if results show
                if ($results) {
                    $html .= $output;
                } else {
                    $html .= $language['no_results'] . ' ' . $query;
                }
                $html .= '</section>';
                echo $html;
            }
        }
    }
}
