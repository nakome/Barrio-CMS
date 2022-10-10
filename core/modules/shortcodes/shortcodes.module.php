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

use Action\Action as Action;
use Barrio\Barrio as Barrio;
use Filter\Filter as Filter;
use Shortcode\Shortcode as Shortcode;

// minify css
if (!function_exists('minify_css')) {
    function minify_css($input)
    {
        if ('' === trim($input)) {
            return $input;
        }

        return preg_replace(
            [
                // Remove comment(s)
                '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
                // Remove unused white-space(s)
                '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
                // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
                '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
                // Replace `:0 0 0 0` with `:0`
                '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
                // Replace `background-position:0` with `background-position:0 0`
                '#(background-position):0(?=[;\}])#si',
                // Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
                '#(?<=[\s:,\-])0+\.(\d+)#s',
                // Minify string value
                '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
                '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
                // Minify HEX color code
                '#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
                // Replace `(border|outline):none` with `(border|outline):0`
                '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
                // Remove empty selector(s)
                '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s',
            ],
            [
                '$1',
                '$1$2$3$4$5$6$7',
                '$1',
                ':0',
                '$1:0 0',
                '.$1',
                '$1$3',
                '$1$2$4$5',
                '$1$2$3',
                '$1:0',
                '$1$2',
            ],
            $input
        );
    }
}
// minify javascript
if (!function_exists('minify_js')) {
    // JavaScript Minifier
    function minify_js($input)
    {
        if ('' === trim($input)) {
            return $input;
        }

        return preg_replace(
            [
                // Remove comment(s)
                '#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
                // Remove white-space(s) outside the string and regex
                '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
                // Remove the last semicolon
                '#;+\}#',
                // Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
                '#([\{,])([\'])(\d+|[a-z_][a-z0-9_]*)\2(?=\:)#i',
                // --ibid. From `foo['bar']` to `foo.bar`
                '#([a-z0-9_\)\]])\[([\'"])([a-z_][a-z0-9_]*)\2\]#i',
            ],
            [
                '$1',
                '$1$2',
                '}',
                '$1$3',
                '$1.$3',
            ],
            $input
        );
    }
}

/*
 * ================================
 * Site url
 *
 * [Site_url]
 * ================================
 */
Shortcode::add('Site_url', function ($attrs) {
    extract($attrs);

    return Barrio::urlBase();
});

/*
 * ================================
 * Site current
 *
 * [Site_current]
 * ================================
 */
Shortcode::add('Site_current', function ($attrs) {
    extract($attrs);

    return Barrio::urlCurrent();
});

/*
 * =============================================
 *   Link
 *
 *   [Link href='GxEc46k46gg']
 *   [Link title='Ir a' href='GxEc46k46gg']
 *   [Link alt='website' title='Ir a' href='GxEc46k46gg']
 *   [Link cls='btn' title='Ir a' href='GxEc46k46gg']
 * =============================================
 */
Shortcode::add('Link', function ($attrs) {
    extract($attrs);

    $href = (isset($href)) ? $href : Barrio::urlBase();
    $title = (isset($title)) ? $title : 'link';
    $alt = (isset($alt)) ? 'title="'.$alt.'"' : '';
    $cls = (isset($cls)) ? 'class="'.$cls.'"' : '';

    if ($href) {
        $html = '<a '.$cls.' href="'.$href.'" '.$alt.'>'.$title.'</a>';
        $html = preg_replace('/\s+/', ' ', $html);

        return $html;
    } else {
        return Barrio::error('Error [ href ] no encontrada');
    }
});

/*
 * ================================
 * Details
 *
 * [Details title='example']Markdown Hidden content [/Details]
 * ================================
 */
Shortcode::add('Details', function ($attrs, $content) {
    extract($attrs);

    $title = (isset($title)) ? $title : 'Info';

    $content = Parsedown::instance()->text($content);
    $output = Filter::apply('content', '<details class="p-2 mb-2 border border-gray bg-light text-dark"><summary>'.$title.'</summary><div class="p-2">'.$content.'</div></details>');
    $output = preg_replace('/\s+/', ' ', $output);

    if ($content) {
        return $output;
    } else {
        return Barrio::error('Error [ content ] no encontrado');
    }
});

