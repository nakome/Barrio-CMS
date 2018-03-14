<?php



/**
 * Barrio CMS Tpl
 *
 * @author    Moncho Varela / Nakome <nakome@gmail.com>
 * @copyright 2016 Moncho Varela / Nakome <nakome@gmail.com>
 *
 * @version 0.0.1
 *
 */

class Tpl
{


    /**
     * Constructor
     */
    public function __construct()
    {

        // tags
        $this->tags = array(

            // date
            '{date}' => '<?php echo date("d-m-Y");?>',
            // year
            '{Year}' => '<?php echo date("Y");?>',

            // site url
            '{Site_url}' => '<?php echo Barrio::urlBase();?>',
            '{Site_current}' => '<?php echo Barrio::UrlCurrent();?>',


            // last posts
            '{Last_posts}' => '<?php echo Barrio::actionRun("lastPosts",[Barrio::$config["blog"]["last_posts"],"blog"]);?>',
            '{Blog_posts}' => '<?php echo Barrio::actionRun("Pagination",["blog",Barrio::$config["pagination"]]);?>',
            // pagination for other folder of content not blog
            '{Pages: ([^}]*)}' => '<?php echo Barrio::actionRun("Pagination",["$1",Barrio::$config["pagination"]]);?>',


            // comment
            //{* comment *}
            '{\*(.*?)\*}' => '<?php echo "\n";?>',

            // confitional
            '{If: ([^}]*)}' => '<?php if ($1): ?>',
            '{Else}' => '<?php else: ?>',
            '{Elseif: ([^}]*)}' => '<?php elseif ($1): ?>',
            '{\/If}' => '<?php endif; ?>',

            // segments
            '{Segment: ([^}]*)}' => '<?php if (Barrio::urlSegments(0) == "$1"): ?>',
            '{\/Segment}' => '<?php endif; ?>',

            // loop
            '{Loop: ([^}]*) as ([^}]*)=>([^}]*)}' => '<?php $counter = 0; foreach (%%$1 as $2=>$3): ?>',
            '{Loop: ([^}]*) as ([^}]*)}' => '<?php $counter = 0; foreach (%%$1 as $key => $2): ?>',
            '{Loop: ([^}]*)}' => '<?php $counter = 0; foreach (%%$1 as $key => $value): ?>',
            '{\/Loop}' => '<?php $counter++; endforeach; ?>',

            // vars
            // {?= 'hello world' ?}
            '{\?(\=){0,1}([^}]*)\?}' => '<?php if(strlen("$1")) echo $2; else $2; ?>',

            // {? 'hello world' ?}
            '{(\$[a-zA-Z\-\._\[\]\'"0-9]+)}' => '<?php echo %%$1; ?>',

            // encode & decode
            '{(\$[a-zA-Z\-\._\[\]\'"0-9]+)\|encode}' => '<?php echo base64_encode(%%$1); ?>',
            '{(\$[a-zA-Z\-\._\[\]\'"0-9]+)\|decode}' => '<?php echo base64_decode(%%$1); ?>',

            // capitalize
            '{(\$[a-zA-Z\-\._\[\]\'"0-9]+)\|capitalize}' => '<?php echo ucfirst(%%$1); ?>',

            // {$page.content|e}
            '{(\$[a-zA-Z\-\._\[\]\'"0-9]+)\|e}' => '<?php echo htmlspecialchars(%%$1, ENT_QUOTES | ENT_HTML5, "UTF-8"); ?>',

            // {$page.content|parse}
            '{(\$[a-zA-Z\-\._\[\]\'"0-9]+)\|parse}' => '<?php echo html_entity_decode(%%$1, ENT_QUOTES); ?>',
            // md5
            '{(\$[a-zA-Z\-\._\[\]\'"0-9]+)\|md5}' => '<?php echo md5(%%$1); ?>',
            // sha1
            '{(\$[a-zA-Z\-\._\[\]\'"0-9]+)\|sha1}' => '<?php echo sha1(%%$1); ?>',

            // actions
            '{Action: ([a-zA-Z\-\._\[\]\'"0-9]+)}' => '<?php Barrio::actionRun(\'$1\'); ?>',
            // include
            '{Include: (.+?\.[a-z]{2,4})}' => '<?php include_once(ROOT."/$1"); ?>',
            // template
            '{Template: (.+?\.[a-z]{2,4})}' => '<?php include_once(ROOT."/themes/".$config["theme"]."/$1"); ?>',
            // assets
            '{Assets: (.+?\.[a-z]{2,4})}' => '<?php echo Barrio::urlBase()."/themes/".Barrio::$config["theme"]."/assets/$1" ?>'
        );

        $this->tmp =  ROOT.'/tmp/';
        if (!file_exists($this->tmp)) {
            mkdir($this->tmp);
        }
    }


