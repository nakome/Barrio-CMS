Title: Shortcodes ?
Description:  Cómo crear shortcodes
Template: articulo

----


Es muy fácil crear Shortcodes en **Barrio CMS** por ejemplo, vamos a crear un Shortcode que cambie el color del texto con el color que queramos.

{Code type='php'}<?php
// se llama con { Texto color=green}Hola mundo{/Texto }
// quitar espacios al principio y al final sino lo hago
// se vería el shortcode :(
// llamamos la funcion mejor capitalizada (letra mayúscula)
Barrio::shortcodeAdd('Texto',function($atributos,$contenido){
    // extraemos los atributos (en este caso $color)
    extract($atributos);
    // definimos el color, por defecto sera blue (tienen que ser en ingles)
    $color = (isset($color)) ? $color : 'blue';
    // parseamos para poder usar markdown
    $contenido = Parsedown::instance()->text($contenido);
    // aplicamos un filtro para escribir dentro del shortcode
    $resultado = Barrio::applyFilter('content','<div style="color:'.$color.'">'.$contenido.'</div>');
    // quitamos espacios
    $resultado = preg_replace('/\s+/', ' ', $resultado);
    // enseñamos la plantilla
    return $resultado;
});
{/Code}

Ahora si escribimos dentro de **corchetes**  `Texto color=green` y dentro de este el texto y cerramos  con **corchetes** `/Texto` obtenemos esto:

El resultado es este:
{Code type='php'}{ Texto color=green}
    Este es un texto dentro de un Shortcode en el que puedo usar **Markdown**
{/Texto }
{/Code}

{Texto color=green}
Este es un texto dentro de un Shortcode en el que puedo usar **Markdown**
{/Texto }


También puedes usar **código de color**

{Code type='php'}{ Texto color='#f00'} // con comillas simples
    Hola soy **Rojo**
{/Texto }
{/Code}


{Texto color='#f00'}
   Hola soy **Rojo**
{/Texto}


Ahora vamos hacer un Shortcode para incrustar videos de Youtube.
En este caso **no necesitamos escribir dentro** así que es mas facil aun.

{Code type='php'}<?php
// agregar Shortcode { Youtube id'=GxEc46k46gg' clase='si quieres usar otra'}
Barrio::shortcodeAdd('Youtube', function ($atributos) {
    // extraemos los atributos (en este caso $src)
    extract($atributos);
    // el codigo del enlace
    $id = (isset($id)) ? $id : '';
    // por defecto usamos la clase embed-responsive y embed-responsive-16by9
    $clase = (isset($clase)) ? $clase : 'embed-responsive embed-responsive-16by9';
    // comprobamos que exista el $src
    if($id){
        // enseñamos el html
        $html = '<section class="'.$clase.'">';
        $html .= '<iframe src="//www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe>';
        $html .= '</section>';
        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
    // si no se pone el atributo src que avise
    }else{
        return 'Este shortcode le falta el atributo id';
    }
});
{/Code}

El resultado es este:

{Code type='php'}{ Youtube id='GxEc46k46gg'}{/Code}

{Youtube id='GxEc46k46gg'}


**En caso de no poner el atributo src saldria esto:**


{Youtube}



Ahora vamos hacer lo mismo pero con **Vimeo**:

{Code type='php'}<?php
// agregar Shortcode { Vimeo src=149129821 clase='si quieres usar otra'}
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
{/Code}

El resultado es este:


{Vimeo id='149129821'}




### Y mucho mas


Con los Shortcodes podemos crear desde **galerías**, **formularios** , **incrustar videos**, **Musica**, **Cambiar el Css** y todo un largo etcétera.




### Pero y en las plantillas html

En las plantillas hay que usar otra función llamada `Barrio::actionAdd()` para crear la función y `Barrio::actionRun()` para llamarla.

Hay varios **actionRun** que son **meta** , **head** y **footer** que como su nombre indica son para determinadas zonas de la plantilla, pero podemos crear las que queramos en el archivo `func.php` de la plantilla el codigo seria algo asi:


**vamos a crear una función como el shortcode Youtube**


{Code type='php'}<?php
Barrio::actionAdd('Youtube',function($src = ''){
    // el código del enlace
    $src = (isset($src)) ? $src : '';
    // comprobamos que exista el $src
    if($src){
        // enseñamos el html
        // usamos la clase iframe para hacerlo responsive
        // échale un ojo a  themes/default/assets/css/main.css
        $html = '<section class="iframe">';
        $html .= '<iframe src="//www.youtube.com/embed/'.$src.'" frameborder="0" allowfullscreen></iframe>';
        $html .= '</section>';
        $html = preg_replace('/\s+/', ' ', $html);
        // ahora se llama con echo o print
        echo $html;
    // si no se pone el atributo src que avise
    }else{
        // ahora se llama con echo o print
        echo 'Este shortcode le falta el atributo src';
    }
});
{/Code}

Si te fijas solo cambia en que ya no tenemos `extract($atributos)` y en vez de return usamos echo asi es prácticamente igual al shortcode.


Para llamarlo en la plantilla escribiremos esto:

{Code type='php'}<?php Barrio::actionRun('Youtube',['GxEc46k46gg']);?>{/Code}

Y podemos hacer lo mismo que con los Shortcodes desde **galerias**, **formularios** , **incrustar videos**, **Música**, **Cambiar el Css** y todo un largo etcétera.

