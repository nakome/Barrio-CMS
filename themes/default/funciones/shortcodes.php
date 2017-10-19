<?php


/**
*  Bloques
*   {Bloques}
*       bloques que sumen 12 en total
*   {/Bloques}
*/
Barrio::shortCodeAdd('Bloques',function($attrs,$contenido){
    extract($attrs);
    $resultado = Barrio::applyFilter('content','<div class="row">'.$contenido.'</div>');
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
        $html = '<a href="'.$link.'" title="'.$texto.'">';
        $html .= '<figure class="'.$isLink.'">';
        $html .= '<img src="'.$img.'" alt="'.$texto.'" />';
        $html .= '<figcaption>'.$texto.'</figcaption>';
        $html .= '</figure>';
        $html .= '</a>';
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
    // convertir markdown
    $contenido = Parsedown::instance()->text($contenido);
    // enseñar
    $contenido = Barrio::applyFilter('content', '<div class="col-'.$col.'">'.$contenido.'</div>');
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
    return $html;
});