/*
 * ================================
 * Iframe
 *
 * [iframe src='monchovarela.es']
 * ================================
 */
Shortcode::add('Iframe', function ($attrs) {
    // extrac attributes
    extract($attrs);

    // src url
    $src = (isset($src)) ? $src : '';
    $cls = (isset($cls)) ? $cls : 'iframe';
    $my = (isset($my)) ? 'my-'.$my : '';

    // check src
    if ($src) {
        $html = '<section class="'.$cls.' '.$my.'">';
        $html .= '<iframe src="https://'.$src.'" frameborder="0" allowfullscreen></iframe>';
        $html .= '</section>';
        $html = preg_replace('/\s+/', ' ', $html);

        return $html;
    // show error if not exists src
    } else {
        return Barrio::error('Error [ src ] no encontrado');
    }
});

/*
 * =============================================
 *   Youtube
 *
 *   [Youtube id='GxEc46k46gg']
 *   [Youtube cls='well' id='GxEc46k46gg']
 * =============================================
 */
Shortcode::add('Youtube', function ($attrs) {
    extract($attrs);

    $id = (isset($id)) ? $id : '';
    $cls = (isset($cls)) ? $cls : 'ratio ratio-16x9';
    $my = (isset($my)) ? 'my-'.$my : '';

    if ($id) {
        $html = '<section class="'.$cls.' '.$my.'">';
        $html .= '<iframe src="//www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe>';
        $html .= '</section>';
        $html = preg_replace('/\s+/', ' ', $html);

        return $html;
    } else {
        return Barrio::error('Error [ id ] no encontrado');
    }
});

/*
 * =============================================
 *   Vimeo
 *
 *   [Vimeo id='149129821']
 *   [Vimeo cls='iframe' id='149129821']
 * =============================================
 */
Shortcode::add('Vimeo', function ($attrs) {
    extract($attrs);

    $id = (isset($id)) ? $id : '';
    $cls = (isset($cls)) ? $cls : 'ratio ratio-16x9';
    $my = (isset($my)) ? 'my-'.$my : '';

    if ($id) {
        $html = '<section class="'.$cls.' '.$my.'">';
        $html .= '<iframe src="https://player.vimeo.com/video/'.$id.'" frameborder="0" allowfullscreen></iframe>';
        $html .= '</section>';
        $html = preg_replace('/\s+/', ' ', $html);

        return $html;
    } else {
        return Barrio::error('Error [ id ] no encontrado');
    }
});

/*
 * =============================================
 *   Video
 *
 *   [Video src='public/videos/movie.mp4']
 *   [Video cls='iframe' src='public/videos/movie.mp4']
 *   [Video cls='iframe' autoplay='' src='public/videos/movie.mp4']
 *   [Video cls='iframe' autoplay='' autobuffer='' src='public/videos/movie.mp4']
 *   [Video cls='iframe' autoplay='' autobuffer='' muted='' loop='' src='public/videos/movie.mp4']
 * =============================================
 */
Shortcode::add('Video', function ($attrs) {
    extract($attrs);

    $src = (isset($src)) ? $src : '';
    $ext = (isset($ext)) ? $ext : false;
    $cls = (isset($cls)) ? $cls : 'video';
    $my = (isset($my)) ? 'my-'.$my : '';

    $autoplay = (isset($autoplay)) ? 'autoplay="true"' : '';
    $autobuffer = (isset($autobuffer)) ? 'autobuffer="true"' : '';
    $muted = (isset($muted)) ? 'muted="true"' : '';
    $loop = (isset($loop)) ? 'loop="true"' : '';
    $controls = (isset($controls)) ? 'controls="true"' : '';

    if ($src) {
        $url = Barrio::urlBase();
        $src = ($ext) ? $src : $url.'/'.$src;
        $html = '<section class="'.$cls.' '.$my.'">';
        $html .= '<video src="'.$src.'" '.$controls.' '.$autoplay.' '.$autobuffer.'  '.$muted.' '.$loop.'> </video>';
        $html .= '</section>';
        $html = preg_replace('/\s+/', ' ', $html);

        return $html;
    } else {
        return Barrio::error('Error [ src ] no encontrado');
    }
});

