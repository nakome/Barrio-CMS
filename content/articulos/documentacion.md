Title: Documentacíon
Description: Funciones de Barrio CMS
Template: articulo

----


### Constantes


|       Constante    |   Descripción   |
|         ---        |      ---        |
| ROOT | Define el directorio raiz de la web |
| CONTENT | Define el directorio raiz de el contenido de los archivos md |
| THEMES | Define el directorio raiz de las plantillas |
| EXTENSIONS | Define el directorio raiz de las extensiones |


---

### Estructura de paginas



|       Localización  Fisica    |   Url |
|               ---             |   --- |
|  content/index.md             | /     |
|  content/otra.md              | /otra |
|  content/proyectos/otra.md    | /proyectos/otra |
|  content/una/direccion/muy/larga/pagina.md    | /una/direccion/muy/larga/pagina |

---

### Variables del archivo .md

Por defecto existen unas variables en los archivos de texto, estas son:

{Code type='markdown'}// quitar espacio al principio de `{` para que funcione.
{ url} = la direccíon de la pagina
{ email} = Email por defecto de config.php
{ more} = funcíon para acortar los archivos de texto
{ php} echo 'hola mundo'; {/php}
{/Code}


{Alert type='info' clase='mt-5'}
Puedes ver mas en [Como se hace]({url}/articulos/archivos)
{/Alert}

---

### Funciones Php


**Acciones:**

{Code type='php'}// Crear una Accion
Barrio::actionAdd('demo',function($nombre = ''){
    echo $nombre
});

// llamar a la Accion
Barrio::actionRun('demo',['nombre']);
{/Code}


**Shortcodes:**

{Code type='php'}// Crear una Shortcode
Barrio::actionAdd('Escribe',function($atributos){
    // extrae atributos
    extract($atributos);
    // valores por defecto
    $nombre = (isset($nombte)) ? $nombre = $nombre : 'Nombre por defecto';
    // retorna el nombre
    return $nombre
});

// llamar a el Shortcode
// quitar espacio al principio de `{` para que funcione.
{ Escribe nombre=Barrio CMS} o { Escribe nombre='Barrio CMS'}

{/Code}


{Alert type='info' clase='mt-5'}
Puedes ver ejemplos en [Como se hace]({url}/articulos/shortcodes)
{/Alert}

**Otras funciones:**


|       Funcion    |   Descripción   |
|         ---      |      ---        |
| `Barrio::urlBase()`     |  Obtiene la dirección raíz   |
| `Barrio::urlCurrent()`  |  Obtiene la dirección en la que se encuentra en ese momento   |
| `Barrio::urlSegments()` |  Divide el hash en un array   |
| `Barrio::urlSegment(0)` |  Obtiene el primer hash       |
| `Barrio::shortArray($array,$clave,$orden)`  |  Ordena un array de elementos |
| `Barrio::scanFiles($carpeta,$tipo,$ruta)`   |  Busca archivos en una carpeta |
| `Barrio::pages($carpeta,$ord,$ord_por,$ignor,$limit)` | Busca las paginas en una carpeta |
| `Barrio::page('blog')` |  Obtiene el array de la pagina |


{Alert type='info' clase='mt-5'}

**Nota:** Puedes crear mas funciones en el archivo `func.php` de la plantilla.

{/Alert}
