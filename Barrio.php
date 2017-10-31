<?php


/**
 * Barrio CMS
 *
 * @author    Moncho Varela / Nakome <nakome@gmail.com>
 * @copyright 2016 Moncho Varela / Nakome <nakome@gmail.com>
 *
 * @version 0.0.1
 *
 */

class Barrio
{
    // constats
    const APPNAME = 'Barrio CMS';
    const VERSION = '0.0.1';
    const SEPARATOR = '----';

    // public config
    public static $config;

    // private vars
    private static $extensions = array();
    protected static $shortcode_tags = array();
    protected static $filters = array();
    private static $actions = array();

    // Header vars
    private $headers = array(
        'title' => 'Title',
        'description' => 'Description',
        'tags' => 'Tags',
        'author' => 'Author',
        'image' => 'Image',
        'date' => 'Date',
        'robots' => 'Robots',
        'keywords' => 'Keywords',
        'template' => 'Template',
        'published' => 'Published'
        );

    /**
     * Add action.
     *
     *  <code>
     *      Barrio::actionAdd('demo',function(){});
     *  </code>
     *
     * @param <type> $name     The name
     * @param <type> $func     The function
     * @param int    $priority The priority
     * @param array  $args     The arguments
     *
     * @return static
     */
    public static function actionAdd($name, $func, $priority = 10, array $args = null)
    {
        // Hooks a function on to a specific action.
        static::$actions[] = array(
                        'name' => (string) $name,
                        'func' => $func,
                        'priority' => (int) $priority,
                        'args' => $args,
        );
    }



    /**
     * Run action.
     *
     *  <code>
     *      Barrio::actionRun('demo',array());
     *  </code>
     *
     * @param <type> $name   The name
     * @param array  $args   The arguments
     * @param bool   $return The return
     *
     * @return <type> ( description_of_the_return_value )
     */
    public static function actionRun($name, $args = array(), $return = false)
    {
        // Redefine arguments
        $name = (string) $name;
        $return = (bool) $return;
        // Run action
        if (count(static::$actions) > 0) {
            // Sort actions by priority
            $actions = self::shortArray(static::$actions, 'priority');
            // Loop through $actions array
            foreach ($actions as $action) {
                // Execute specific action
                if ($action['name'] == $name) {
                    // isset arguments ?
                    if (isset($args)) {
                        // Return or Render specific action results ?
                        if ($return) {
                            return call_user_func_array($action['func'], $args);
                        } else {
                            call_user_func_array($action['func'], $args);
                        }
                    } else {
                        if ($return) {
                            return call_user_func_array($action['func'], $action['args']);
                        } else {
                            call_user_func_array($action['func'], $action['args']);
                        }
                    }
                }
            }
        }
    }


    /**
     * Shortcode function.
     *
     *  <code>
     *      Barrio::shortcodeAdd('demo',function($args){
     *              // shortcode
     *      });
     *  </code>
     *
     * @param string $shortcode         the name
     * @param array  $callback_function The arguments
     *
     * @return <type> ( description_of_the_return_value )
     */
    public static function shortcodeAdd($shortcode, $callback_function)
    {
        $shortcode = (string) $shortcode;
        if (is_callable($callback_function)) {
            self::$shortcode_tags[$shortcode] = $callback_function;
        }
    }


    /**
     * Shortcode parse.
     *
     * @param string $content the shortcode content
     *
     * @return <type> ( description_of_the_return_value )
     */
    public static function shortcodeParse($content)
    {
        if (!self::$shortcode_tags) {
            return $content;
        }
        $shortcodes = implode('|', array_map('preg_quote', array_keys(self::$shortcode_tags)));
        $pattern = "/(.?)\\{([{$shortcodes}]+)(.*?)(\\/)?\\}(?(4)|(?:(.+?)\\{\\/\\s*\\2\\s*\\}))?(.?)/s";

        return preg_replace_callback($pattern, 'self::shortcodeHandle', $content);
    }


