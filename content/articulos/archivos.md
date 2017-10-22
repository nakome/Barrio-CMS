Title: Archivos .md
Description: Como crear archivos o paginas.
Keywords:
Published: 1
Author: Moncho Varela
Date: 19/10/2017
Image:
Robots: index,follow
Template: articulo
----

Esta es la **estructura** básica de un archivo:

{Code type='markdown'}Title = El título de la página
Description = Descripción de la página
Template = plantilla html que usará (index,articulo etc...) sin .html la extensión

---


Aqui ira el contenido de la página
{/Code}

Esta es la **estructura** completa de un archivo:

{Code type='markdown'}Title = El titulo de la página
Description = Descripción de la página
Tags = Etiquetas de la página
Author = Author de la página
Image = Imagen de la página
Date = Fecha en formato d/m/Y
Robots, = Si quieres que indexe o no en google por defecto index,follow
Keywords = keywords de la página
Template = plantilla html que usara (index,articulo etc...)
Category = categoría

---


Aqui ira el contenido de la página
{/Code}




Por defecto podemos usar varios tipos de **Shortcodes** que son:

**Nota:** Los tengo que poner con el corchete separado pero tienen que ir sin separación._

{Code type='markdown'}{ url} = Es la dirección de nuestra web{/Code}

Por ejemplo { url}/nosotros se convierte en:

{url}/nosotros

Luego hay otros como son:

{Code type='markdown'}{ more} que recorta el articulo como si fuera un read more. Podemos usarlo en el loop de articulos.html usando $articulo['content']

{ email} enseña el email que tenemo en config.php
{/Code}

El Shortcode **{ php}**

Podemos usarla para añadir **Php** simple en nuestros archivos como por ejemplo:

{Code type='markdown'}{ php} echo 'Hola Mundo'; { /php}{/Code}

El resultado sería:


{php} echo 'Hola Mundo'; {/php}



En nuestro archivo también podemos usar html,css o javascript.