/*
 * ====================================================
 *   Texto
 *
 *   [Text]Color texto[/Text]
 *   [Text bg='blue']Color texto[/Text]
 *   [Text bg='blue' color='white']Color texto[/Text]
 * ====================================================
 */
Shortcode::add('Text', function ($attrs, $content) {
    extract($attrs);

    $cls = (isset($cls)) ? 'class="'.$cls.'"' : 'class="txt p-2"';
    $color = (isset($color)) ? 'color:'.$color.';' : '';
    $bg = (isset($bg)) ? 'background-color:'.$bg.';' : '';

    $content = Parsedown::instance()->text($content);
    $output = Filter::apply('content', '<div '.$cls.' style="'.$color.' '.$bg.'">'.$content.'</div>');
    $output = preg_replace('/\s+/', ' ', $output);

    if ($content) {
        return $output;
    } else {
        return Barrio::error('Error [ content ] no encontrado');
    }
});

/*
 * ====================================================
 *   Image
 *
 *   [Img src='//otraurl.com/public/image.jpg']
 *   [Img url='//google.es' src='//otraurl.com/public/image.jpg']
 *   [Img url='//google.es' title='Hello' src='//otraurl.com/public/image.jpg']
 *   [Img url='//google.es' title='Hello' cls='well' src='//otraurl.com/public/image.jpg']
 *   [Img url='//google.es' title='Hello' cls='well' ext='' src='//otraurl.com/public/image.jpg']
 * ====================================================
 */
Shortcode::add('Img', function ($attrs) {
    extract($attrs);

    $src = (isset($src)) ? $src : '';
    $url = (isset($url)) ? $url : '';
    $cls = (isset($cls)) ? 'class="'.$cls.'"' : '';
    $ext = (isset($ext)) ? ($ext = ('true' == $ext) ? true : false) : false;
    $title = (isset($title)) ? $title : '';
    $site = Barrio::urlBase();
    $src = rtrim($src, '/');

    $html = '';
    $srcset = '';
    // exits $src
    if ($src) {
        if (true == $ext || 'true' == $ext) {
            $src = '//'.$src;
            $srcset = false;
        } else {
            // index.php?api=image&url=public/notfound.jpg&w=600
            $normal = $src;
            $src = Barrio::urlBase().'/index.php?api=image&url='.$src.'&w=';
            $srcset = 'loading="lazy" sizes="(max-width: 500px) 100vw, (max-width: 900px) 50vw, 800px" src="'.$normal.'" srcset="'.$src.'500 500w,'.$src.'800 800w,'.$src.'1000 1000w,'.$src.'1400 1400w"';
        }

        $image = ($srcset) ? $srcset : 'src="'.$src.'"';

        if ($title) {
            if ($url) {
                $html = '<a href="'.$url.'" title="'.$title.'"> <figure> <img '.$image.' '.$cls.'  alt="'.$title.'"/> <figcaption>'.$title.'</figcaption> </figure> </a>';
            } else {
                $html = '<figure><img '.$cls.' '.$image.' alt="'.$title.'"/><figcaption>'.$title.'</figcaption></figure>';
            }
        } else {
            if ($url) {
                $html = '<a  href="'.$url.'" title="'.$title.'"><img '.$cls.' '.$image.' /></a>';
            } else {
                $html = '<img '.$cls.' '.$image.' alt="'.$title.'"/>';
            }
        }

        $html = preg_replace('/\s+/', ' ', $html);

        return $html;
    } else {
        return Barrio::error('Error [ src ] no encontrado');
    }
});

/*
 * ====================================================
 *  Row
 * - cls = css class
 *   [Row]
 *       bloques que sumen 12 en total
 *   [/Row]
 * ====================================================
 */
