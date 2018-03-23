<?php  defined('BARRIO') or die('Sin accesso a este script.');


/**
*   Iframe
*   {iframe src='monchovarela.es'}
*/
Barrio::shortcodeAdd('Iframe', function ($attrs) {
    // extraemos los atributos (en este caso $src)
    extract($attrs);
    // el codigo del enlace
    $src = (isset($src)) ? $src : '';
    $cls = (isset($cls)) ? $cls : 'iframe mt-2 mb-4';
    // comprobamos que exista el $id
    if ($src) {
        $html = '<section class="'.$cls.'">';
        $html .= '<iframe src="https://'.$src.'" frameborder="0" allowfullscreen></iframe>';
        $html .= '</section>';
        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
        // si no se pone el atributo id que avise
    } else {
        return "<span style=\"display: inline-block; background: #f55; color: white; padding: 2px 8px; border-radius: 4px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [ src ] no encontrado</span>";
    }
});

/**
*   Youtube
*   {Youtube clase='well' id='GxEc46k46gg'}
*/
Barrio::shortcodeAdd('Youtube', function ($atributos) {
    // extraemos los atributos (en este caso $src)
    extract($atributos);
    // el codigo del enlace
    $id = (isset($id)) ? $id : '';
    $cls = (isset($cls)) ? $cls : 'iframe';
    // comprobamos que exista el $id
    if ($id) {
        $html = '<section class="'.$cls.' mt-2 mb-4">';
        $html .= '<iframe src="//www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe>';
        $html .= '</section>';
        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
        // si no se pone el atributo id que avise
    } else {
        return "<span style=\"display: inline-block; background: #f55; color: white; padding: 2px 8px; border-radius: 4px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [ id ] no encontrado.</span>";
    }
});

/**
*   Vimeo
*    {Vimeo id='149129821'}
*/
Barrio::shortcodeAdd('Vimeo', function ($attrs) {
    // extraemos los atributos
    extract($attrs);
    // el codigo del enlace
    $id = (isset($id)) ? $id : '';
    $cls = (isset($cls)) ? $cls : 'iframe';
    // comprobamos que exista el $id
    if ($id) {
        $html = '<section class="'.$cls.'">';
        $html .= '<iframe src="https://player.vimeo.com/video/'.$id.'" frameborder="0" allowfullscreen></iframe>';
        $html .= '</section>';
        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
        // si no se pone el atributo id que avise
    } else {
        return "<span style=\"display: inline-block; background: #f55; color: white; padding: 2px 8px; border-radius: 4px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error  [id] no encontrado.</span>";
    }
});


/**
*   Texto
*   {Text bg='blue' color='white'}Color texto{/Text}
*/
Barrio::shortcodeAdd('Text', function ($attrs, $content) {
    // extraemos los atributos (en este caso $color)
    extract($attrs);
    // definimos el color, por defecto sera blue (tienen que ser en ingles)
    $cls = (isset($cls)) ? $cls : 'p-2';
    $color = (isset($color)) ? $color : '';
    $bg = (isset($bg)) ? $bg : '';
    // parseamos para poder usar markdown
    $content = Parsedown::instance()->text($content);
    // aplicamos un filtro para escribir dentro del shortcode
    $output = Barrio::applyFilter(
        'content',
        '<div class="'.$cls.'" style="color:'.$color.';background-color:'.$bg.'">
        '.$content.'
        </div>'
    );
    // enseñamos la plantilla
    $output = preg_replace('/\s+/', ' ', $output);
    if ($content) {
        return $output;
    } else {
        return "<span style=\"display: inline-block; background: #f55; color: white; padding: 2px 8px; border-radius: 4px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [ content ] no encontrado</span>";
    }

});




/**
 *
 * type = [primary|secondary|success|info|warning|danger|light|dark|link]
 * {Alert type='primary' clase=''} **Primary!** This is a primary alert-check it out! {/Alert}
 *
*/
Barrio::shortcodeAdd('Alert', function ($attrs, $content) {
    extract($attrs);
    // atributos
    $type = (isset($type)) ? $type : '';
    $cls = (isset($cls)) ? $cls : 'mt-3 mb-3';
    // convertimos el markdown
    $content = Parsedown::instance()->text($content);
    $content = Barrio::applyFilter(
        'content',
        '<div class="alert alert-'.$type.' '.$cls.'">
        '.$content.
        '</div>'
    );
    $content = preg_replace('/\s+/', ' ', $content);

    if ($type) {
        return $content;
    } else {
        return "<span style=\"display: inline-block; background: #f55; color: white; padding: 2px 8px; border-radius: 4px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [type] no encontrado</span>";
    }
});




