<?php


/**
 * ================================
 * Actions
 * ================================
 */


/**
 * Buscador de archivos
 */
Barrio::actionAdd('theme_before', function () {
    // en la barra de busqueda seria algo asi
    // http://localhost/cmsbarrio/?buscar=
    if (isset($_POST['buscar'])) {
        // el nombre a buscar
        // http://localhost/cmsbarrio/?buscar=Hola
        // $query = hola
        $query = $_POST['buscar'];
        // comprobamos que hay algo para buscar
        if ($query) {
            // obtenemos todas las paginas que hay en la carpeta content
            // si quisiéramos buscar solo en artículos usamos /articulos
            $data = Barrio::pages('/', 'date', 'DESC', ['404'], '');
            // cogemos las 5 primeras letras
            $name = urlencode(substr(trim($query), 0, 5));
            // iniciamos el array y el total
            $results = array();
            $total = 0;
            // hacemos un loop y buscamos en los resultados
            foreach ($data as $item) {
                // remplazamos la direccion local por la url del dominio
                $root = str_replace(Barrio::urlBase(), CONTENT, $item['url']);
                // decodificamos la url
                $name = urldecode($name);
                // comprobamos que exista con preg_match
                // title, description y slug
                if (preg_match("/$name/i", $item['title']) || preg_match("/$name/i", $item['description']) || preg_match("/$name/i", $item['slug'])) {
                    // si hay éxito lo ponemos en el array
                    $results[]= array(
                        'title' => (string) $item['title'],
                        'description' => (string) $item['description'],
                        'published' => ($item['published'] === 'false') ? false : true,
                        'url' => (string) $item['url']
                    );
                    $total++;
                }
            }
            // iniciamos el resultado
            $html = '<p class="text-primary">Resultados de la Búsqueda <span class="text-danger ml-2">'.$total.'</span></p>';
            // creamos un loop con los resultados
            foreach ($results as $page) {

                if ($page['published']) {
                    $html .= '<div class="card p-3 mb-2">';
                    $html .= '  <h3>'.$page['title'].'</h3>';
                    $html .= '  <p>'.$page['description'].'</p>';
                    // creamos un boton para ir a la pagina con $page['url']
                    $html .= '  <a class="btn btn-link" href="'.$page['url'].'">Leer</a>';
                    $html .= '</div>';
                }
            }
            // si hay resultados los enseñamos
            if ($results) {
                echo $html;
                // si no ponemos que no hay resultados
            } else {
                $html .= '<div class="card p-3 mb-2">';
                $html .= '  <h3>No hay resultados de '.$query.'</h3>';
                $html .= '</div>';
                echo $html;
            }
        }
    }
});

/**
 * Youtube
 */
Barrio::actionAdd('Youtube', function ($src = '') {
    // el codigo del enlace
    $src = (isset($src)) ? $src : '';
    // comprobamos que exista el $src
    if ($src) {
        // enseñamos el html
        // usamos la clase iframe para hacerlo responsive
        // echale un ojo a  themes/default/assets/css/main.css
        $html  = '<section class="iframe">';
        $html .= '<iframe src="//www.youtube.com/embed/'.$src.'" frameborder="0" allowfullscreen></iframe>';
        $html .= '</section>';
        // ahora se llama con echo o print
        echo $html;
        // si no se pone el atributo src que avise
    } else {
        // ahora se llama con echo o print
        echo 'Este shortcode le falta el atributo src';
    }
});


/**
 * Discus
 */
Barrio::actionAdd('Discus', function ($name='', $url= '') {

    Barrio::actionAdd('head', function () {
        echo '<script id="dsq-count-scr" src="//barrio-cms.disqus.com/count.js" async></script>';
    });

    $html = '<div id="disqus_thread"></div>';
    $html .= '<script id="dsq-count-scr" src="//barrio-cms.disqus.com/count.js" async></script>';
    $html .='<script>
    var disqus_config = function () {
        this.page.url = "'.$url.'";
        this.page.identifier = "'.sha1($url).'";
    };
    (function() {
    var d = document, s = d.createElement("script");
    s.src = "https://'.$name.'.disqus.com/embed.js";
    s.setAttribute("data-timestamp", +new Date());
    (d.head || d.body).appendChild(s);
    })();</script>';

    echo $html;
});