Shortcode::add('Row', function ($attrs, $content) {
    extract($attrs);
    $cls = (isset($cls)) ? $cls : '';
    $num = (isset($num)) ? 'row-cols-'.$num : '';
    $output = Filter::apply('content', '<div class="row '.$cls.' '.$num.'">'.$content.'</div>');
    $output = preg_replace('/\s+/', ' ', $output);

    return $output;
});

/*
 * ====================================================
 * num = col number
 * cls = class
 *
 * [Col num='8']
 *      texto en markdown
 * [/Col]
 * ====================================================
 */
Shortcode::add('Col', function ($attrs, $content) {
    extract($attrs);
    $num = (isset($num)) ? $num : '6';
    $cls = (isset($cls)) ? $cls : '';
    $content = Parsedown::instance()->text($content);
    $content = Filter::apply('content', '<div class="col-'.$num.' col-md-'.$num.' '.$cls.'">'.$content.'</div>');
    $content = preg_replace('/\s+/', ' ', $content);

    return $content;
});

/*
 * ================================
 * Style
 *
 * [Styles]body{};[/Styles]
 * [Styles minify=true]body{};[/Styles]
 * ================================
 */
Shortcode::add('Styles', function ($attrs, $content = '') {
    extract($attrs);
    $minify = (isset($minify)) ? $minify : false;
    if ($content) {
        // convert string to bool
        $minify = ('true' == $minify) ? true : false;
        // minify or not
        $content = (true == $minify) ? minify_css($content) : $content;

        return Action::add('head', function () use ($content) {
            $html = "\n\n\t";
            $html .= '<!-- Shortcode css -->';
            $html .= "\n\t";
            $html .= '<style rel="stylesheet">'.$content.'</style>';
            $html .= "\n\n";
            echo $html;
        });
    } else {
        return Barrio::error('Error [ contenido ] no encontrado en Style Shortcode');
    }
});
/*
 * ================================
 * Style file
 *
 * [Style src='//example.css']
 * [Style local=true src='content/example.css']
 * ================================
 */
Shortcode::add('Style', function ($attrs) {
    extract($attrs);
    $src = (isset($src)) ? $src : '';
    $local = (isset($local)) ? $local : false;
    if ($src) {
        return Action::add('head', function () use ($src,$local) {
            if($local) {
                echo '<link rel="stylesheet" type="text/css" href="'.Barrio::urlBase().'/'.$src.'"/>';
            } else {
                echo '<link rel="stylesheet" href="https://'.$src.'"/>';
            }
        });
    } else {
        return Barrio::error('Error [ src ] no encontrado');
    }
});
/*
 * ================================
 * Scripts
 *
 * [Scripts]console.log("test");[/Scripts]
 * [Scripts minify=true]console.log("test");[/Scripts]
 * ================================
 */
Shortcode::add('Scripts', function ($attrs, $content = '') {
    extract($attrs);
    $minify = (isset($minify)) ? $minify : false;
    if ($content) {
        // convert string to bool
        $minify = ('true' == $minify) ? true : false;
        // minify or not
        $content = (true == $minify) ? minify_js($content) : $content;

        return Action::add('footer', function () use ($content) {
            $html = "\n\n\t";
            $html .= '<!-- Shortcode scripts -->';
            $html .= "\n\t";
            $html .= '<script rel="javascript">'.$content.'</script>';
            $html .= "\n\n";
            echo $html;
        });
    } else {
        return Barrio::error('Error [ contenido ] no encontrado');
    }
});
/*
 * ================================
 * Script file
 *
 * [Script src='//example.js']
 * ================================
 */
Shortcode::add('Script', function ($attrs) {
    extract($attrs);
    $src = (isset($src)) ? $src : '';
    $local = (isset($local)) ? $local : false;
    if ($src) {
        return Action::add('footer', function () use ($src,$local) {
            if($local) {
                echo '<script rel="javascript" src="'.Barrio::urlBase().'/'.$src.'"></script>';
            } else {
                echo '<script rel="javascript" src="https:'.$src.'"></script>';
            }
        });
    } else {
        return Barrio::error('Error [ src ] no encontrado');
    }
});

/*
 * ================================
 * Escape or convert html tags
 *
 * [Esc]echo 'holas';[/Esc]
 * ================================
 */