/**
 * type = Tipo de boton [ouline] ( opcinal )
 * color = [primary|secondary|success|info|warning|danger|light|dark|href]
 * text = texto del boton
 * id =  id del boton (opcional)
 * href = direcciÃ³n  (opcional)
 * { Btn color='primary' text='Primary' id='btn' href='//example.com' }
*/
Barrio::shortcodeAdd('Btn', function ($atributos) {
    extract($atributos);
    // atributos
    $text = (isset($text)) ? $text : '';
    $color = (isset($color)) ? $color : 'primary';
    $id = (isset($id)) ? $id : uniqid();
    $href = (isset($href)) ? $href : '';
    $size = (isset($size)) ? 'btn-'.$size : '';
    $type = (isset($type) == 'outline') ?  'btn-outline-'.$color : 'btn-'.$color;
    // si no hay texto no enseñar
    if ($text) {
        $html = '<a class="mt-3 mb-3 btn '.$size.' '.$type.'" href="'.$href.'" title="'.$text.'">'.$text.'</a>';
        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
    } else {
        return "<span style=\"display: inline-block; background: #f55; color: white; padding: 2px 8px; border-radius: 4px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [text] no encontrado</span>";
    }
});



/**
*  Row
* - cls = css class
*   {Row}
*       bloques que sumen 12 en total
*   {/Row}
*/
Barrio::shortcodeAdd('Row', function ($attrs, $content) {
    extract($attrs);
    $cls = (isset($cls)) ? $cls : '';

    $type = (isset($type)) ? $type : 'fixed';
    $style = (isset($style)) ? $style : '';
    $bg = (isset($bg)) ? $bg : '';
    $imageStyle = '';
    if($bg){
        if(preg_match_all("/\/\//im", $bg)){
            // imagen
            $imageStyle = 'background:url('.$bg.') no-repeat center center '.$type.' transparent;background-size:cover;';
        }else{
            // color
            $imageStyle = 'background:'.$bg.';';
        }
    }

    $output = Barrio::applyFilter('content', '<div class="row '.$cls.'" style="'.$imageStyle.' '.$style.'">'.$content.'</div>');
    $output = preg_replace('/\s+/', ' ', $output);
    return $output;
});



/**
 * num = numero de columnas
 * clase = class
 *
 * {Col col='8'}
 *      texto en markdown
 * {/Col}
 */
Barrio::shortcodeAdd('Col', function ($attrs, $content) {
    extract($attrs);
    // atributos
    $num = (isset($num)) ? $num : '6';
    $cls = (isset($cls)) ? $cls : '';
    $style = (isset($style)) ? $style : '';
    $bg = (isset($bg)) ? $bg : '';
    $imageStyle = '';
    if($bg){
        if(preg_match_all("/\/\//im", $bg)){
            // imagen
            $imageStyle = 'background:url('.$bg.') no-repeat center center '.$type.' transparent;background-size:cover;';
        }else{
            // color
            $imageStyle = 'background:'.$bg.';';
        }
    }
    // convertir markdown
    $content = Parsedown::instance()->text($content);
    // enseñar
    $content = Barrio::applyFilter('content', '<div class="col-md-'.$num.' '.$cls.'" style="'.$imageStyle.' '.$style.'">'.$content.'</div>');
    $content = preg_replace('/\s+/', ' ', $content);
    return $content;
});




/**
 * size = Tamaño de la barra
 * color = [success | info | warning | danger ]
 * clase = otra clase
 * {Progress  size='25' color='primary'}
*/
Barrio::shortcodeAdd('Progress', function ($attrs) {
    extract($attrs);
    // atributos
    $size = (isset($size)) ? $size : '25';
    $color = (isset($color)) ? $color : 'primary';
    $cls = (isset($cls)) ? $cls : 'mt-2 mb-2';
    // enseñamos
    $html = '<div class="progress '.$cls.'">';
    $html .='   <div class="progress-bar bg-'.$color.'" role="progressbar" style="width:'.$size.'%" aria-valuenow="'.$size.'" aria-valuemin="0" aria-valuemax="100"></div>';
    $html .='</div>';
    $html = preg_replace('/\s+/', ' ', $html);
    return $html;
});



