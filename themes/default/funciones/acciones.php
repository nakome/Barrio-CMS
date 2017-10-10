<?php

/* - Barrio::actionRun('Pagination',['blog',6]);
--------------------------------------------------------------------------------*/
Barrio::actionAdd('Pagination', function($name,$num = 3) {
  // All pages
    $posts = Barrio::pages($name, 'date', 'DESC', ['index','404']);
    // Limit of pages
    $limit = $num;
    //intialize a new array of files that we want to show
    $blogPosts = array();
    //add a file to the $goodfiles array if its name doesn't begin with a period
    foreach($posts as $f){
        // Insert one or more elements in array
        array_push($blogPosts,$f);
    }
    // Divide an array into fragments
    $articulos = array_chunk($blogPosts, $limit);
    // Get page
    $pgkey = isset($_GET['page']) ? $_GET['page'] : 0;

    $items = $articulos[$pgkey];

    $html = '';
    foreach($items as $articulo){
        //$date = date('d/m/Y',$articulo['date']);
        $html .= '<article class="post">';
        $html .= '<hgroup class="post-header">';
        $html .= '  <h3 class="post-title"> '.$articulo['title'].'</h3>';
        $html .= '  <h4 class="post-date"> '.date('d-m-Y',$articulo['date']).'</h4>';
        $html .= '</hgroup>';
        $html .= '<section class="post-body">';
        if($articulo['image']) $html .= '<img src="'.$articulo['image'].'" />';
        $html .= '  <p class="text-secondary">'.$articulo['description'].'</p>';
        $html .= ' <p class="text-right"><a class="btn btn-outline-dark" href="'.$articulo['url'].'">Leer mas...</a></p>';
        $html .= '</section>';
        $html .= '</article>';
    }

    echo $html;

    // If empty active first
    $page = 0;
    if( empty($_GET['page']) ) $page = 1;
    else $page = isset($_GET['page']) ? $_GET['page'] : 0;

    $total = count($articulos);

    // Get page
    $p = isset($_GET['page']) ? $_GET['page'] : '';
    $pagination  =  $p > 0 ? '<a class="btn btn-link pagination" href="?page='.($p -1).'">Mas nuevos --&gt;</a>':'';
    $pagination .= ($p+1) < $total ? '<a class="btn btn-link pagination" href="?page='.($p+1).'">&lt-- Mas viejos</a>':'';
    echo $pagination;
});

Barrio::actionAdd('lastPosts',function($num = 4){
    $articulos = Barrio::pages('articulos','date','DESC',['index','404'],$num);
    $html = '<div class="lastPosts">';
    foreach($articulos as $articulo)
    {
        $date = date('d/m/Y',$articulo['date']);
        $html .= '<div class="lastPost">';
        $html .= '  <h5> <a href="'.$articulo['url'].'">'.$articulo['title'].'</a></h5>';
        $html .= ' <p>'.$date.'</p>';
        $html .= '</div>';
    }
    $html .= '</div>';
    echo $html;
});

Barrio::actionAdd('Contact',function($mail = ''){

    $error = '';
    if(isset($_POST['Submit'])){
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
      if(mail(
        $recepient,
        $pagetitle,
        $message,
        "Content-type: text/plain; charset=\"utf-8\" \nFrom: $name <$email>"
      )){
        // success
        $error = '<p><strong>Gracias tu mensaje ha sido enviado ....</strong></p>';
      }else{
        // error
        $error = '<p style="color:red;"><strong>Lo siento hubo un problema al enviarlo por favor intentelo otra vez..</strong></p>';
      };
    }
    // show error
    echo $error;
    $html = '<div class="row">';
    $html .= '<div class="col-6">';
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
    $html .= '        <textarea  name="message" class="form-control" rows="10" required></textarea>';
    $html .= '      </div>';
    $html .= '      <input type="submit" name="Submit" class="btn btn-outline" value="Enviar Formulario">';
    $html .= '  </form>';
    $html .= '</div>';
    echo $html;
});