    /**
     * Callback
     *
     * @param mixed $variable the var
     *
     * @return mixed
     */
    public function callback($variable)
    {
        if (!is_string($variable) && is_callable($variable)) {
            return $variable();
        }
        return $variable;
    }

    /**
     *  Set var
     *
     * @param string $name  the key
     * @param string $value the value
     *
     * @return mixed
     */
    public function set($name, $value)
    {
        $this->data[$name] = $value;
        return $this;
    }

    /**
     * Append data in array
     *
     * @param string $name  the key
     * @param string $value the value
     *
     * @return null
     */
    public function append($name, $value)
    {
        $this->data[$name][] = $value;
    }

    /**
     * Parse content
     *
     * @param string $content the content
     *
     * @return string
     */
    private function _parse($content)
    {
        // replace tags with PHP
        foreach ($this->tags as $regexp => $replace) {
            if (strpos($replace, 'self') !== false) {
                $content = preg_replace_callback('#'.$regexp.'#s', $replace, $content);
            } else {
                $content = preg_replace('#'.$regexp.'#', $replace, $content);
            }
        }

        // replace variables
        if (preg_match_all('/(\$(?:[a-zA-Z0-9_-]+)(?:\.(?:(?:[a-zA-Z0-9_-][^\s]+)))*)/', $content, $matches)) {
            for ($i = 0; $i < count($matches[1]); $i++) {
                // $a.b to $a["b"]
                $rep = $this->_replaceVariable($matches[1][$i]);
                $content = str_replace($matches[0][$i], $rep, $content);
            }
        }

        // remove spaces betweend %% and $
        $content = preg_replace('/\%\%\s+/', '%%', $content);

        // call cv() for signed variables
        if (preg_match_all('/\%\%(.)([a-zA-Z0-9_-]+)/', $content, $matches)) {
            for ($i = 0; $i < count($matches[2]); $i++) {
                if ($matches[1][$i] == '$') {
                    $content = str_replace($matches[0][$i], 'self::callback($'.$matches[2][$i].')', $content);
                } else {
                    $content = str_replace($matches[0][$i], $matches[1][$i].$matches[2][$i], $content);
                }
            }
        }

        return $content;
    }

    /**
     * Run file
     *
     * @param string $file    the file
     * @param int    $counter the counter
     *
     * @return string
     */
    private function _run($file, $counter = 0)
    {
        $pathInfo = pathinfo($file);
        $tmpFile = $this->tmp.$pathInfo['basename'];

        if (!is_file($file)) {
            echo "Template '$file' not found.";
        } else {
            $content = file_get_contents($file);

            if ($this->_searchTags($content) && ($counter < 3)) {
                file_put_contents($tmpFile, $content);
                $content = $this->_run($tmpFile, ++$counter);
            }
            file_put_contents($tmpFile, $this->_parse($content));

            extract($this->data, EXTR_SKIP);

            ob_start();
            include $tmpFile;
            if(!DEV_MODE) unlink($tmpFile);
            return ob_get_clean();
        }
    }

    /**
     * Draw file
     *
     * @param string $file the file
     *
     * @return string
     */
    public function draw($file)
    {
        if (preg_match('#inc(\/modules\/[^"]*\/)view\/([^"]*.'.pathinfo($file, PATHINFO_EXTENSION).')#', $file, $m)) {
            $themeFile = THEMES.'/'.$this->core->settings->get('settings.theme').$m[1].$m[2];
            if(is_file($themeFile)) $file = $themeFile;
        }
        $result = $this->_run($file);
        return $result;
    }

