
![Barrio CMS](./themes/default/screenshot.jpeg)


### Requisitos

**PHP 5.3** minimo con **PHP's Multibyte String module**

**Apache** con **Mod Rewrite**


### Instalación

**Muy facil** solo tienen que copiar la carpeta del **CMS** en su Hosting y cambiar algunos parametros en el archivo ```config.php``` y en el ```.htaccess```


**Archivo config.php**


    <?php

    // en md {Config name='facebook'}
    // en html echo Barrio::$config['facebook'];
    return array(
        'lang' => 'es',
        // charset
        'charset' => 'UTF-8',
        // timezone
        'timezone' => 'Europe/Brussels',
        // plantilla por defecto
        'theme' => 'default',
        // titulo de la web
        'title' => 'Barrio CMS',
        // descripcion de la web
        'description' => 'Sistema de control de contenidos en formato Flat File',
        // palabras clave
        'keywords' => 'cms,barrio,flatfile',
        // autor
        'author' => 'Moncho Varela',
        // correo
        'email' => 'demo@gmail.com',
        // imagen por defecto
        'image' => 'content/imagenes/sin-imagen.svg',
        // blog
        'blog' => array(
            // blog image
            'image' => 'content/imagenes/sin-imagen.svg',
            // Blog titulo
            'title' => 'Chuck Gomez',
             // Blog descripcción
            'description' => 'Desarrollador y Diseñador Web. Aprendiendo y mejorando cada día.',
            // Buscador titulo
            'search_title' => 'Buscar Pagina',
            // Buscador boton
            'search_btn' => 'Buscar',
            // Articulos recientes
            'recent_posts' => 'Articulos recientes'
        ),
        // navegacion
        'menu' => array(
            '/' => 'Inicio',
            '/acerca-de' => 'Acerca De',
            '/blog' => 'Blog',
            '/contacto' => 'Contacto'
        ),
        // buscador
        'search' =>  array(
            'results_of' => 'Resultados de la busqueda',
            'no_results' => 'No hay resultados',
            'read'       => 'Ir a enlace'
        ),
        // copyright
        'copyright' => 'Creado con Barrio CMS',

        // social
        'facebook' => 'https://facebook.com',
        'instagram' => 'https://instagram.com',
        'twitter' => 'https://twitter.com',
        'youtube' => 'https://youtube.com'

        // añadir mas si se quiere aqui...
    );




**Archivo .htaccess**

Si esta dentro de una carpeta poner el nombre de ella

**Por ejemplo:**

    # PHP 5, Apache 1 and 2.
    <IfModule mod_php5.c>
      php_flag magic_quotes_gpc                 off
      php_flag magic_quotes_sybase              off
      php_flag register_globals                 off
    </IfModule>

    <IfModule mod_rewrite.c>
        RewriteEngine On
        # Si esta en un directorio añadirlo
        RewriteBase /misitio
        Options +FollowSymlinks
        RewriteRule ^content/(.*)\.(txt|md|yml|json)$ index.php [L]
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule ^(.*)$ index.php?$1 [L,QSA]
    </IfModule>


    <IfModule mod_autoindex.c>
        Options -Indexes
    </IfModule>



### Variables Plantilla


    {date} = fecha d-m-Y

    {Year} = Año
 
    {Site_url} = Url base

    {Site_current}  = hash
    
    {* comment *} = Comentario

    {Last_posts}  = Ultimos articulos

    {Blog_posts} = Articulos

    {Pages: demo} = Paginación de otra carpeta

    // If else
    {If: $Segment == '/'}
        Estas en el inicio
    {Elseif: $Segment == '/blog'}
        Estas en el blog
    {Else}
        Estas en otro lado
    {/If}

    // comprueba el hash de ese momento
    {Segment:  '/'}
        Estas en el inicio
    {/Segment}
    
    // loop
    {Loop: $confit.blog as $item}
        {$item.title}
    {/Loop}

    // loop key => value
    {Loop: $confit.blog as $k=>$v}
        {$k} = {$v}
    {/Loop}

    // icual que echo 'hola'
    {?= 'hola' ?}

    // codifica en Base uri
    {$page.slug|encode}

    // decodifica en Base uri
    {$page.slug|decode}

    // capitaliza
    {$page.slug|capitalize}

    // codifica en md5
    {$page.slug|md5}

    / codifica en sha1
    {$page.slug|sha1}

    // htmlspecialchars
    {$page.content|e}

    // html_entity_decode
    {$page.content|parse}

    // llamar una acción
    {Action: navigation}

    // include once
    {Include: themes/default/inc/header.inc.html}

    // include once en la carpeta de la plantilla actual
    {Template: inc/header.inc.html}
    
    // carpeta assets
    {Assets: img/logo.svg}