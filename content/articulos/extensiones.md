Title: Las extensiones
Description:  Cómo crear extensiones
Template: articulo

----


Las extensiones son una parte importante de **Barrio CMS** ya que como su nombre indica pueden extender el CMS a otro nivel.

La estructura de una extensión básica es simple:


1.  El nombre de la carpeta de la extensión ( por ejemplo  demo )
    -   El nombre de la extensión  debe llevar el mismo nombre que la carpeta  y .ext al final ( demo.ext.php );
    -  todo lo demás que lleve la extensión, librerías, css, javascript etc.


Si quieres por ejemplo desactivar  una extensión puedes agregar  o cambiar el nombre de la carpeta. Por ejemplo  la carpeta  **demo**  la renombramos a **_demo** y ya esta. Ten en cuenta que si usas alguna función en la plantilla que no sea un **Shortcode** o una **Acción**  te  dará error.


### Creando Extensiones


Vamos a crear una extensión que automáticamente genere un enlace al final de cada pagina usando una acción que ya esta en la plantilla que es  `<?php Barrio::actionRun('theme_after); ?>`.

{Code type='php'}<?php
// llamamos a la acción theme_after
Barrio::actionAdd('theme_after',function(){
    // y ahora que enseñe esto
    echo '<a href="'.Barrio::urlBase().'/articulos">Ver articulos.</a>';
});
{/Code}

Y ahora en todas las páginas al final se verá ese enlace, asi de facil.
Ahora vamos añadir algo más, le vamos a decir que si está en la sección artículos y  la página extensiones enseñe el texto y si no no enseñe nada.

{Code type='php'}<?php
// llamamos a la acción theme_after
Barrio::actionAdd('theme_after',function(){
    // urlSegment sirve para señalar un segmento del enlace
    // si pones var_dump(Barrio::urlSegments()) veras todos los segmentos del enlace
    if(Barrio::urlSegment(0) == 'articulos' && Barrio::urlSegment(1) == 'extensiones'){
         // y ahora que enseñe esto
        echo '<a href="'.Barrio::urlBase().'/articulos">Ver articulos.</a>';
    }
});
{/Code}


Ahora haremos una acción que cambie el fondo solo en esta página, para ello usaremos  el  Barrio::actionRun('head')` que hay en el archivo _head.inc.html_ .

{Code type='php'}<?php
// llamamos a la accion head
Barrio::actionAdd('head',function(){
     // urlSegment sirve para señalar un segmento del enlace
    if(Barrio::urlSegment(0) == 'articulos' && Barrio::urlSegment(1) == 'extensiones'){
         // y ahora incrustamos esto
        echo '<style rel="stylesheet">
                body{
                    background:blue;
                    color:white;
                }
                pre,code{
                    background: #0000bb;
                    border-color: #00008e;
                    box-shadow: 0px 3px 6px -2px #02026f;
                    color: white;
                }
        </style>';
    }
});
{/Code}