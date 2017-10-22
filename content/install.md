Title: Instalación
Description: Como instalar Barrio CMS
Template: index
----


### Requisitos

**PHP 5.3** minimo con **PHP's Multibyte String module**

**Apache** con **Mod Rewrite**


### Instalación

**Muy facil** solo tienen que copiar la carpeta del **CMS** en su Hosting y cambiar algunos parametros en el archivo ```config.php``` y en el ```.htaccess```


**Archivo config.php**

{Code type='php'}<?php
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
        // descripcion del blog
        'blog_description' => 'Articulos, ideas y todo lo que se me ocurra se ira poniendo aquí.Espero que lo disfruteis.'
    );
?>
{/Code}

**Archivo .htaccess**

Si esta dentro de una carpeta poner el nombre de ella

**Por ejemplo:**

{Code type='php'}# PHP 5, Apache 1 and 2.
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
{/Code}

Ya podemos iniciar el CMS, ahora a [crear nuestra web ]({url}/articulos?page=0)





