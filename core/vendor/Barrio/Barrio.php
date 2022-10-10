<?php

namespace Barrio;

// cargamos los traits
require VENDOR.'/Barrio/traits/Cors.php';
require VENDOR.'/Barrio/traits/Debuging.php';
require VENDOR.'/Barrio/traits/Info.php';
require VENDOR.'/Barrio/traits/Navigation.php';
require VENDOR.'/Barrio/traits/Pages.php';
require VENDOR.'/Barrio/traits/Url.php';
require VENDOR.'/Barrio/traits/Validate.php';

use Action\Action as Action;
use File\File as File;

/*
 * Cargar traits
 */
use Traits\Cors as C;
use Traits\Debuging as D;
use Traits\Info as I;
use Traits\Navigation as N;
use Traits\Pages as P;
use Traits\Url as U;
use Traits\Validate as V;

/**
 * Barrio CMS.
 *
 * @author    Moncho Varela / Nakome <nakome@gmail.com>
 * @copyright 2016 Moncho Varela / Nakome <nakome@gmail.com>
 *
 * @version 1.0.0
 */
class Barrio
{
    use C;
    use D;
    use I;
    use N;
    use P;
    use U;
    use V;

    /**
     * Constantes.
     */
    public const APPNAME = 'Barrio CMS';
    public const VERSION = '0.0.5';
    public const SEPARATOR = '----';

    /**
     * Static Configuración.
     */
    public static $config;

    /**
     * Static Modulos.
     */
    private static $modules = [];

    /**
     * Variables Cabecera.
     */
    private $headers = [
        'title' => 'Title',
        'description' => 'Description',
        'tags' => 'Tags',
        'author' => 'Author',
        'image' => 'Image',
        'date' => 'Date',
        'robots' => 'Robots',
        'keywords' => 'Keywords',
        'template' => 'Template',
        'published' => 'Published',
        'background' => 'Background',
        'video' => 'Video',
        'color' => 'Color',
        'css' => 'Css',
        'javascript' => 'Javascript',
        'attrs' => 'Attrs', // = [1,2,true,'string']
        'json' => 'Json', // = /content/data/test.json
        'password' => 'Password' // for page with password
    ];

    /**
     * Encadenamos.
     *
     * @return new static
     */
    public static function run()
    {
        return new static();
    }

    /**
     * Cargamos los modulos.
     *
     * @return file
     */
    protected function loadModules()
    {
        // http://stackoverflow.com/questions/14680121/include-just-files-in-scandir-array
        $modules = array_filter(scandir(MODULES), function ($item) {return '.' !== $item[0]; });
        foreach ($modules as $module) {
            $file = MODULES.'/'.$module.'/'.$module.'.module.php';
            $configFile = MODULES.'/'.$module.'/'.$module.'.config.php';

            if (file_exists($configFile) && is_file($configFile)) {
                $config = include_once $configFile;
                if ($config['enabled']) {
                    include_once $file;
                }
            }
        }
    }

    /**
     * Cargamos los funciones de la plantilla.
     *
     * @return file
     */
    protected function loadThemeFunctions()
    {
        // carga las funciones de la plantilla
        $template_functions = THEMES.'/'.self::$config['theme'].'/functions.php';
        if (file_exists($template_functions) && is_file($template_functions)) {
            include_once $template_functions;
        }
    }

    /**
     * Cargar configuración.
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
            exit('Oops.. Donde esta el archivo de configuración ?!');
        }
    }

    /**
     * Evalúa el contenido.
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
     * Evalúa Php.
     *
     * @param string $str the string to eval
     *
     * @return callable
     */
    protected static function evalPHP($str)
    {
        return preg_replace_callback('/\\{php\\}(.*?)\\{\\/php\\}/ms', 'self::obEval', $str);
    }

