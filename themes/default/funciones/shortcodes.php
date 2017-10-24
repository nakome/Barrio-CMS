<?php

/**
*  Code
* - clase = css class
*   {Code type='php'}
*       bloques que sumen 12 en total
*   {/Code}
*/
Barrio::shortCodeAdd('Code',function($attrs,$contenido){
    extract($attrs);
    $code = (isset($code)) ? $code : 'php';
    $contenido = htmlentities($contenido);
    $resultado = Barrio::applyFilter('content','<pre class="line-numbers"><code class="language-'.$code.'">'.$contenido.'</code></pre>');
    return $resultado;
});


/**
*  Bloques
* - clase = css class
*   {Bloques}
*       bloques que sumen 12 en total
*   {/Bloques}
*/
Barrio::shortCodeAdd('Bloques',function($attrs,$contenido){
    extract($attrs);
    $clase = (isset($clase)) ? $clase : '';
    $resultado = Barrio::applyFilter('content','<div class="row '.$clase.'">'.$contenido.'</div>');
    $resultado = preg_replace('/\s+/', ' ', $resultado);
    return $resultado;
});

/**
*  Galeria
*   {Galeria}
*       Imagen
*   {/Galeria}
*/
Barrio::shortCodeAdd('Galeria',function($attrs,$contenido){
    extract($attrs);
    $resultado = Barrio::applyFilter('content','<div id="masonry">'.$contenido.'</div>');
    $resultado = preg_replace('/\s+/', ' ', $resultado);
    return $resultado;
});

/**
*  Imagen
*  {Imagen texto='El texto' img='{url}/content/imagenes/pequenas/1.jpg' link='{url}'}
*/
Barrio::shortcodeAdd('Imagen', function ($atributos) {
    extract($atributos);
    // atributos
    $link = (isset($link)) ? $link : '#';
    $img = (isset($img)) ? $img : '';
    $texto = (isset($texto)) ? $texto : '';
    // si es link añadir clase
    $isLink = '';
    if($link != '#') $isLink = 'isLink';
    // si no hay imagen el shortcode no funciona
    if($img){
        $html = '<figure class="'.$isLink.'">';
        $html .= '<img src="'.$img.'" alt="'.$texto.'" />';
        $html .= '<figcaption><a href="'.$link.'" title="'.$texto.'">'.$texto.'</a></figcaption>';
        $html .= '</figure>';
        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
    }else{
        return 'Este shortcode le falta el atributo src';
    }
});

/**
 * col = numero de columnas
 * clase = class
 *
 * {Bloque col='8'}
 *      texto en markdown
 * {/Bloque}
 */
Barrio::shortcodeAdd('Bloque', function ($atributos,$contenido) {
    extract($atributos);
    // atributos
    $col = (isset($col)) ? $col : '6';
    $clase = (isset($clase)) ? $clase : '';
    // convertir markdown
    $contenido = Parsedown::instance()->text($contenido);
    // enseñar
    $contenido = Barrio::applyFilter('content', '<div class="col-'.$col.'">'.$contenido.'</div>');
    $contenido = preg_replace('/\s+/', ' ', $contenido);
    return $contenido;
});

/**
 * {Bloque_izq img='imagen.jpg' texto='esta es una imagen' col='8'}
 *      texto en markdown
 * {/Bloque_izq}
 */
Barrio::shortcodeAdd('Bloque_izq', function ($atributos,$contenido) {
    extract($atributos);
    // atributos
    $img = (isset($img)) ? $img : '';
    $text = (isset($texto)) ? $texto : '';
    $col = (isset($col)) ? $col : '6';
    $clase = (isset($clase)) ? $clase : '';
    // convertir markdown
    $contenido = Parsedown::instance()->text($contenido);
    // si no hay imagen enseñar error
    if ($img) {
        $html = '<div class="row">';
        $html .= '<div class="col-'.$col.'">';
        $html .= '<img class="full-width '.$clase.'" src="'.$img.'" alt="'.$text.'"/>';
        $html .='</div>';
        $html .= Barrio::applyFilter('content', '<div class="col'.($col-12).'">'.$contenido.'</div>');
        $html .='</div>';
        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
    } else {
        return 'Este shortcode le falta el atributo src';
    }
});


/**
 * {Bloque_drch img='imagen.jpg' texto='esta es una imagen' col='8'}
 *      texto en markdown
 * {/Bloque_drch}
 */