Shortcode::add('Esc', function ($attr, $content) {
    $output = htmlspecialchars("$content", ENT_QUOTES);
    $output = str_replace('&#039;', "'", $output);

    return $output;
});

/*
 * ====================================================
 *  Code
 *   [Code type='php']
 *       php code here
 *   [/Code]
 * ====================================================
 */
Shortcode::add('Code', function ($attrs, $content) {
    extract($attrs);
    $type = (isset($type)) ? $type : 'php';
    if ($content) {
        $content = htmlentities(html_entity_decode($content));
        $output = Filter::apply('content', '<pre class="line-numbers language-'.$type.'"><code class="language-'.$type.'">'.$content.'</code></pre>');

        return $output;
    } else {
        return Barrio::error('Error [ contenido ] no encontrado');
    }
});

/*
 * ================================
 * Config
 *
 * Get config [Config name='title']
 * ================================
 */
Shortcode::add('Config', function ($attrs) {
    extract($attrs);
    if ($name) {
        return Barrio::$config[$name];
    } else {
        return Barrio::error('Error [ name ] no encontrado');
    }
});

/*
 * ====================================================
 * Divider
 *
 * [Divider]
 * [Divider num='2']
 * [Divider type='br' num='2']
 * ====================================================
 */
Shortcode::add('Divider', function ($attrs) {
    extract($attrs);
    $type = (isset($type)) ? $type : 'hr';
    $num = (isset($num)) ? $num : '4';
    $cls = (isset($cls)) ? $cls : '';
    $color = (isset($color)) ? 'style="border-color:'.$color.'"' : '';
    if ('br' !== $type) {
        return '<hr class="'.$cls.' my-'.$num.'" '.$color.'/>';
    } else {
        return '<br class="'.$cls.' my-'.$num.'" '.$color.'/>';
    }
});

/*
 * ====================================================
 * Space
 *
 * [Space]
 * [Space num=2]
 * ====================================================
 */
Shortcode::add('Space', function ($attrs) {
    extract($attrs);
    $num = (isset($num)) ? $num : '2';
    return str_repeat('&nbsp;', (int) $num);
});

/*
 * ====================================================
 * Btn
 * text = texto del boton
 * id =  id del boton (opcional)
 * href = dirección  (opcional)
 *
 * [Btn text='hola']
 * [Btn text='hola' id='btn' href='//example.com']
 * ====================================================
 */
Shortcode::add('Btn', function ($attrs) {
    extract($attrs);

    $text = (isset($text)) ? $text : '';
    $cls = (isset($cls)) ? 'class="'.$cls.'"' : 'class="btn btn-primary my-2"';
    $id = (isset($id)) ? 'id="'.$id.'"' : '';
    $href = (isset($href)) ? $href : '#';

    if ($text) {
        $html = '<a '.$cls.' '.$id.' href="'.$href.'" title="'.$text.'">'.$text.'</a>';
        $html = preg_replace('/\s+/', ' ', $html);

        return $html;
    } else {
        return Barrio::error('Error [ text ] no encontrado');
    }
});

/*
 * ====================================================
 * Html
 * - Solo funciona con .txt
 * [Html src='/public/texto.txt']
 * ====================================================
 */
Shortcode::add('Html', function ($attrs) {
    extract($attrs);
    $src = (isset($src)) ? $src : '';
    if($src) {
        $content = (is_file(ROOT_DIR.$src)) ? ROOT_DIR.$src : false;
        if($content){
            ob_start();
            @header('Content-Type: text/html; charset=utf-8');
            include($content);
            $var=ob_get_contents();
            ob_end_clean();
            return $var;
        } else {
            Barrio::error('Error [ src ] donde esta el archivo incluido');
        }
    }else{
        return Barrio::error('Error [ src ] no encontrado');
    }
});

/*
 * ====================================================
 * Php
 *
 * [Php]echo 'holas';[/Php]
 * ====================================================
 */

/* Desactivado por precaución
Shortcode::add('Php', function ($attr, $content) {
    ob_start();
    eval("$content");

    return ob_get_clean();
});
*/