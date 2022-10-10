Title: Acciones
Description: Como funciona Barrio CMS.
Template: index
----

Las Acciones son funciones que podemos integrar en la plantilla para hacerla mas dináminca. Tenemos unas cuantas por defecto que son:

- **head:** usada para incluir los estilos.
- **theme_before:** comentarios tipo discus
- **theme_after:** resolución de formularios
- **footer:** Analytics y javascript

### Creando Extensiones

Vamos a crear una extensión que automáticamente genere un enlace al final de cada pagina usando una acción que ya esta en la plantilla que es  `<?php Barrio::runAction('theme_after); ?>`.

[Code type='php']<?php
// llamamos a la acción theme_after
Action::add('theme_after',function(){
    // y ahora que enseñe esto
    echo '<a href="'.Barrio::urlBase().'/articulos">Ver articulos.</a>';
});
[/Code]

Y ahora en todas las páginas al final se verá ese enlace, asi de facil.

Ahora vamos añadir algo más, le vamos a decir que si está en la sección artículos y  la página extensiones enseñe el texto y si no no enseñe nada.

[Code type='php']<?php
// llamamos a la acción theme_after
Action::add('theme_after',function(){
    // urlSegment sirve para señalar un segmento del enlace
    // si pones var_dump(Barrio::urlSegments()) veras todos los segmentos del enlace
    if(Barrio::urlSegment(0) == 'articulos' && Barrio::urlSegment(1) == 'extensiones'){
         // y ahora que enseñe esto
        echo '<a href="'.Barrio::urlBase().'/articulos">Ver articulos.</a>';
    }
});
[/Code]


Ahora haremos una acción que cambie el fondo solo en esta página, para ello usaremos  el  `Action::run('head')` que hay en el archivo _head.inc.html_.

[Code type='php']<?php
// llamamos a la accion head
Action::add('head',function(){
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
[/Code]