Barrio::shortcodeAdd('Bloque_drch', function ($atributos,$contenido) {
    extract($atributos);
    // atributos
    $img = (isset($img)) ? $img : '';
    $text = (isset($texto)) ? $texto : '';
    $col = (isset($col)) ? $col : '6';
    $clase = (isset($clase)) ? $clase : '';
    // convertir markdown
    $contenido = Parsedown::instance()->text($contenido);
    // si no hay imagen enseñar
    if ($img) {
        $html = '<div class="row">';
        $html .= Barrio::applyFilter('content', '<div class="col'.($col-12).'">'.$contenido.'</div>');
        $html .= '<div class="col-'.$col.'">';
        $html .= '  <img class="full-width '.$clase.'" src="'.$img.'" alt="'.$text.'"/>';
        $html .= '</div>';
        $html .='</div>';
        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
    } else {
        return 'Este shortcode le falta el atributo src';
    }
});


/**
 * {Contacto} // usa el del config.php
 * {Contacto mail='nakome@demo.com'}
 */
Barrio::shortCodeAdd('Contacto',function($atributos){
    extract($atributos);
    // atributos
    $mail = (isset($mail)) ? $mail : Barrio::$config['email'];
    // error
    $error = '';
    if(isset($_POST['Submit'])){

      // variables predifinidas
      $recepient = $mail;
      $sitename = Barrio::$config['title'];

      // atributos formulario
      $service = trim($_POST["subject"]);
      $name = trim($_POST["name"]);
      $email = trim($_POST["email"]);
      $text = trim($_POST["message"]);
      // mensaje
      $message = "Asunto: $service \n\Nombre: $name \Mensaje: $text";
      $pagetitle = "Nuevo mensaje desde \"$sitename\"";
      // send mail
      if(mail($recepient,$pagetitle,$message,"Content-type: text/plain; charset=\"utf-8\" \nFrom: $name <$email>")){
        // exito
        $error = '<p><strong>Gracias tu mensaje ha sido enviado ....</strong></p>';
      }else{
        // error
        $error = '<p style="color:red;"><strong>Lo siento hubo un problema al enviarlo por favor intentelo otra vez..</strong></p>';
      };
    }
    // formulario
    $html = '<div class="row">';
    $html .= '<div class="col-6">';
    $html .= '  <form class="form" action="" method="post"  name="form1">';
    $html .= '      <div class="form-group">';
    $html .= '        <label>Nombre</label>';
    $html .= '        <input type="text" name="name" class="form-control" required>';
    $html .= '      </div>';
    $html .= '      <div class="form-group">';
    $html .= '        <label>Email</label>';
    $html .= '        <input type="email" name="email" class="form-control" required>';
    $html .= '      </div>';
    $html .= '      <div class="form-group">';
    $html .= '        <label>Asunto</label>';
    $html .= '        <input type="text" name="subject" class="form-control" required>';
    $html .= '      </div>';
    $html .= '      <div class="form-group">';
    $html .= '        <label>Mensaje</label>';
    $html .= '        <textarea  name="message" class="form-control" rows="10" required></textarea>';
    $html .= '      </div>';
    $html .= '      <input type="submit" name="Submit" class="btn btn-outline" value="Enviar Formulario">';
    $html .= '  </form>';
    $html .= '</div>';
    $html = preg_replace('/\s+/', ' ', $html);
    return $error.$html;
});


