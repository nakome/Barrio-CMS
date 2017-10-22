Title: Barra de busqueda
Description:  Crear un formulario de busqueda de archivos.
Template: articulo

----


Vamos a crear un buscador, para ello necesitamos un formulario y una acción.


Primero creamos la acción con **Barrio::actionAdd();**  y usaremos **Barrio::actionRun('theme_before')** que ya tenemos en la plantilla para que salgan los resultados, tambien podriamos usar otra función pero que sea mas fácil haremos asi.


### Iniciamos la acción

{Code type='php'}Barrio::actionAdd('theme_before',function(){
    // codigo...
});
{/Code}

Añadimos $_GET

{Code type='php'}Barrio::actionAdd('theme_before',function(){
    // en la barra de busqueda seria algo asi
    // http://localhost/cmsbarrio/?buscar=
    if(isset($_GET['buscar'])){
        // el nombre a buscar
        // http://localhost/cmsbarrio/?buscar=Hola
        // $query = hola
        $query = $_GET['buscar'];

        // continuamos ....
    }
});
{/Code}

Comprobamos que el nombre a buscar no este vacio

{Code type='php'}Barrio::actionAdd('theme_before',function(){
    // en la barra de busqueda seria algo asi
    // http://localhost/cmsbarrio/?buscar=
    if(isset($_GET['buscar'])){
        // el nombre a buscar
        // http://localhost/cmsbarrio/?buscar=Hola
        // $query = hola
        $query = $_GET['buscar'];



        // comprobamos que hay algo para buscar
        if($query){
            // obtenemos todas las paginas que hay en la carpeta content
            // si quisiéramos buscar solo en artículos usamos /articulos
            $data = Barrio::pages('/','date','DESC',['404'],'');
            // cogemos las 5 primeras letras
            $name = urlencode(substr(trim($query), 0, 5));
            // iniciamos el array y el total
            $results = array();
            $total = 0;



            // continuamos ....

        }
    }
});
{/Code}


Creamos un loop que busque en todos los archivos el titulo la descripción o el slug

{Code type='php'}Barrio::actionAdd('theme_before',function(){
    // en la barra de busqueda seria algo asi
    // http://localhost/cmsbarrio/?buscar=
    if(isset($_GET['buscar'])){
        // el nombre a buscar
        // http://localhost/cmsbarrio/?buscar=Hola
        // $query = hola
        $query = $_GET['buscar'];



        // comprobamos que hay algo para buscar
        if($query){
            // obtenemos todas las paginas que hay en la carpeta content
            // si quisiéramos buscar solo en artículos usamos /articulos
            $data = Barrio::pages('/','date','DESC',['404'],'');
            // cogemos las 5 primeras letras
            $name = urlencode(substr(trim($query), 0, 5));
            // iniciamos el array y el total
            $results = array();
            $total = 0;


            // hacemos un loop y buscamos en los resultados
            foreach ($data as $item){
                // remplazamos la direccion local por la url del dominio
                $root = str_replace(Barrio::urlBase(), CONTENT,$item['url']);
                // decodificamos la url
                $name = urldecode($name);
                // comprobamos que exista con preg_match
                // title, description y slug
                if(preg_match("/$name/i",$item['title']) ||
                preg_match("/$name/i",$item['description']) ||
                preg_match("/$name/i",$item['slug'])){
                    // si hay éxito lo ponemos en el array
                    $results[]= array(
                      'title' => (string) $item['title'],
                      'description' => (string) $item['description'],
                      'url' => (string) $item['url']
                    );
                    // contamos los resultados
                    $total++;
                }
            }


            // continuamos ....
        }
    }
});
{/Code}


Lanzamos los resultados en html.

{Code type='php'}Barrio::actionAdd('theme_before',function(){
    // en la barra de busqueda seria algo asi
    // http://localhost/cmsbarrio/?buscar=
    if(isset($_GET['buscar'])){
        // el nombre a buscar
        // http://localhost/cmsbarrio/?buscar=Hola
        // $query = hola
        $query = $_GET['buscar'];



        // comprobamos que hay algo para buscar
        if($query){
            // obtenemos todas las paginas que hay en la carpeta content
            // si quisiéramos buscar solo en artículos usamos /articulos
            $data = Barrio::pages('/','date','DESC',['404'],'');
            // cogemos las 5 primeras letras
            $name = urlencode(substr(trim($query), 0, 5));
            // iniciamos el array y el total
            $results = array();
            $total = 0;


            // hacemos un loop y buscamos en los resultados
            foreach ($data as $item){
                // remplazamos la direccion local por la url del dominio
                $root = str_replace(Barrio::urlBase(), CONTENT,$item['url']);
                // decodificamos la url
                $name = urldecode($name);
                // comprobamos que exista con preg_match
                // title, description y slug
                if(preg_match("/$name/i",$item['title']) ||
                preg_match("/$name/i",$item['description']) ||
                preg_match("/$name/i",$item['slug'])){
                    // si hay éxito lo ponemos en el array
                    $results[]= array(
                      'title' => (string) $item['title'],
                      'description' => (string) $item['description'],
                      'url' => (string) $item['url']
                    );
                    // contamos los resultados
                    $total++;
                }
            }
            // iniciamos el resultado
            $html = '<p class="text-primary">Resultados de la Búsqueda <span class="badge badge-secondary">'.$total.'</span></p>';
            // creamos un loop con los resultados
            foreach($results as $page){
                $html .= '<div class="p-3 mb-2 bg-dark text-white">';
                $html .= '  <h3>'.$page['title'].'</h3>';
                $html .= '  <p>'.$page['description'].'</p>';
                // creamos un boton para ir a la pagina con $page['url']
                $html .= '  <a class="btn btn-default" href="'.$page['url'].'">Leer</a>';
                $html .= '</div>';
            }

            // si hay resultados los enseñamos
            if($results){
                echo $html;
            // si no ponemos que no hay resultados
            }else{
                $html .= '<div class="p-3 mb-2 bg-dark text-white">';
                $html .= '  <h3>No hay resultados de '.$query.'</h3>';
                $html .= '</div>';
                echo $html;
            }
        }
    }
});
{/Code}

### Creamos el formulario

El formulario lo haremos solo con un input search y con javascript, algo así:

{Code type='html'}<form id="buscar">
    <input type="search" id="texto" placeholder="Buscar pagina">
</form>
{/Code}

Ahora añadimos un poco de Javascript:

{Code type='html'}<form id="buscar">
    <input type="search" id="texto" placeholder="Buscar pagina">
</form>
<script type="text/javascript">
    // buscamos el id buscar
    var form = document.querySelector('#buscar');
    // al darle a enter llamamos a la función submit
    form.addEventListener('submit', function(e) {
        // esto es para no refrescar la página
        e.preventDefault();
        // obtenemos el texto del input
        var query = document.querySelector('#texto').value;
        // redirigimos al inicio y que enseñe los resultados
        // al poner ?buscar php lo entendera como $_GET
        window.location.href = site_url+'?buscar=' + query;
        // esto es para no refrescar la página
        // igual que preventdefault
        return false;
    });
</script>
{/Code}


{Alert type=info}
Y ya esta ahora solo tenemos que escribir lo que queramos buscar y veremos los resultados ( si los hay ).
{/Alert}