/**
*  Card
*  - col = Numero bloques que sumen 12 en total
*  - title = titulo
*  - cls = clase css
*  - img = imagen
*   {Card col='4? title='heart' img='{url}/content/imagenes/sin-imagen.svg'}
*       bloques que sumen 12 en total
*   {/Card}
*/
Barrio::shortcodeAdd('Card', function ($attrs, $content) {
    extract($attrs);
    // atributos
    $title = (isset($title)) ? $title : '';
    $img = (isset($img)) ? $img : '';
    $col = (isset($col)) ? $col : '4';
    $cls = (isset($cls)) ? $cls : '';
    $content = Parsedown::instance()->text($content);
    $output = Barrio::applyFilter('content', '<div class="card-text">'.$content.'</div>');
    $html = '<div class="col-md-'.$col.' mb-3">';
    $html .= '<div class="card '.$cls.'">';
    $html .= '  <img class="card-img-top" src="'.$img.'" alt="'.$title.'">';
    $html .= '  <div class="card-body p-3">';
    $html .= '    <h3 class="card-title">'.$title.'</h3>';
    $html .=      $output;
    $html .= '  </div>';
    $html .= '</div>';
    $html .= '</div>';
    $html = preg_replace('/\s+/', ' ', $html);
    if ($content) {
        return $html;
    } else {
        return "<span style=\"display: inline-block; background: #f55; color: white; padding: 2px 8px; border-radius: 4px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [content] no encontrado</span>";
    }
});




/**
 * id = identificacion unica
 * {Accordions id='acordeon'}Texto tarjeta{/Accordions}
*/
Barrio::shortCodeAdd('Accordions', function ($attrs, $content) {
    extract($attrs);
    $id = (isset($id)) ? $id : 'acordeon';
    $cls = (isset($cls)) ? $cls : 'mt-2 mb-2';
    $content = Barrio::applyFilter('content', $content);
    $content = Parsedown::instance()->text($content);
    $html = '<div id="'.$id.'"  class="accordion '.$cls.' ">'.$content.'</div>';
    $html = preg_replace('/\s+/', ' ', $html);

    if ($content) {
        return $html;
    } else {
        return "<span style=\"display: inline-block; background: #f55; color: white; padding: 2px 8px; border-radius: 4px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [content] no encontrado</span>";
    }
});

/**
 * title = el titulo
 * cls = extra classes
 * {Acordion  cñase="active" title='Titulo'}Texto oculto{/Acordion}
*/
Barrio::shortCodeAdd('Accordion', function ($attrs, $content) {
    extract($attrs);

    $parent = (isset($parent)) ? $parent : 'acordeon';
    $title = (isset($title)) ? $title : 'Titulo vacio';
    $id = (isset($id)) ? $id : 'acordeon1';
    $cls = (isset($cls)) ? $cls : '';
    $show = ($cls == 'active') ? 'show' : 'hide';
    $content = Parsedown::instance()->text($content);
    $content = Barrio::applyFilter('content', '<div class="accordion-content '.$show.'">'.$content.'</div>');

    $html = '<div class="accordion-title text-success">';
    $html .= '  <a class="'.$cls.'">'.$title.'</a>';
    $html .= '</div>';
    $html .= $content;
    $html = preg_replace('/\s+/', ' ', $html);

    if ($content) {
        return $html;
    } else {
        return "<span style=\"display: inline-block; background: #f55; color: white; padding: 2px 8px; border-radius: 4px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [content] no encontrado</span>";
    }
});


/**
 * type = icon class
 * href = href to
 * cls = custom class
 * {Icon type='phone2' href='624584452'}
 */
Barrio::shortCodeAdd('Icon', function ($atributos) {
    extract($atributos);
    // atributos
    $type = (isset($type)) ? $type : '';
    $href = (isset($href)) ? $href : '';
    $cls = (isset($cls)) ? $cls : 'mr-2';
    // si no hay imagen enseñar
    if ($type) {
        if($href){
            $html = '<a class="hasIcon" href="'.$href.'"><i class="icon-'.$type.' '.$cls.'"></i> </a>';
            $html = preg_replace('/\s+/', ' ', $html);
            return $html;
        }else{
            $html = '<i class="icon-'.$type.' '.$cls.'"></i> ';
            $html = preg_replace('/\s+/', ' ', $html);
            return $html;
        }
    } else {
        return "<span style=\"display: inline-block; background: #f55; color: white; padding: 2px 8px; border-radius: 4px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [type] no encontrado/span>";
    }
});


/*
 * ================================
 * Php
 * {Php}echo 'holas';{/Php}
 * ================================
 */
