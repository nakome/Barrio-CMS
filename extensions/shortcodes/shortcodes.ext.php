<?php  defined('BARRIO') or die('Sin accesso a este script.');


/**
*   Iframe
*   {iframe src='monchovarela.es'}
*/
Barrio::shortcodeAdd('Iframe', function ($atributos) {
    // extraemos los atributos (en este caso $src)
    extract($atributos);
    // el codigo del enlace
    $src = (isset($src)) ? $src : '';
    $clase = (isset($clase)) ? $clase : 'iframe mt-2 mb-4';
    // comprobamos que exista el $id
    if ($src) {
        $html = '<section class="'.$clase.'">';
        $html .= '<iframe src="https://'.$src.'" frameborder="0" allowfullscreen></iframe>';
        $html .= '</section>';
        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
        // si no se pone el atributo id que avise
    } else {
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Este shortocode le falta el id</span>";
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
    $clase = (isset($clase)) ? $clase : 'iframe';
    // comprobamos que exista el $id
    if ($id) {
        $html = '<section class="'.$clase.' mt-2 mb-4">';
        $html .= '<iframe src="//www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe>';
        $html .= '</section>';
        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
        // si no se pone el atributo id que avise
    } else {
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Este shortocode le falta el id</span>";
    }
});

/**
*   Vimeo
*    {Vimeo id='149129821'}
*/
Barrio::shortcodeAdd('Vimeo', function ($atributos) {
    // extraemos los atributos
    extract($atributos);
    // el codigo del enlace
    $id = (isset($id)) ? $id : '';
    $clase = (isset($clase)) ? $clase : 'iframe';
    // comprobamos que exista el $id
    if ($id) {
        $html = '<section class="'.$clase.'">';
        $html .= '<iframe src="https://player.vimeo.com/video/'.$id.'" frameborder="0" allowfullscreen></iframe>';
        $html .= '</section>';
        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
        // si no se pone el atributo id que avise
    } else {
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Este shortocode le falta el id</span>";
    }
});


/**
*   Texto
*   {Texto bg='blue' color='white'}Color texto{/Texto}
*/
Barrio::shortcodeAdd('Texto', function ($atributos, $contenido) {
    // extraemos los atributos (en este caso $color)
    extract($atributos);
    // definimos el color, por defecto sera blue (tienen que ser en ingles)
    $color = (isset($color)) ? $color : '';
    $bg = (isset($bg)) ? $bg : '';
    // parseamos para poder usar markdown
    $contenido = Parsedown::instance()->text($contenido);
    // aplicamos un filtro para escribir dentro del shortcode
    $resultado = Barrio::applyFilter('content', '<div class="p-2" style="color:'.$color.';background-color:'.$bg.'">'.$contenido.'</div>');
    // enseñamos la plantilla
    $resultado = preg_replace('/\s+/', ' ', $resultado);
    if ($contenido) {
        return $resultado;
    } else {
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Este shortocode le falta el contenido</span>";
    }

});




/**
 *
 * type = [primary|secondary|success|info|warning|danger|light|dark|link]
 * {Alert type='primary' clase=''} **Primary!** This is a primary alert-check it out! {/Alert}
 *
*/
Barrio::shortcodeAdd('Alert', function ($atributos, $contenido) {
    extract($atributos);
    // atributos
    $type = (isset($type)) ? $type : '';
    $clase = (isset($clase)) ? $clase : 'mt-3 mb-3';
    // convertimos el markdown
    $contenido = Parsedown::instance()->text($contenido);
    $contenido = Barrio::applyFilter('content', '<div class="alert alert-'.$type.' '.$clase.'">'.$contenido.'</div>');
    $contenido = preg_replace('/\s+/', ' ', $contenido);

    if ($type) {
        return $contenido;
    } else {
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Este shortocode le falta el atributo type</span>";
    }
});




/**
 * type = Tipo de boton [ouline] ( opcinal )
 * color = [primary|secondary|success|info|warning|danger|light|dark|link]
 * text = texto del boton
 * id =  id del boton (opcional)
 * link = direcciÃ³n  (opcional)
 * { Btn color='primary' text='Primary' id='btn' link='//example.com' }
*/
Barrio::shortcodeAdd('Btn', function ($atributos) {
    extract($atributos);
    // atributos
    $text = (isset($text)) ? $text : '';
    $link = (isset($link)) ? $link : '';
    $color = (isset($color)) ? $color : 'primary';
    $id = (isset($id)) ? $id : uniqid();
    $link = (isset($link)) ? $link : '';
    $size = (isset($size)) ? 'btn-'.$size : '';
    $type = (isset($type) == 'outline') ?  'btn-outline-'.$color : 'btn-'.$color;
    // si no hay texto no enseñar
    if ($text) {
        $html = '<a class="mt-3 mb-3 btn '.$size.' '.$type.'" href="'.$link.'" title="'.$text.'">'.$text.'</a>';
        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
    } else {
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Este shortocode le falta el atributo text</span>";
    }
});



/**
*  Bloques
* - clase = css class
*   {Bloques}
*       bloques que sumen 12 en total
*   {/Bloques}
*/
Barrio::shortCodeAdd('Bloques', function ($attrs, $contenido) {
    extract($attrs);
    $clase = (isset($clase)) ? $clase : '';
    $resultado = Barrio::applyFilter('content', '<div class="row '.$clase.'">'.$contenido.'</div>');
    $resultado = preg_replace('/\s+/', ' ', $resultado);
    return $resultado;
});



/**
 * col = numero de columnas
 * clase = class
 *
 * {Bloque col='8'}
 *      texto en markdown
 * {/Bloque}
 */
Barrio::shortcodeAdd('Bloque', function ($atributos, $contenido) {
    extract($atributos);
    // atributos
    $col = (isset($col)) ? $col : '6';
    $clase = (isset($clase)) ? $clase : '';
    // convertir markdown
    $contenido = Parsedown::instance()->text($contenido);
    // enseñar
    $contenido = Barrio::applyFilter('content', '<div class="col-md-'.$col.' col-'.$col.' '.$clase.'">'.$contenido.'</div>');
    $contenido = preg_replace('/\s+/', ' ', $contenido);
    return $contenido;
});




/**
 * size = Tamaño de la barra
 * color = [success | info | warning | danger ]
 * clase = otra clase
 * {Barra  size='25' color='primary'}
*/
Barrio::shortcodeAdd('Barra', function ($atributos) {
    extract($atributos);
    // atributos
    $size = (isset($size)) ? $size : '25';
    $color = (isset($color)) ? $color : 'primary';
    $clase = (isset($clase)) ? $clase : 'mt-2 mb-2';
    // enseñamos
    $html = '<div class="progress '.$clase.'">';
    $html .='   <div class="progress-bar bg-'.$color.'" role="progressbar" style="width:'.$size.'%" aria-valuenow="'.$size.'" aria-valuemin="0" aria-valuemax="100"></div>';
    $html .='</div>';
    $html = preg_replace('/\s+/', ' ', $html);
    return $html;
});






/**
*  Bloques
*  - icon = icono del servicio
*  - clase = clase css
*   {Servicio icon='heart'}
*       bloques que sumen 12 en total
*   {/Servicio}
*/
Barrio::shortCodeAdd('Servicio', function ($atributos, $contenido) {
    extract($atributos);
    // atributos
    $icon = (isset($icon)) ? $icon : '#';
    $col = (isset($col)) ? $col : '4';
    $clase = (isset($clase)) ? $clase : 'text-center';
    $contenido = Parsedown::instance()->text($contenido);
    $resultado = Barrio::applyFilter('content', '<div class="holder-section">'.$contenido.'</div>');

    $html = '<div class="col-md-'.$col.' col-'.$col.'  '.$clase.'">';
    $html .= '<div class="mt-3 mb-3 p-3">';
    $html .= '<i class="icon-big icon-'.$icon.' text-success"></i>';
    $html .=  $resultado;
    $html .= '  </div>';
    $html .= '</div>';
    $html = preg_replace('/\s+/', ' ', $html);
    if ($contenido) {
        return $html;
    } else {
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Este shortocode le falta el contenido</span>";
    }
});





/**
*  Card
*  - col = Numero bloques que sumen 12 en total
*  - title = titulo
*  - clase = clase css
*  - img = imagen
*   {Card col='4? title='heart' img='{url}/content/imagenes/sin-imagen.svg'}
*       bloques que sumen 12 en total
*   {/Card}
*/
Barrio::shortCodeAdd('Card', function ($atributos, $contenido) {
    extract($atributos);
    // atributos
    $title = (isset($title)) ? $title : '';
    $img = (isset($img)) ? $img : '';
    $col = (isset($col)) ? $col : '4';
    $clase = (isset($clase)) ? $clase : '';
    $contenido = Parsedown::instance()->text($contenido);
    $resultado = Barrio::applyFilter('content', '<div class="card-text">'.$contenido.'</div>');

    $html = '<div class="col-md-'.$col.' col-'.$col.'">';
    $html .= '<div class="card '.$clase.'">';
    $html .= '  <img class="card-img-top" src="'.$img.'" alt="'.$title.'">';
    $html .= '  <div class="card-body m-3">';
    $html .= '    <h4 class="card-title m-1">'.$title.'</h4>';
    $html .=      $resultado;
    $html .= '  </div>';
    $html .= '</div>';
    $html .= '</div>';
    $html = preg_replace('/\s+/', ' ', $html);
    if ($contenido) {
        return $html;
    } else {
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Este shortocode le falta el contenido</span>";
    }
});





/**
 * id = identificacion unica
 * {Acordeones id='acordeon'}Texto tarjeta{/Overlay}
*/
Barrio::shortcodeAdd('Acordeones', function ($atributos, $contenido) {
    extract($atributos);
    $id = (isset($id)) ? $id : 'acordeon';
    $clase = (isset($clase)) ? $clase : 'mt-2 mb-2';
    $contenido = Barrio::applyFilter('content', $contenido);
    $contenido = Parsedown::instance()->text($contenido);
    $html = '<div id="'.$id.'"  class="accordion '.$clase.' ">'.$contenido.'</div>';
    $html = preg_replace('/\s+/', ' ', $html);

    if ($contenido) {
        return $html;
    } else {
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Este shortocode le falta el contenido</span>";
    }
});

/**
 * title = el titulo
 * clase = extra classes
 * {Acordeon  cñase="active" title='Titulo'}Texto oculto{/Acordeon}
*/
Barrio::shortcodeAdd('Acordeon', function ($atributos, $contenido) {
    extract($atributos);

    $parent = (isset($parent)) ? $parent : 'acordeon';
    $title = (isset($title)) ? $title : 'Titulo vacio';
    $id = (isset($id)) ? $id : 'acordeon1';
    $clase = (isset($clase)) ? $clase : '';
    $show = ($clase == 'active') ? 'show' : 'hide';
    $contenido = Parsedown::instance()->text($contenido);
    $contenido = Barrio::applyFilter('content', '<div class="accordion-content '.$show.'">'.$contenido.'</div>');

    $html = '<div class="accordion-title text-success">';
    $html .= '  <a class="'.$clase.'">'.$title.'</a>';
    $html .= '</div>';
    $html .= $contenido;
    $html = preg_replace('/\s+/', ' ', $html);

    if ($contenido) {
        return $html;
    } else {
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Este shortocode le falta el contenido</span>";
    }
});


/**
 * type = icon class
 * link = link to
 * clase = custom class
 * {Icono type='phone2' link='624584452'}
 */
Barrio::shortcodeAdd('Icono', function ($atributos) {
    extract($atributos);
    // atributos
    $type = (isset($type)) ? $type : '';
    $link = (isset($link)) ? $link : '';
    $clase = (isset($clase)) ? $clase : 'mr-2';
    // si no hay imagen enseñar
    if ($type) {
        if($link){
            $html = '<a class="hasIcon" href="'.$link.'"><i class="icon-'.$type.' '.$clase.'"></i> </a>';
            $html = preg_replace('/\s+/', ' ', $html);
            return $html;
        }else{
            $html = '<i class="icon-'.$type.' '.$clase.'"></i> ';
            $html = preg_replace('/\s+/', ' ', $html);
            return $html;
        }
    } else {
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Este shortocode le falta el type</span>";
    }
});


/**
*  Code
* - clase = css class
*   {Code type='php'}
*       bloques que sumen 12 en total
*   {/Code}
*/
Barrio::shortCodeAdd('Code', function ($attrs, $contenido) {
    extract($attrs);
    $code = (isset($code)) ? $code : 'php';
    if ($contenido) {
        $contenido = htmlentities($contenido);
        $resultado = Barrio::applyFilter('content', '<pre class="line-numbers language-'.$code.'"><code class="language-'.$code.'">'.$contenido.'</code></pre>');
        return $resultado;
    } else {
        return "<span style=\"display: inline-block; background: red; color: white; padding: 2px 8px; border-radius: 10px; font-family: 'Lucida Console', Monaco, monospace, sans-serif; font-size: 80%\"><b>Barrio</b>: Este shortocode le falta el contenido</span>";
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
 * {Contacto} // usa el del config.php
 * {Contacto mail='nakome@demo.com'}
 */
Barrio::shortCodeAdd('Contacto', function ($atributos) {
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
Barrio::shortcodeAdd('Icono_demo', function ($atributos) {
    extract($atributos);
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







