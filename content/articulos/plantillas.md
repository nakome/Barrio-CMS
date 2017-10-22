Title: Crear Temas
Description:  Cómo crear tus propios temas.
Template: articulo

----


La estructura de los temas se compone de:

1. nombre de la carpeta que contiene el tema.
    - archivo **func.php** ( si no esta nos daría error ).
    - carpeta **assets** donde meteremos todos los scripts y estilos.
    - carpeta **inc** , aquí se encuentran los **includes** ( head.html, footer.html )
    - archivo **index.html**, que se puede usar para paginas estáticas.
    - archivo **articulos.html**, es el encargado de buscar en la carpeta artículos todos los archivos que haya.
    - archivo **articulo.html** , es el que enseña el articulo.
    - archivo **404.html** , es el que enseña en caso de error.

{Alert type=info}
**Nota:** _siempre puedes cambiar todo esto y ponerlo como tu quieras es solo para comenzar_.
{/Alert}


### Crear plantilla

Vamos a crear una plantilla a la que llamaremos **home.html**:

{Code type='php'}<?php include 'inc/head.inc.html' ?>
<?php include 'inc/header.inc.html' ?>
<main>
    <?php Barrio::actionRun('theme_before); ?>
    <?php echo $page['content']; ?>
    <?php Barrio::actionRun('theme_after); ?>
</main>
<?php include 'inc/footer.inc.html' ?>
{/Code}

En primer lugar incluimos **head.inc.html** que es donde se encuentra los **metatags** y **estilos**.

Luego incluimos **header.inc.html** que es donde se encuentra la navegación y el titulo de la pagina.

Las acciones  `Barrio::actionRun('theme_after')` y `Barrio::actionRun('theme_after'')` se ponen por que a la hora de crear una extensión puedes hacer que se cargen ahi.

Ahora añadimos `<?php echo $page['content']; ?>` que es el encargado de enseñar el contenido del archivo, si por ejemplo queremos enseñar el titulo usamos `<?php echo $page['title']; ?>` o si queremos poner la descripción usamos `<?php echo $page['description']; ?>`, de todos modos puedes usar `var_dump($page)` para ver todo lo que puedes usar.

Ahora solo quedaría incluir **footer.inc.html** que es donde su nombre indica el pie de la página con los scripts y el cierre del body.


También podemos crear una plantilla sin incluir el **head** o el **footer** pero asi es mas ordenado.

**Nota:** _Estas son todas las variables que acepta `$page` si están incluidas en el archivo.


{Code type='markdown'}Title = El titulo de la página
Description = Descripción de la página
Tags = Etiquetas de la página
Author = Author de la página
Image = Imagen de la página
Date = Fecha
Robots, = Si quieres que indexe o no google
Keywords = keywords de la página
Template = plantilla html que usara (index.html,articulo.html etc...)
Url = Un link para enseñar o enlazar.
Category = categoría
Published = publicado o no.
{/Code}

Las etiquetas **title**, **description**, **keywords** y **author** si no se escriben se usarán las de el archivo **config.php**.


He incluido algunas más de las que se utilizan por si tienes conocimientos mas avanzados de **Php** poder crear otras funciones como filtros por categoría, buscador, si quieres que se vea o no etc.


Por ejemplo si quieres que en los **artículos** o **blog** ( puedes crear las carpetas que quieras dentro de la carpeta content ) quieres que salga una imagen para cada articulo en el **loop** podrias usar algo así:


{Code type='php'}// si no esta vacía usaremos la imagen
if($articulo['image'] != ''){
    $html .= '<img src="'.$articulo['image'].'" alt="'.$articulo['title'].'" />';
// si no podemos usar la que hay por defecto
}else{
    $html .= '<img src="'.Barrio::$config['image'].'" alt="'.$articulo['title'].'" />';
}
{/Code}

La incluiríamos en **artículos.html** así:

{Code type='php'}<?php include 'inc/head.inc.html' ?>
<?php include 'inc/header.inc.html' ?>
<main>
    <?php Barrio::actionRun('theme_before); ?>
    <?php
        // obtenemos todos los archivos de la carpeta artículos
        // ordenamos por título y descendente
        // si hay alguno con el nombre 404 no lo enseñamos
        $articulos = Barrio::pages('articulos','title','ASC',['index','404']);
        // iniciamos la variable fuera del loop
        $html = '';
        // loop de los artículos
        foreach($articulos as $articulo)
        {

            // si no esta vacía usaremos la imagen
            if($articulo['image'] != ''){
                $html .= '<img src="'.$articulo['image'].'" alt="'.$articulo['title'].'" />';
            // si no podemos usar la que hay por defecto
            }else{
                $html .= '<img src="'.Barrio::$config['image'].'" alt="'.$articulo['title'].'" />';
            }

            // usamos title y description del array devuelto
            // descomenta var_dump para ver el array devuelto
            // var_dump($articulo);
            $html .= '<h3><a href="'.$articulo['url'].'">'.$articulo['title'].'</a></h3>';
            // se puede usar tambien content_short si usamos {cut}
            $html .= '<p>'.$articulo['description'].'</p>';
        }
        // lo imprimimos
        echo $html;
     ?>
     <?php Barrio::actionRun('theme_after); ?>
</main>
<?php include 'inc/footer.inc.html' ?>
{/Code}




