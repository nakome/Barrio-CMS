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
use Shortcode\Shortcode as Shortcode;

class ApiFilter
{
    /**
     * Get default array.
     *
     * @param array $output
     * @param array $pages
     *
     * @return array $output
     */
    public function CreateArray($output, $pages)
    {
        foreach ($pages as $item) {
            $arr = [
                'slug' => $item['slug'],
                'url' => $item['url'],
                'title' => $item['title'],
                'description' => $item['description'],
                'tags' => $item['tags'],
                'author' => $item['author'],
                'image' => $item['image'],
                'date' => $item['date'],
                'robots' => $item['robots'],
                'keywords' => $item['keywords'],
                'template' => $item['template'],
                'published' => $item['published'],
                'background' => $item['background'],
                'video' => $item['video'],
                'color' => $item['color'],
                'css' => $item['css'],
                'javascript' => $item['javascript'],
                'attrs' => $item['attrs'], // = [1,2,true,'string']
                'json' => $item['json'], // = /content/data/test.json
                'password' => $item['password'], // for page with password
            ];
            // push array
            array_push($output, $arr);
        }

        return $output;
    }

    /**
     * Get array of pages.
     *
     * @return array $output
     */
    public function Group(string $name = '')
    {
        // get pages
        $pages = Barrio::run()->pages($name, 'date', 'DESC', ['index', '404'], null);
        // init array
        $output = [];
        $output = $this->CreateArray($output, $pages);

        return $output;
    }

    /**
     * Get array of pages with limit.
     *
     * @return array $output
     */
    public function Limit(string $name = '', string $limit = '3')
    {
        // get pages
        $pages = Barrio::run()->pages($name, 'date', 'DESC', ['index', '404'], $limit);
        // init array
        $output = [];
        $output = $this->CreateArray($output, $pages);

        return $output;
    }

    /**
     * Default array for filter.
     *
     * @return array $output
     */
    public function Attrs(array $output = [], array $pages = [], string $type = '')
    {
        foreach ($pages as $item) {
            $arr = ['slug' => $item['slug'], $type => $item[$type]];
            // push array
            array_push($output, $arr);
        }

        return $output;
    }

    /**
     * Get array of page.
     *
     * @return array $output
     */
    public function Parse(array $page = [])
    {
        // Load parsedown
        include MODULES.'/markdown/Parsedown.php';
        // include shortcodes
        include MODULES.'/shortcodes/shortcodes.module.php';

        // parse content
        $content = Shortcode::parse($page['content']);
        $_content = Parsedown::instance()->text(Shortcode::parse($content));
        // parse content
        $__content = Shortcode::parse($_content);
        $___content = Parsedown::instance()->text(Shortcode::parse($__content));
        // parse content
        $____content = Shortcode::parse($___content);
        $outputContent = Parsedown::instance()->text(Shortcode::parse($____content));
        // array
        $arr = [
            'slug' => $page['slug'],
            'title' => $page['title'],
            'description' => $page['description'],
            'tags' => $page['tags'],
            'author' => $page['author'],
            'image' => $page['image'],
            'date' => $page['date'],
            'robots' => $page['robots'],
            'keywords' => $page['keywords'],
            'template' => $page['template'],
            'published' => $page['published'],
            'background' => $page['background'],
            'video' => $page['video'],
            'color' => $page['color'],
            'css' => $page['css'],
            'javascript' => $page['javascript'],
            'attrs' => $page['attrs'], // = [1,2,true,'string']
            'json' => $page['json'], // = /content/data/test.json
            'password' => $page['password'], // for page with password
            'content' => $outputContent,
        ];

        return $arr;
    }
}