/**
*   Texto
*   {Texto color='blue'}Color texto{/Texto}
*/
Barrio::shortcodeAdd('Texto',function($atributos,$contenido){
    // extraemos los atributos (en este caso $color)
    extract($atributos);
    // definimos el color, por defecto sera blue (tienen que ser en ingles)
    $color = (isset($color)) ? $color : 'blue';
    // parseamos para poder usar markdown
    $contenido = Parsedown::instance()->text($contenido);
    // aplicamos un filtro para escribir dentro del shortcode
    $resultado = Barrio::applyFilter('content','<div style="color:'.$color.'">'.$contenido.'</div>');
    // enseñamos la plantilla
    $resultado = preg_replace('/\s+/', ' ', $resultado);
    return $resultado;
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
    $clase = (isset($clase)) ? $clase : 'embed-responsive embed-responsive-16by9';
    // comprobamos que exista el $id
    if($id){
        $html = '<section class="'.$clase.'">';
        $html .= '<iframe src="//www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe>';
        $html .= '</section>';
        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
    // si no se pone el atributo id que avise
    }else{
        return 'Este shortcode le falta el atributo id';
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
    $id = (isset($src)) ? $src : '';
    $clase = (isset($clase)) ? $clase : 'embed-responsive embed-responsive-16by9';
    // comprobamos que exista el $id
    if ($id) {
        $html = '<section class="'.$clase.'">';
        $html .= '<iframe src="https://player.vimeo.com/video/'.$id.'" frameborder="0" allowfullscreen></iframe>';
        $html .= '</section>';
        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
        // si no se pone el atributo id que avise
    } else {
        return 'Este shortcode le falta el atributo id';
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
    if ($text && $link) {
        $html = '<a class="mt-3 mb-3 btn '.$size.' '.$type.'" href="'.$link.'" title="'.$text.'">'.$text.'</a>';
        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
    } else {
        return 'Este shortcode le falta el atributo texto o link';
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
 * type = tipo de icono
 * {Icono type='phone2' texto='624584452'}
 */
Barrio::shortcodeAdd('Icono', function ($atributos) {
    extract($atributos);
    // atributos
    $type = (isset($type)) ? $type : '';

    // si no hay imagen enseñar
    if ($type) {
        $html = '<i class="icon-'.$type.'"></i> ';
        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
    } else {
        return 'Este shortcode le falta el atributo type';
    }
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
        $html = '<div class="demo_icono col-md-2 col-sm-2">';
        $html .= '<p class="text-center p-2"><i class="text-dark icon-'.$type.'"></i> <br>'.$type.'</p>';
        $html .= '</div>';

        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
    } else {
        return 'Este shortcode le falta el atributo type';
    }
});



/**
 * col = 1-12 (combinaciones 4+4+4 6+6 8+4 3+3+3+3 ) = total 12
 * img = url de la imagen
 * title = texto del titulo
 * {Card title='Card title'  img='http://example.com' }Texto tarjeta{/Card}
*/
Barrio::shortcodeAdd('Card', function ($atributos, $contenido) {
    extract($atributos);

    $title = (isset($title)) ? $title : 'Card title';
    $img = (isset($img)) ? $img : '';
    $col = (isset($col)) ? $col : '4';

    $contenido = Barrio::applyFilter('content', $contenido);

    $html = '<div class="col-'.$col.' ">';
    $html .= ' <div class="card ">';
    if ($img) {
        $html .= ' <img class="card-img-top img-fluid" src="'.$img.'"/>';
    }
    $html .= ' <div class="card-body">';
    if ($title) {
        $html .= ' <h4 class="card-title">'.$title.'</h4>';
    }
    $html .= $contenido;
    $html .= ' </div>';
    $html .= ' </div>';
    $html .= ' </div>';

    $html = preg_replace('/\s+/', ' ', $html);
    return $html;
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
    return $html;
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

    $html = '<div class="accordion-title">';
    $html .= '  <a class="'.$clase.'">'.$title.'</a>';
    $html .= '</div>';
    $html .= $contenido;
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
Barrio::shortCodeAdd('Servicio',function($atributos,$contenido){
    extract($atributos);
    // atributos
    $icon = (isset($icon)) ? $icon : '#';
    $col = (isset($col)) ? $col : '4';
    $clase = (isset($clase)) ? $clase : 'text-center';
    $contenido = Parsedown::instance()->text($contenido);
    $resultado = Barrio::applyFilter('content','<div class="holder-section">'.$contenido.'</div>');

    $html = '<div class="col-'.$col.'   '.$clase.'">';
    $html .= '<div class="mt-3 mb-3 p-3">';
    $html .= '<i class="icon-big icon-'.$icon.'"></i>';
    $html .=  $resultado;
    $html .= '  </div>';
    $html .= '</div>';
    $html = preg_replace('/\s+/', ' ', $html);
    return $html;
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
Barrio::shortCodeAdd('Card',function($atributos,$contenido){
    extract($atributos);
    // atributos
    $title = (isset($title)) ? $title : '';
    $img = (isset($img)) ? $img : '';
    $col = (isset($col)) ? $col : '4';
    $clase = (isset($clase)) ? $clase : '';
    $contenido = Parsedown::instance()->text($contenido);
    $resultado = Barrio::applyFilter('content','<div class="card-text">'.$contenido.'</div>');

    $html = '<div class="col-'.$col.'">';
    $html .= '<div class="card '.$clase.'">';
    $html .= '  <img class="card-img-top" src="'.$img.'" alt="'.$title.'">';
    $html .= '  <div class="card-body m-3">';
    $html .= '    <h4 class="card-title m-1">'.$title.'</h4>';
    $html .=      $resultado;
    $html .= '  </div>';
    $html .= '</div>';
    $html .= '</div>';
    $html = preg_replace('/\s+/', ' ', $html);
    return $html;
});