    /**
     * Handle Shortcode
     *
     * @param array $matches the matches
     *
     * @return <type> ( description_of_the_return_value
     */
    protected static function shortcodeHandle($matches)
    {
        $prefix = $matches[1];
        $suffix = $matches[6];
        $shortcode = $matches[2];
        if ($prefix == '{' && $suffix == '}') {
            return substr($matches[0], 1, -1);
        }
        $attributes = array();
        if (preg_match_all('/(\\w+) *= *(?:([\'"])(.*?)\\2|([^ "\'>]+))/', $matches[3], $match, PREG_SET_ORDER)) {
            foreach ($match as $attribute) {
                if (!empty($attribute[4])) {
                    $attributes[strtolower($attribute[1])] = $attribute[4];
                } elseif (!empty($attribute[3])) {
                    $attributes[strtolower($attribute[1])] = $attribute[3];
                }
            }
        }

        return isset(self::$shortcode_tags[$shortcode]) ? $prefix.call_user_func(self::$shortcode_tags[$shortcode], $attributes, $matches[5], $shortcode).$suffix : '';
    }

    /**
     * C.O.R.S function.
     *
     * <code>
     *      Barrio::cors();
     * </code>
     *
     * @return <type>
     */
    public static function cors()
    {
        // Allow from any origin
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
            // you want to allow, and if so:
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }
        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
                header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
            }
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
            }
            exit(0);
        }
    }

    /**
     * Get url base
     *
     * <code>
     *   Barrio::urlBase();
     * </code>
     *
     * @return string url
     */
    public static function urlBase()
    {
        $https = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? 'https://' : 'http://';
        return $https . rtrim(rtrim($_SERVER['HTTP_HOST'], '\\/') . dirname($_SERVER['PHP_SELF']), '\\/');
    }

    /**
     * Get current url.
     *
     * <code>
     *  Barrio::urlCurrent();
     * </code>
     *
     * @return string url
     */
    public static function urlCurrent()
    {
        $url = '';
        $request_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        $script_url = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : '';
        if ($request_url != $script_url) {
            $url = trim(preg_replace('/'.str_replace('/', '\\/', str_replace('index.php', '', $script_url)).'/', '', $request_url, 1), '/');
        }
        $url = preg_replace('/\\?.*/', '', $url);

        return $url;
    }

    /**
     * Uri Segments.
     *
     * <code>
     *  Barrio::urlSegments();
     * </code>
     *
     * @return array
     */
    public static function urlSegments()
    {
        return explode('/', self::urlCurrent());
    }

    /**
     * Uri Segment.
     *
     * <code>
     *  Barrio::urlSegment(1);
     * </code>
     *
     * @param string $name the name
     *
     * @return string
     */
    public static function urlSegment($name)
    {
        $segments = self::UrlSegments();

        return isset($segments[$name]) ? $segments[$name] : null;
    }

    /**
     *  Sanitize Url.
     *
     * @param string $url the url
     *
     * @return string url
     */
    public static function urlSanitize($url)
    {
        $url = trim($url);
        $url = rawurldecode($url);
        $url = str_replace(array('--', '&quot;', '!', '@', '#', '$', '%', '^', '*', '(', ')', '+', '{', '}', '|', ':', '"', '<', '>', '[', ']', '\\', ';', "'", ',', '*', '+', '~', '`', 'laquo', 'raquo', ']>', '&#8216;', '&#8217;', '&#8220;', '&#8221;', '&#8211;', '&#8212;', ), array('-', '-', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''), $url);
        $url = str_replace('--', '-', $url);
        $url = rtrim($url, '-');
        $url = str_replace('..', '', $url);
        $url = str_replace('//', '', $url);
        $url = preg_replace('/^\//', '', $url);
        $url = preg_replace('/^\./', '', $url);

        return $url;
    }


    /**
     * Run sanitize
     *
     * @return <type>
     */
    public static function runSanitize()
    {
        $_GET = array_map('Barrio::urlSanitize', $_GET);
    }


    /**
     * Chain method
     *
     * @return new static
     */
    public static function Run()
    {
        return new static();
    }


    /**
     *  Array short
     *
     * @param array $a      array
     * @param array $subkey array
     * @param array $order  null
     *
     * @return value
     */
    public static function shortArray($a, $subkey, $order = null)
    {
        if (count($a) != 0 || (!empty($a))) {
            foreach ($a as $k => $v) {
                $b[$k] = function_exists('mb_strtolower') ? mb_strtolower($v[$subkey]) : strtolower($v[$subkey]);
            }
            if ($order == null || $order == 'ASC') {
                asort($b);
            } elseif ($order == 'DESC') {
                arsort($b);
            }
            foreach ($b as $key => $val) {
                $c[] = $a[$key];
            }

            return $c;
        }
    }

    /**
     * Scan files.
     *
     * <code>
     *  Barrio::scanFiles(CONTENT,'md',false);
     * </code>
     *
     * @param string $folder    the folder
     * @param string $type      extension
     * @param bool   $file_path boolean
     *
     * @return <type>
     */
    public static function scanFiles($folder, $type = null, $file_path = true)
    {
        $data = array();
        if (is_dir($folder)) {
            $iterator = new RecursiveDirectoryIterator($folder);
            foreach (new RecursiveIteratorIterator($iterator) as $file) {
                if ($type !== null) {
                    if (is_array($type)) {
                        $file_ext = substr(strrchr($file->getFilename(), '.'), 1);
                        if (in_array($file_ext, $type)) {
                            if (strpos($file->getFilename(), $file_ext, 1)) {
                                if ($file_path) {
                                    $data[] = $file->getPathName();
                                } else {
                                    $data[] = $file->getFilename();
                                }
                            }
                        }
                    } else {
                        if (strpos($file->getFilename(), $type, 1)) {
                            if ($file_path) {
                                $data[] = $file->getPathName();
                            } else {
                                $data[] = $file->getFilename();
                            }
                        }
                    }
                } else {
                    if ($file->getFilename() !== '.' && $file->getFilename() !== '..') {
                        if ($file_path) {
                            $data[] = $file->getPathName();
                        } else {
                            $data[] = $file->getFilename();
                        }
                    }
                }
            }

            return $data;
        } else {
            return false;
        }
    }


    /**
     * Pretty array
     *
     * <code>
     *  Barrio::prettyArray($array);
     * </code>
     *
     * @param array $a the array to debug
     *
     * @return string
     */
    public static function debug($a = array())
    {
        return die(print("<pre>".print_r($a, true)."</pre>"));
    }

    /**
     * Validate date
     *
     * <code>
     *  Barrio::validateDate($date);
     * </code>
     *
     * @param string $format the format of date
     * @param string $date   the timestamp
     *
     * @return string
     */
    public static function validateDate($format, $date)
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }


    /**
     *  Get pages
     *
     * <code>
     *  $posts = Barrio::pages('blog','date','DESC',array('index','404'),null);
     * </code>
     *
     * @param string $url        Url
     * @param string $order_by   Order by
     * @param string $order_type Order type
     * @param array  $ignore     Pages to ignore
     * @param int    $limit      Limit of pages
     *
     * @return array
     */
    public function pages($url, $order_by = 'date', $order_type = 'DESC', $ignore = array('404'), $limit = null)
    {
        $headers = $this->headers;
        $pages = self::scanFiles(CONTENT.'/'.$url, 'md');
        foreach ($pages as $key => $page) {
            if (!in_array(basename($page, '.md'), $ignore)) {
                $content = file_get_contents($page);
                $_headers = explode(self::SEPARATOR, $content);
                foreach ($headers as $campo => $regex) {
                    if (preg_match('/^[ \\t\\/*#@]*'.preg_quote($regex, '/').':(.*)$/mi', $_headers[0], $match) && $match[1]) {
                        $_pages[$key][$campo] = trim($match[1]);
                    } else {
                        $_pages[$key][$campo] = '';
                    }
                }

                // if not exists date use filemtime
                // and if exists return timestamp
                if (!$_pages[$key]['date']) {
                    $_pages[$key]['date'] = filemtime((string) $page);
                } else {
                    if (self::validateDate('d/m/Y', $_pages[$key]['date'])) {
                        $date = str_replace('/', '-', $_pages[$key]['date']);
                        $_pages[$key]['date'] = strtotime($date);
                    }
                }

                // convert local to url
                $url = str_replace(CONTENT, self::urlBase(), $page);
                $url = str_replace('index.md', '', $url);
                $url = str_replace('.md', '', $url);
                $url = str_replace('\\', '/', $url);
                $url = rtrim($url, '/');

                $_pages[$key]['url'] = $url;

                $_content = $this->parseContent($content);
                if (is_array($_content)) {
                    $_pages[$key]['content_short'] = $_content['content_short'];
                    $_pages[$key]['content'] = $_content['content_full'];
                } else {
                    $_pages[$key]['content_short'] = $_content;
                    $_pages[$key]['content'] = $_content;
                }
                $_pages[$key]['slug'] = basename($page, '.md');
            }
        }
        $_pages = self::shortArray($_pages, $order_by, $order_type);
        if ($limit != null) {
            $_pages = array_slice($_pages, null, $limit);
        }

        return $_pages;
    }


    /**
     *  Get page
     *
     * <code>
     *  $page = Barrio::page('blog');
     * </code>
     *
     * @param string $url the url
     *
     * @return $page (Array)
     */
    public function page($url)
    {
        $headers = $this->headers;
        if ($url) {
            $file = CONTENT.'/'.$url;
        } else {
            $file = CONTENT.'/'.'index';
        }
        // Load the file
        if (is_dir($file)) {
            $file = CONTENT.'/'.$url.'/index.md';
        } else {
            $file .= '.md';
        }
        if (file_exists($file)) {
            $content = file_get_contents($file);
        } else {
            $content = file_get_contents(CONTENT.'/'.'404.md');
            header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
        }
        $_headers = explode(self::SEPARATOR, $content);
        foreach ($headers as $campo => $regex) {
            if (preg_match('/^[ \\t\\/*#@]*'.preg_quote($regex, '/').':(.*)$/mi', $_headers[0], $match) && $match[1]) {
                $page[$campo] = trim($match[1]);
            } else {
                $page[$campo] = '';
            }
        }

        $url = str_replace(CONTENT, static::urlBase(), $file);
        $url = str_replace('index.md', '', $url);
        $url = str_replace('.md', '', $url);
        $url = str_replace('\\', '/', $url);
        $url = rtrim($url, '/');


        $pages['url'] = $url;
        $_content = $this->parseContent($content);
        if (is_array($_content)) {
            $page['content_short'] = $_content['content_short'];
            $page['content'] = $_content['content_full'];
        } else {
            $page['content_short'] = $_content;
            $page['content'] = $_content;
        }
        $page['slug'] = basename($file, '.md');

        return $page;
    }


    /**
     * Apply filter
     *
     * @param string $filter_name The filter name
     * @param string $value       The value
     *
     * @return string ( description_of_the_return_value )
     */
    public static function applyFilter($filter_name, $value)
    {
        // Redefine arguments
        $filter_name = (string) $filter_name;
        $args = array_slice(func_get_args(), 2);
        if (!isset(static::$filters[$filter_name])) {
            return $value;
        }
        foreach (static::$filters[$filter_name] as $priority => $functions) {
            if (!is_null($functions)) {
                foreach ($functions as $function) {
                    $all_args = array_merge(array($value), $args);
                    $function_name = $function['function'];
                    $accepted_args = $function['accepted_args'];
                    if ($accepted_args == 1) {
                        $the_args = array($value);
                    } elseif ($accepted_args > 1) {
                        $the_args = array_slice($all_args, 0, $accepted_args);
                    } elseif ($accepted_args == 0) {
                        $the_args = null;
                    } else {
                        $the_args = $all_args;
                    }
                    $value = call_user_func_array($function_name, $the_args);
                }
            }
        }

        return $value;
    }

    /**
     * Add filter
     *
     * @param string  $filter_name     The filter name
     * @param string  $function_to_add The function to add
     * @param integer $priority        The priority
     * @param integer $accepted_args   The accepted arguments
     *
     * @return boolean  ( description_of_the_return_value )
     */
    public static function addFilter($filter_name, $function_to_add, $priority = 10, $accepted_args = 1)
    {
        // Redefine arguments
        $filter_name = (string) $filter_name;
        $function_to_add = $function_to_add;
        $priority = (int) $priority;
        $accepted_args = (int) $accepted_args;
        // Check that we don't already have the same filter at the same priority. Thanks to WP :)
        if (isset(static::$filters[$filter_name]["$priority"])) {
            foreach (static::$filters[$filter_name]["$priority"] as $filter) {
                if ($filter['function'] == $function_to_add) {
                    return true;
                }
            }
        }
        static::$filters[$filter_name]["$priority"][] = array('function' => $function_to_add, 'accepted_args' => $accepted_args);
        // Sort
        ksort(static::$filters[$filter_name]["$priority"]);
        return true;
    }

    /**
     * Parse content
     *
     * @param string $content the content
     *
     * @return $content (array)
     */
    protected function parseContent($content)
    {
        $_content = '';
        $i = 0;
        foreach (explode(self::SEPARATOR, $content) as $c) {
            $i++ != 0 and $_content .= $c;
        }

        $content = $_content;
        $content = str_replace('{url}', self::urlBase(), $_content);
        $content = str_replace('{email}', self::$config['email'], $content);
        $pos = strpos($content, '{more}');
        if ($pos === false) {
            $content = static::applyFilter('content', $content);
        } else {
            $content = explode('{more}', $content);
            $content['content_short'] = self::applyFilter('content', $content[0]);
            $content['content_full'] = self::applyFilter('content', $content[0].$content[1]);
        }
        //$content = preg_replace('/\s+/', ' ', $content);
        $content = static::evalPHP($content);

        return $content;
    }

    /**
     * Load extensions
     *
     * @return file
     */
    protected function load_extensions()
    {
        // http://stackoverflow.com/questions/14680121/include-just-files-in-scandir-array
        $extensions = array_filter(scandir(EXTENSIONS), function ($item) {
            return $item[0] !== '.';
        });
        foreach ($extensions as $ext) {
            $file = EXTENSIONS.'/'.$ext.'/'.$ext.'.ext.php';
            if (file_exists($file) && is_file($file)) {
                include_once $file;
            }
        }
        // carga las extensions de la plantilla
        $template_functions = THEMES.'/'.self::$config['theme'].'/func.php';
        if (file_exists($template_functions) && is_file($template_functions)) {
            include_once $template_functions;
        }
    }

    /**
     * Load config
     *
     * @param string $route the route
     *
     * @return config
     */
    protected function load_config($route)
    {
        if (file_exists($route) && is_file($route)) {
            static::$config = (require $route);
        } else {
            die('Oops.. Donde esta el archivo de configuración ?!');
        }
    }

    /**
     * Eval Content.
     *
     * @param string $data the data
     *
     * @return $data
     */
    protected static function obEval($data)
    {
        ob_start();
        eval($data[1]);
        $data = ob_get_contents();
        ob_end_clean();

        return $data;
    }

    /**
     * Eval Php
     *
     * @param string $str the string to eval
     *
     * @return callback
     */
    protected static function evalPHP($str)
    {
        return preg_replace_callback('/\\{php\\}(.*?)\\{\\/php\\}/ms', 'Barrio::obEval', $str);
    }

    /**
     * Init CMS.
     *
     * @param string $path the path
     *
     * @return callback
     */
    public function init($path)
    {
        // Load config
        $this->load_config($path);
        // configure timezone
        @ini_set('date.timezone', static::$config['timezone']);
        if (function_exists('date_default_timezone_set')) {
            date_default_timezone_set(static::$config['timezone']);
        } else {
            putenv('TZ='.static::$config['timezone']);
        }
        // Sanitize url
        self::runSanitize();
        // charset
        header('Content-Type: text/html; charset='.static::$config['charset']);
        function_exists('mb_language') and mb_language('uni');
        function_exists('mb_regex_encoding') and mb_regex_encoding(static::$config['charset']);
        function_exists('mb_internal_encoding') and mb_internal_encoding(static::$config['charset']);

        // no magic quotes
        if (get_magic_quotes_gpc()) {
            function stripslashesGPC(&$value)
            {
                $value = stripslashes($value);
            }
            array_walk_recursive($_GET, 'stripslashesGPC');
            array_walk_recursive($_POST, 'stripslashesGPC');
            array_walk_recursive($_COOKIE, 'stripslashesGPC');
            array_walk_recursive($_REQUEST, 'stripslashesGPC');
        }
        // load session
        !session_id() and @session_start();
        // load the extensions
        $this->load_extensions();
        // load current page
        $page = $this->page(Barrio::urlCurrent());

        // meta tag generator
        self::actionAdd('meta', function () {
            echo '<meta name="generator" content="Creado con Barrio CMS" />';
        });

        // empty fields by default
        empty($page['title']) and $page['title'] = static::$config['title'];
        empty($page['tags']) and $page['tags'] = static::$config['keywords'];
        empty($page['description']) and $page['description'] = static::$config['description'];
        empty($page['author']) and $page['author'] = static::$config['author'];
        empty($page['image']) and $page['image'] = static::$config['image'];
        empty($page['date']) and $page['date'] = '';
        empty($page['robots']) and $page['robots'] = 'index,follow';
        empty($page['published']) and $page['published'] = true;
        empty($page['keywords']) and $page['keywords'] = static::$config['keywords'];

        $page = $page;
        $config = self::$config;
        $layout = !empty($page['template']) ? $page['template'] : 'index';

        include THEMES.'/'.$config['theme'].'/'.$layout.'.html';
    }
}
