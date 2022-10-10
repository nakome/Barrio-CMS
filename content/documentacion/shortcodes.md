Title: Shortcodes
Description: Como funciona Barrio CMS.
Template: index
----


Es muy fácil crear Shortcodes en **Barrio CMS** por ejemplo, vamos a crear un Shortcode que cambie el color del texto con el color que queramos.

[Code type='php']<?php
// llamamos la funcion mejor capitalizada (letra mayúscula)
Shortcode::add('Texto',function($atributos,$contenido){
    // extraemos los atributos (en este caso $color)
    extract($atributos);
    // definimos el color, por defecto sera blue (mejor en ingles)
    $color = (isset($color)) ? $color : 'blue';
    // parseamos para poder usar markdown
    $contenido = Parsedown::instance()->text($contenido);
    // aplicamos un filtro para escribir dentro del shortcode
    $resultado = Filter::apply('content','<div style="color:'.$color.'">'.$contenido.'</div>');
    // quitamos espacios
    $resultado = preg_replace('/\s+/', ' ', $resultado);
    // enseñamos la plantilla
    return $resultado;
});
[/Code]

Ahora si escribimos `[Esc][Text color=green][/Esc]` y dentro de este el texto y cerramos  con **corchetes** `[Esc][/Text][/Esc]` obtenemos esto:

{Text color=green}
Este es un texto dentro de un Shortcode en el que puedo usar **Markdown**
{/Text }


También puedes usar **código de color**

[Code type='php'][Esc][Text color='#f00'] // con comillas simples
    Hola soy **Rojo**
[/Text][/Esc][/Code]


[Text color='#f00']
   Hola soy **Rojo**
[/Text]


Ahora vamos hacer un Shortcode para incrustar videos de Youtube.
En este caso **no necesitamos escribir dentro** así que es mas facil aun.

[Code type='php']<?php
Shortcode::add('Youtube', function ($atributos) {
    // extraemos los atributos (en este caso $src)
    extract($atributos);
    // el codigo del enlace
    $id = (isset($id)) ? $id : '';
    $clase = (isset($clase)) ? $clase : '';
    // comprobamos que exista el $id
    if($id){
        // el html
        $html = '<section class="'.$clase.'">';
        $html .= '<iframe src="//www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe>';
        $html .= '</section>';
        $html = preg_replace('/\s+/', ' ', $html);
        return $html;
    // si no se pone el atributo id que avise
    }else{
        return Barrio::error('Error [ id ] no encontrado');
    }
});
[/Code]

El código seria este:

[Code type='php'][Esc][Youtube id='GxEc46k46gg'][/Esc][/Code]

Y el resultado este 


[Youtube id='GxEc46k46gg']

[Divider]

**En caso de no poner el atributo id saldria esto:**

[Youtube]

[Divider]

Con los Shortcodes podemos crear desde **galerías**, **formularios** , **incrustar videos**, **Musica**, **Cambiar el Css** y todo un largo etcétera.

[Text color='var(--nc-lk-1)']
**Nota:** Si tienes instalado Barrio CMS en local puedes probar el editor para ver como funcionan los Shortcodes.
[/Text]

[Divider type='br']
