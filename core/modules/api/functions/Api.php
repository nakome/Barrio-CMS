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

include 'Filters.php';

class Api
{
    /**
     *  Render json.
     *
     *  @return array
     */
    public function json(array $data = [])
    {
        @header('Content-Type: application/json');
        exit(json_encode($data));
    }

    /**
     *  Resize image.
     *
     *  @param string $url
     *  @param string $width
     *  @param string $height
     *  @param int $quality
     *
     *  @return string image
     */
    public function resizeImg($url, $width, $height, $quality = 70)
    {
        return ResizeImages($url, $width, $height, $quality = 70);
    }

    /**
     *  Pages.
     *
     *  @return array
     */
    public function pages()
    {
        // check if exists name
        if (array_key_exists('name', $_GET)) {
            // init ApiFilter class
            $ApiFilter = new ApiFilter();
            // get name or null
            $name = ($_GET['name']) ? $_GET['name'] : 'blog';
            // check if is a dir
            if (is_dir(CONTENT.'/'.$name)) {
                // filter data
                if (array_key_exists('filter', $_GET)) {
                    // get filter
                    $filter = ($_GET['filter']) ? $_GET['filter'] : null;
                    // get pages
                    $pages = Barrio::run()->getHeaders($name, 'date', 'DESC', ['index', '404'], null);
                    // init output
                    $output = [];
                    // switch
                    switch ($filter) {
                        // index.php?api=file&data=pages&name=blog&filter=count
                        case 'count': // count
                            $arr = ['total' => count($pages)];
                            // push array
                            array_push($output, $arr);
                            break;
                        // index.php?api=file&data=pages&name=blog&filter=filtername
                        default:
                             $output = $ApiFilter->Attrs($output, $pages, $filter);
                            break;
                    }
                    // print json
                    $this->json($output);
                }
                // index.php?api=file&data=pages&name=blog&limit=3
                elseif (array_key_exists('limit', $_GET)) {
                    $limit = ($_GET['limit']) ? $_GET['limit'] : 3;
                    $output = $ApiFilter->Limit($name, $limit);
                    // print json
                    $this->json($output);
                } else {
                    // index.php?api=file&data=pages&name=blog
                    $output = $ApiFilter->Group($name);
                    // print json
                    $this->json($output);
                }
            }
        }
        $this->json(['status' => false]);
    }

    /**
     *  Pages.
     *
     *  @return array
     */
    public function page()
    {
        // index.php?api=file&data=page&name=blog
        // check if exists name
        if (array_key_exists('name', $_GET)) {
            // get name or null
            $name = ($_GET['name']) ? $_GET['name'] : '';
            $page = Barrio::run()->page($name);

            $ApiFilter = new ApiFilter();
            $arr = $ApiFilter->Parse($page);

            // print json
            $this->json($arr);
        }
        $this->json(['status' => false]);
    }

    /**
     *  File method.
     *
     *  @return array
     */
    public function file()
    {
        if (array_key_exists('data', $_GET)) {
            $data = ($_GET['data']) ? $_GET['data'] : null;

            switch ($data) {
                // index.php?api=file&data=pages
                case 'pages':$this->pages();
                    break;
                // index.php?api=file&data=page
                case 'page':$this->page();
                    break;
            }
        }
        $this->json(['status' => false]);
    }

    /**
     *  Images method.
     *
     *  @return array
     */
    public function image()
    {
        //index.php?api=image&url=public/notfound.jpg
        if (array_key_exists('url', $_GET)) {
            //index.php?api=image&url=public/notfound.jpg&w=1024
            if (array_key_exists('w', $_GET)) {
                //index.php?api=image&url=public/notfound.jpg&w=1024&h=768
                if (array_key_exists('h', $_GET)) {
                    if (array_key_exists('q', $_GET)) {
                        $this->resizeImg($_GET['url'], $_GET['w'], $_GET['h'], $_GET['q']);
                    } else {
                        $this->resizeImg($_GET['url'], $_GET['w'], $_GET['h']);
                    }
                } else {
                    if (array_key_exists('q', $_GET)) {
                        $this->resizeImg($_GET['url'], $_GET['w'], ($_GET['w'] / 2), $_GET['q']);
                    } else {
                        $this->resizeImg($_GET['url'], $_GET['w'], ($_GET['w'] / 2));
                    }
                }
            } elseif (array_key_exists('q', $_GET)) {
                $this->resizeImg($_GET['url'], 320, 180, $_GET['q']);
            } else {
                $this->resizeImg($_GET['url'], 320, 180, 50);
            }
        }
    }

    /**
     *  Manifest method.
     *
     *  @return array
     */
    public function manifest()
    {
        $iconUrl = Barrio::urlBase().'/core/themes/'.Barrio::$config['theme'].'/assets/icons';
        $json = [
            'name' => Barrio::$config['title'],
            'short_name' => Barrio::$config['title'],
            'start_url' => Barrio::urlBase(),
            'display' => Barrio::$config['display'],
            'theme_color' => Barrio::$config['theme_color'],
            'background_color' => Barrio::$config['background_color'],
            'orientation' => Barrio::$config['orientation'],
            'icons' => [
                'src' => "$iconUrl/android-chrome-144x144.png",
                'sizes' => '144x144',
                'type' => 'image/png',
            ],
        ];
        // render json
        $this->json($json);
    }

    /**
     *  Sitemap method.
     *
     *  @return array
     */
    public function sitemap()
    {
        $pages = Barrio::run()->pages('', 'date', 'DESC');
        $html = '<?xml version="1.0" encoding="UTF-8"?>';
        $html .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($pages as $page) {
            $url = trim(Barrio::urlBase().'/'.$page['slug']);
            $date = (int) $page['date'];
            $html .= '<url>
              <loc>'.$url.'</loc>
              <lastmod>'.date('c', $date).'</lastmod>
           </url>';
        }
        $html .= '</urlset>';
        exit($html);
    }

    /**
     *  help method.
     *
     *  @return array
     */
    public function help()
    {
        $file = MODULES.'/api/help/index.php';
        $site_url = Barrio::urlBase();
        exit(file_get_contents($file));
    }
}