Barrio::shortCodeAdd('Php', function ($attr, $content) {
    ob_start();
    eval("$content");
    return ob_get_clean();
});


/**
*  Code
*   {Code type='php'}
*       bloques que sumen 12 en total
*   {/Code}
*/
Barrio::shortCodeAdd('Code', function ($attrs, $content) {
    extract($attrs);
    $code = (isset($code)) ? $code : 'php';
    if ($content) {
        $content = htmlentities(html_entity_decode($content));
        $output = Barrio::applyFilter('content', '<pre class="line-numbers language-'.$code.'"><code class="language-'.$code.'">'.$content.'</code></pre>');
        return $output;
    } else {
        return "<span style=\"display: inline-block; background: #f55; color: white; padding: 2px 8px; border-radius: 4px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [content] no encontrado</span>";
    }
});



/*
 * ================================
 * Config
 * Get config {Config name='title'}
 * ================================
 */
Barrio::shortCodeAdd('Config', function ($attrs) {
    extract($attrs);
    if ($name) {
        return Barrio::$config[$name];
    } else {
        return "<span style=\"display: inline-block; background: #f55; color: white; padding: 2px 8px; border-radius: 4px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Este shortocode le falta el atributo name</span>";
    }
});

/**
*   {Divider}
*   {Divider num='2'}
*/
Barrio::shortCodeAdd('Divider', function ($attrs) {
    extract($attrs);
    $num = (isset($num)) ? $num : '5';
    return '<hr class="mt-'.$num.' mb-'.$num.'" />';
});

/**
 * {Contact} // usa el del config.php
 * {Contact mail='nakome@demo.com'}
 */
Barrio::shortCodeAdd('Contact', function ($atributos) {
    extract($atributos);
    // atributos
    $mail = (isset($mail)) ? $mail : Barrio::$config['email'];
    $arrLang = array(
        'email'     => 'Email',
        'subject'   => 'Asunto',
        'message'   => 'Mensaje',
        'send'      => 'Enviar Correo',
        'error'     => 'Lo siento hubo un problema al enviarlo por favor intentelo otra vez',
        'success'   => 'Gracias tu mensaje ha sido enviado'
    );

    $language = $arrLang;

    $error = '';
    if (isset($_POST['Submit'])) {
        // vars
        $recepient = $mail;
        $sitename = Barrio::urlBase();
        $service = trim($_POST["subject"]);
        $email = trim($_POST["email"]);
        $text = trim($_POST["message"]);

        $message = "Service: $service \n\nMessage: $text";

        $pagetitle = "Nuevo mensaje desde \"$sitename\"";
        // send mail
        if (mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\" \nFrom: <$email>")) {
            // success
            $error = '<p><strong>'.$language['success'].' ....</strong></p>';
        } else {
            // error
            $error = '<p style="color:red;"><strong>'.$language['error'].'..</strong></p>';
        };
    }
    // show error
    $html  = $error;
    $html .= '  <form class="form" action="" method="post"  name="form1">';
    $html .= '      <div class="form-group">';
    $html .= '        <label>'.$language['email'].'</label>';
    $html .= '        <input type="email" name="email" class="form-control" required>';
    $html .= '      </div>';
    $html .= '      <div class="form-group">';
    $html .= '        <label>'.$language['subject'].'</label>';
    $html .= '        <input type="text" name="subject" class="form-control" required>';
    $html .= '      </div>';
    $html .= '      <div class="form-group">';
    $html .= '        <label>'.$language['message'].'</label>';
    $html .= '        <textarea  name="message" class="form-control" rows="5" required></textarea>';
    $html .= '      </div>';
    $html .= '      <input type="submit" name="Submit" class="btn btn-outline-dark btn-default" value="'.$language['send'].'">';
    $html .= '  </form>';
    return $html;
});


/**
 * {Icono type='phone2' texto='624584452'}
 */
Barrio::shortcodeAdd('Icono_demo', function ($attrs) {
    extract($attrs);
    // atributos
    $type = (isset($type)) ? $type : '';
    // si no hay imagen enseñar
    if ($type) {
        $html = '<div class="demo_icono">';
        $html .= '<p class="text-center p-2"><i class="text-dark icon-'.$type.'"></i> <br>'.$type.'</p>';
        $html .= '</div>';

        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
    } else {
        return "<span style=\"display: inline-block; background: #f55; color: white; padding: 2px 8px; border-radius: 4px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Este shortocode le falta el type</span>";
    }
});