/* - Barrio::actionRun('Pagination',['blog',6]);
--------------------------------------------------------------------------------*/
Barrio::actionAdd('Pagination', function ($name, $num = 3) {
    $lang = (Barrio::urlSegment(0)) ? Barrio::urlSegment(0) : Barrio::$config['lang'];
    // All pages
    $posts = Barrio::pages($lang.'/'.$name, 'date', 'DESC', ['index','404']);
    // Limit of pages
    $limit = $num;
    //intialize a new array of files that we want to show
    $blogPosts = array();
    //add a file to the $goodfiles array if its name doesn't begin with a period
    foreach ($posts as $f) {
        // Insert one or more elements in array
        array_push($blogPosts, $f);
    }
    // Divide an array into fragments
    $articulos = array_chunk($blogPosts, $limit);
    // Get page
    $pgkey = isset($_GET['page']) ? $_GET['page'] : 0;

    $items = $articulos[$pgkey];

    $html = '<section class="posts">';
    foreach ($items as $articulo) {

        $date =  date('d/m/Y', $articulo['date']);

        $html .= '<article class="post">';

        if ($articulo['image']) {
            $html .= '<div class="post-image"><img src="'.$articulo['image'].'" /></div>';
        }
        // header
        $html .= '<hgroup class="post-header">';
        $html .= '  <h3 class="post-title"> <a href="'.$articulo['url'].'">'.$articulo['title'].'</a></h3>';
        $html .= '  <p class="post-description">';
        $html .= '     <b>'.$date.' </b>  - '.$articulo['description'];
        $html .= '  </p>';
        $html .= '</hgroup>';

        // body
        $html .= '<section class="post-body">';
        $html .= '  <div class="text-secondary">'.$articulo['content_short'].'</div>';
        $html .= '</section>';

        $html .= '</article>';
    }
    $html .= '</section>';
    echo $html;

    // total = post / limit - 1
    $total = ceil(count($posts)/$limit);
    // If empty active first
    $p = 0;
    if (empty($_GET['page'])) {
        $p = 0;
    } else {
        $p = isset($_GET['page']) ? $_GET['page'] : 0;
    }

    if(count($posts) > $num){

        // pagination
        $pagination = '<ul class="pagination">';
        // first
        $class = ($p == 0) ? "disabled" : "";
        $pagination .= '<li class="page-item '.$class.'"><a class="page-link" href="?page='.($p - 1).'">&laquo;</a></li>';
        if ($p > 0) {
            $pagination .= '<li class="page-item"><a class="page-link" href="?page=0">Primera</a></li>';
            $pagination .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }

        // loop numbers
        $s = max(1, $p - 5);
        for (; $s < min($p+ 6, ($total - 1)); $s++) {
            if ($s==$p) {
                $class = ($p == $s) ? "active" : "";
                $pagination .= '<li class="hide-mobile page-item '.$class.'"><a class="page-link" href="?page='.$s.'">'.$s.'</a></li>';
            } else {
                $class = ($p == $s) ? "active" : "";
                $pagination .= '<li class="hide-mobile page-item '.$class.'"><a class="page-link" href="?page='.$s.'">'.$s.'</a></li>';
            }
        }

        // last
        if ($p < ($total - 1)) {
            $pagination .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
            $pagination .= '<li class="page-item"><a class="page-link" href="?page='.($total - 1).'">Ultima</a></li>';
        }
        // arrow right
        $class = ($p == ($total - 1)) ? "disabled" : "";
        $pagination .= '<li class="page-item '.$class.'"><a class="page-link" href="?page=' . ($p + 1) . '">&raquo;</a></li>';
        $pagination .= '</ul>';
        echo $pagination;
    }

});

Barrio::actionAdd('lastPosts', function ($num = 4,$name = '') {
    $lang = (Barrio::urlSegment(0)) ? Barrio::urlSegment(0) : Barrio::$config['lang'];
    $name = ($name) ? $name : 'blog';
    $articulos = Barrio::pages($lang.'/'.$name, 'date', 'DESC', ['index','404'], $num);
    $html = '<div class="lastPosts">';
    foreach ($articulos as $articulo) {
        $date =  date('d/m/Y', $articulo['date']);
        $html .= '<div class="lastPost">';
        $html .= ' <p> <a href="'.$articulo['url'].'">'.$articulo['title'].'</a> - <span class="date">'.$date.' </span></p>';
        $html .= '</div>';
    }
    $html .= '</div>';
    echo $html;
});

Barrio::actionAdd('Contact', function ($mail = '') {
    $error = '';
    if (isset($_POST['Submit'])) {
        // vars
        $recepient = $mail;
        $sitename = Barrio::urlBase();
        $service = trim($_POST["subject"]);
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $text = trim($_POST["message"]);

        $message = "Service: $service \n\nName: $name \nMessage: $text";

        $pagetitle = "Nuevo mensaje desde \"$sitename\"";
        // send mail
        if (mail(
        $recepient,
        $pagetitle,
        $message,
        "Content-type: text/plain; charset=\"utf-8\" \nFrom: $name <$email>"
      )) {
            // success
            $error = '<p><strong>Gracias tu mensaje ha sido enviado ....</strong></p>';
        } else {
            // error
            $error = '<p style="color:red;"><strong>Lo siento hubo un problema al enviarlo por favor intentelo otra vez..</strong></p>';
        };
    }
    // show error
    echo $error;
    $html = '<div class="row">';
    $html .= '<div class=" col-md-6">';
    $html .= '  <form class="form" action="" method="post"  name="form1">';
    $html .= '      <div class="form-group">';
    $html .= '        <label>Nombre</label>';
    $html .= '        <input type="text" name="name" class="form-control" required>';
    $html .= '      </div>';
    $html .= '      <div class="form-group">';
    $html .= '        <label>Email</label>';
    $html .= '        <input type="email" name="email" class="form-control" required>';
    $html .= '      </div>';
    $html .= '      <div class="form-group">';
    $html .= '        <label>Asunto</label>';
    $html .= '        <input type="text" name="subject" class="form-control" required>';
    $html .= '      </div>';
    $html .= '      <div class="form-group">';
    $html .= '        <label>Mensaje</label>';
    $html .= '        <textarea  name="message" class="form-control" rows="5" required></textarea>';
    $html .= '      </div>';
    $html .= '      <input type="submit" name="Submit" class="btn btn-default" value="Enviar Formulario">';
    $html .= '  </form>';
    $html .= '</div>';
    echo $html;
});
