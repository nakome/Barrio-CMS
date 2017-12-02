<?php  defined('BARRIO') or die('Sin accesso a este script.');

/**
*   Iframe
*   {iframe src='monchovarela.es'}
*/
Barrio::shortCodeAdd('Iframe', function ($attrs) {
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
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [ src ] not found</span>";
    }
});

/**
*   Youtube
*   {Youtube cls='well' id='GxEc46k46gg'}
*/
Barrio::shortCodeAdd('Youtube', function ($atributos) {
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
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [ id ] not found.</span>";
    }
});

/**
*   Vimeo
*    {Vimeo id='149129821'}
*/
Barrio::shortCodeAdd('Vimeo', function ($attrs) {
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
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error  [id] not found.</span>";
    }
});


/**
*   Texto
*   {Text bg='blue' color='white'}Color texto{/Text}
*/
Barrio::shortCodeAdd('Text', function ($attrs, $content) {
    // extraemos los atributos (en este caso $color)
    extract($attrs);
    // definimos el color, por defecto sera blue (tienen que ser en ingles)
    $color = (isset($color)) ? $color : '';
    $bg = (isset($bg)) ? $bg : '';
    // parseamos para poder usar markdown
    $content = Parsedown::instance()->text($content);
    // aplicamos un filtro para escribir dentro del shortcode
    $output = Barrio::applyFilter(
        'content',
        '<div class="p-2" style="color:'.$color.';background-color:'.$bg.'">
        '.$content.'
        </div>'
    );
    // enseñamos la plantilla
    $output = preg_replace('/\s+/', ' ', $output);
    if ($content) {
        return $output;
    } else {
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [ content ] not found</span>";
    }

});




/**
 *
 * type = [primary|secondary|success|info|warning|danger|light|dark|link]
 * {Alert type='primary' cls=''} **Primary!** This is a primary alert-check it out! {/Alert}
 *
*/
Barrio::shortCodeAdd('Alert', function ($attrs, $content) {
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
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [type] not found</span>";
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
Barrio::shortCodeAdd('Btn', function ($atributos) {
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
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [text] not found</span>";
    }
});



/**
*  Blocks
* - cls = css class
*   {Blocks}
*       bloques que sumen 12 en total
*   {/Blocks}
*/
Barrio::shortCodeAdd('Blocks', function ($attrs, $content) {
    extract($attrs);
    $cls = (isset($cls)) ? $cls : '';
    $output = Barrio::applyFilter('content', '<div class="row '.$cls.'">'.$content.'</div>');
    $output = preg_replace('/\s+/', ' ', $output);
    return $output;
});



/**
 * col = numero de columnas
 * cls = class
 *
 * {Block col='8'}
 *      texto en markdown
 * {/Block}
 */
Barrio::shortCodeAdd('Block', function ($attrs, $content) {
    extract($attrs);
    // atributos
    $col = (isset($col)) ? $col : '6';
    $cls = (isset($cls)) ? $cls : '';
    // convertir markdown
    $content = Parsedown::instance()->text($content);
    // enseñar
    $content = Barrio::applyFilter('content', '<div class="col-md-'.$col.' '.$cls.'">'.$content.'</div>');
    $content = preg_replace('/\s+/', ' ', $content);
    return $content;
});




/**
 * size = Tamaño de la barra
 * color = [success | info | warning | danger ]
 * cls = otra clase
 * {ProgressBar  size='25' color='primary'}
*/
Barrio::shortCodeAdd('ProgressBar', function ($attrs) {
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
*  Bloques
*  - icon = icono del servicio
*  - cls = cls css
*   {Service icon='heart'}
*       bloques que sumen 12 en total
*   {/Service}
*/
Barrio::shortCodeAdd('Service', function ($attrs, $content) {
    extract($attrs);
    // atributos
    $icon = (isset($icon)) ? $icon : '#';
    $col = (isset($col)) ? $col : '4';
    $cls = (isset($cls)) ? $cls : 'text-center';
    $content = Parsedown::instance()->text($content);
    $output = Barrio::applyFilter('content', '<div class="holder-section">'.$content.'</div>');

    $html = '<div class="col-md-'.$col.'  '.$cls.'">';
    $html .= '<div class="mt-3 mb-3 p-3">';
    $html .= '<i class="icon-big icon-'.$icon.' text-success"></i>';
    $html .=  $output;
    $html .= '  </div>';
    $html .= '</div>';
    $html = preg_replace('/\s+/', ' ', $html);
    if ($content) {
        return $html;
    } else {
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [content] not found</span>";
    }
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
Barrio::shortCodeAdd('Card', function ($attrs, $content) {
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
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [content] not found</span>";
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
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [content] not found</span>";
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
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [content] not found</span>";
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
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [type] not found/span>";
    }
});


/*
 * ================================
 * Php
 * {php}echo 'holas';{/php}
 * ================================
 */
Barrio::shortCodeAdd('php', function ($attr, $content) {
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
        $content = htmlentities($content);
        $output = Barrio::applyFilter('content', '<pre class="line-numbers language-'.$code.'"><code class="language-'.$code.'">'.$content.'</code></pre>');
        return $output;
    } else {
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Error [content] not found</span>";
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
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Este shortocode le falta el atributo name</span>";
    }
});



/*
 * ================================
 * Php
 * {php}echo 'holas';{/php}
 * ================================
 */
Barrio::shortCodeAdd('php', function ($attr, $content) {
    ob_start();
    eval("$content");
    return ob_get_clean();
});


/**
 * {Contact} // usa el del config.php
 * {Contact mail='nakome@demo.com'}
 */
Barrio::shortCodeAdd('Contact', function ($atributos) {
    extract($atributos);
    // atributos
    $mail = (isset($mail)) ? $mail : Barrio::$config['email'];
    $lang = (Barrio::urlSegment(0)) ? Barrio::urlSegment(0) : Barrio::$config['charset'];
    $arrLang = array(
        'es' => array(
            'email'     => 'Email',
            'subject'   => 'Asunto',
            'message'   => 'Mensaje',
            'send'      => 'Enviar Correo',
            'error'     => 'Lo siento hubo un problema al enviarlo por favor intentelo otra vez',
            'success'   => 'Gracias tu mensaje ha sido enviado'
        ),
        'en' => array(
            'email'     => 'Email',
            'subject'   => 'Subject',
            'message'   => 'Message',
            'send'      => 'Send email',
            'error'     => 'Sorry, The email was not send please try again',
            'success'   => 'Thanks, The email has been send'
        )
    );

    $language = array();
    if (array_key_exists($lang, $arrLang)){
        $language = $arrLang[$lang];
    } else {
        $language = $arrLang['en'];
    }


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
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Este shortocode le falta el type</span>";
    }
});