    /**
     * Iniciamos la web.
     *
     * @param string $path the path
     *
     * @return callable
     */
    public function init($path)
    {
        // Cargar configuración
        $this->loadConfig($path);

        // configurar la zona horaria
        @ini_set('date.timezone', static::$config['timezone']);
        if (function_exists('date_default_timezone_set')) {
            date_default_timezone_set(static::$config['timezone']);
        } else {
            putenv('TZ='.static::$config['timezone']);
        }

        // Sanear la url
        self::runSanitize();

        // charset
        header('Content-Type: text/html; charset='.static::$config['charset']);

        function_exists('mb_language') and mb_language('uni');
        function_exists('mb_regex_encoding') and mb_regex_encoding(static::$config['charset']);
        function_exists('mb_internal_encoding') and mb_internal_encoding(static::$config['charset']);

        // Cargamons la session
        !session_id() and @session_start();

        // Cargamos los modulos
        $this->loadModules();
        // Cargamos las funciones de la plantilla
        $this->loadThemeFunctions();

        // Cargar la página actual
        $page = $this->page(self::urlCurrent());

        // Ruta del archivo
        $file = CONTENT.'/'.self::urlCurrent();
        if (is_dir($file)) {
            $file = $file.'/index.md';
            $date = date('d-m-Y', filemtime($file));
        } else {
            $file .= '.md';
            if (is_file($file)) {
                $date = date('d-m-Y', filemtime($file));
            } else {
                $date = '';
            }
        }

        Action::add('head', function () use ($page) {
            // Si existe el attributo json en el archivo md
            // se usa la variable jsonPageAttrs
            if ($page['json'] && is_file(ROOT_DIR.$page['json'])) {
                $json = File::jsonMinify(file_get_contents(ROOT_DIR.$page['json']));
                $script = (string) "var jsonPageAttrs = '".trim($json)."';";
                echo '<script type="text/javascript">'.$script.'</script>';
            } else {
                $json = json_encode(array("status" => false));
                $script = (string) "var jsonPageAttrs = '".$json."';";
                echo '<script type="text/javascript">'.$script.'</script>';
            }
            // css style
            if($page['css']){
                $href = (string) $page['css'];
                echo '<link rel="stylesheet" href="'.$href.'"/>';
            }
        });

        Action::add('footer', function () use ($page) {
            // js file
            if($page['javascript']){
                $src = (string) $page['javascript'];
                echo '<script rel="javascript" src="'.$src.'"></script>';
            }
        });


        // Campos vacíos por defecto
        empty($page['title']) and $page['title'] = static::$config['title'];
        empty($page['tags']) and $page['tags'] = static::$config['keywords'];
        empty($page['description']) and $page['description'] = static::$config['description'];
        empty($page['author']) and $page['author'] = static::$config['author'];
        empty($page['image']) and $page['image'] = '';
        empty($page['date']) and $page['date'] = $date;
        empty($page['robots']) and $page['robots'] = 'index,follow';
        empty($page['published']) and $page['published'] = '';
        empty($page['background']) and $page['background'] = '';
        empty($page['video']) and $page['video'] = '';
        empty($page['color']) and $page['color'] = 'white';
        empty($page['keywords']) and $page['keywords'] = static::$config['keywords'];
        empty($page['css']) and $page['css'] = '';
        empty($page['javascript']) and $page['javascript'] = '';
        empty($page['attrs']) and $page['attrs'] = '';
        empty($page['json']) and $page['json'] = '';
        empty($page['password']) and $page['password'] = '';

        $page = $page;
        $config = self::$config;
        $layout = !empty($page['template']) ? $page['template'] : 'index';

        // Comprobamos si esta publicada la página
        $page['published'] = 'false' === $page['published'] ? false : true;

        if ($page['published']) {
            $sourceUrl = THEMES.'/'.$config['theme'].'/';
            if (file_exists($sourceUrl.$layout.'.html')) {
                include $sourceUrl.$layout.'.html';
                exit(1);
            } else {
                include $sourceUrl.'index.html';
                exit(1);
            }
        } else {
            include ROOT_DIR.'/404.html';
            exit(1);
        }
    }

    /**
     * Pagina de error.
     *
     * @param array $page true false
     *
     * @return string
     */
    public function errorPage($page = [])
    {
        $error = THEMES.'/'.self::$config['theme'].'/404.html';

        if (file_exists($error)) {
            include $error;
        } else {
            exit('Pagina no encontrada.');
        }
    }
}
