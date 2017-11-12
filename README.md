
![Barrio CMS](./content/imagenes/barrio.svg)


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
                'es' => array(
                    // titulo del blog
                    'title' => 'Ideas & Pensamientos.',
                     // descripcion del blog
                    'description' => 'Articulos, ideas y todo lo que se me ocurra se ira poniendo aquí.Espero que lo disfruteis.',
                    // titulo buscar
                    'search_title' => 'Buscar pagina',
                    // botton buscar
                    'search_btn' => 'Buscar',
                    // titulo articulos recientes
                    'recent_posts' => 'Articulos recientes'
                ),
                'en' => array(
                    // Blog title
                    'title' => 'Ideas & Thoughts.',
                     // Blog description
                    'description' => 'Articles, ideas and everything that comes to mind will be put here. I hope you enjoy it.',
                    // Search title
                    'search_title' => 'Search Page',
                    // Search botton
                    'search_btn' => 'Search',
                    // Recent posts
                    'recent_posts' => 'Recent posts'
                )
            ),
            // navegacion
            'menu' => array(
                'es' => array(
                    'es' => 'Inicio',
                    'es/acerca-de' => 'Acerca De',
                    'es/blog' => 'Blog',
                    'es/contacto' => 'Contacto',
                    /**
                     // en el tema por defecto puedes la multinavegacion
                     'otros' => array(
                        'es/portafolio' => 'Portafolio',
                        'es/servicios' => 'Servicios',
                    ),
                    */
                ),
                'en' => array(
                    'en' => 'Home',
                    'en/about-us' => 'About Us',
                    'en/blog' => 'Blog',
                    'en/contact' => 'Contact'
                )
            ),
            'facebook' => 'https://facebook.com',
            'instagram' => 'https://instagram.com',
            'twitter' => 'https://twitter.com',
            'youtube' => 'https://youtube.com'
            // añadir mas si se quiere
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