    /**
     *  Comment
     *
     * @param string $content the content
     *
     * @return null
     */
    public function comment($content)
    {
        return null;
    }

    /**
     *  Search Tags
     *
     * @param string $content the content
     *
     * @return boolean
     */
    private function _searchTags($content)
    {
        foreach ($this->tags as $regexp  => $replace) {
            if(preg_match('#'.$regexp.'#sU', $content, $matches))
                return true;
        }
        return false;
    }

    /**
     * Dot notation
     *
     * @param string $var the var
     *
     * @return string
     */
    private function _replaceVariable($var)
    {
        if (strpos($var, '.') === false) {
            return $var;
        }
        return preg_replace('/\.([a-zA-Z\-_0-9]*(?![a-zA-Z\-_0-9]*(\'|\")))/', "['$1']", $var);
    }
}


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
            $file = CONTENT.'/404.md';
            if (file_exists($file)) {
                $content = file_get_contents($file);
                header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
            } elseif (file_exists(CONTENT.'/'.self::urlSegment(0).'/404.md')) {
                $content = file_get_contents(CONTENT.'/'.self::urlSegment(0).'/404.md');
                header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
            } else {
                $content = file_get_contents(CONTENT.'/'.self::$config['lang'].'/404.md');
                header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
            }

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
    protected function loadExtensions()
    {
        // http://stackoverflow.com/questions/14680121/include-just-files-in-scandir-array
        $extensions = array_filter(
            scandir(EXTENSIONS),
            function ($item) {
                return $item[0] !== '.';
            }
        );
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
    protected function loadConfig($route)
    {
        if (file_exists($route) && is_file($route)) {
            static::$config = (include $route);
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
        $this->loadConfig($path);


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
            /**
             * Stripslashes
             *
             * @param string $value the value
             *
             * @return string
             */
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


        // init templating
        $Tpl = new Tpl();


        // load the extensions
        $this->loadExtensions();
        

        // load current page
        $page = $this->page(Barrio::urlCurrent());

        // meta tag generator
        self::actionAdd(
            'meta',
            function () {
                echo '<meta name="generator" content="Creado con Barrio CMS" />';
            }
        );

        // empty fields by default
        empty($page['title']) and $page['title'] = static::$config['title'];
        empty($page['tags']) and $page['tags'] = static::$config['keywords'];
        empty($page['description']) and $page['description'] = static::$config['description'];
        empty($page['author']) and $page['author'] = static::$config['author'];
        empty($page['image']) and $page['image'] = '';
        empty($page['date']) and $page['date'] = '';
        empty($page['robots']) and $page['robots'] = 'index,follow';
        empty($page['published']) and $page['published'] = '';
        empty($page['keywords']) and $page['keywords'] = static::$config['keywords'];


        $page = $page;
        $config = self::$config;
        $layout = !empty($page['template']) ? $page['template'] : 'index';

        // segment
        $Tpl->set('Segment', Barrio::urlSegment(0));

        // published
        $page['published'] = $page['published'] === 'false' ? false : true;
        if ($page['published']) {
            // use templating
            $Tpl->set('page', $page);
            $Tpl->set('config', $config);
            echo $Tpl->draw(THEMES.'/'.$config['theme'].'/'.$layout.'.html');

        } else {
            $this->errorPage($page);
        }
    }

    /**
     * Gets Error on not published
     *
     * @param array $page true false
     *
     * @return string
     */
    public function errorPage($page = array())
    {
        $Tpl->set('title','404 not Found');
        $Tpl->set('description','The site configured at this address does not contain the requested file.');
        $Tpl->set('robots','noindex,nofollow');
        $Tpl->set('content','The page Exists but is not published yet.');
        $Tpl->set('config', self::$config);
        echo $Tpl->draw(THEMES.'/'.self::$config['theme'].'/404.html');

    }
}
