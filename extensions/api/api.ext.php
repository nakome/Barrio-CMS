<?php  defined('BARRIO') or die('Sin accesso a este script.');


// Enable corst
if(!function_exists('enableCors'))
{
	function enableCors()
	{
		// Allow from any origin
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			// Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
			// you want to allow, and if so:
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');    // cache for 1 day
		}
			// Access-Control headers are received during OPTIONS requests
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
			    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
			}
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
			    header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
			}
			exit(0);
		}
	}
}

if(!function_exists('gAll')){
	function gAll($pages = array())
	{
		if($pages)
		{
			$url = Barrio::urlBase();
			// init array
			$arr = array();
			// loop
			foreach($pages as $item){
				// folder
				$folder = str_replace($url, '', $item['url']);
				$folder = str_replace($item['slug'], '', $folder);
				$folder = str_replace('//', '', $folder);
				$folder = rtrim($folder, '/');
				$folder = ($folder) ? $folder : false;

				$slug = str_replace($url, '', $item['url']);
				$slug = str_replace('//', '', $slug);
				$slug = rtrim($slug, '/');

				// array
				$arr[] = array(
					'title' => $item['title'],
					'description' => $item['description'],
					'published' => ($item['published']) ? $item['published'] : true,
					'slug' => $slug,
					'folder' => $folder,
				);
			}
			// return json encode
			die(json_encode($arr));
		}
		else
		{
			die('Error on Api check url');
		}
	}
}


if(!function_exists('gContent')){
	function gContent($page = array())
	{
		if($page)
		{
			// init array
			$arr = array(
				'title' => $page['title'],
				'description' => $page['description'],
				'tags' => $page['tags'],
				'keywords' => $page['keywords'],
				'template' => $page['template'],
				'published' => ($page['published']) ? $page['published'] : true,
				'author' => $page['author'],
				'date' => $page['date'],
				'image' => $page['image'],
				'content' => $page['content'],
				'slug' => $page['slug']
			);
			// return json encode
			die(json_encode($arr));
		}
	}
}


// si existe api
if(array_key_exists('api',$_GET))
{
	// enable Cors
	enableCors();

	// method
	$method = ($_GET['api']) ? $_GET['api'] : null;

	// if exists get 
	if(array_key_exists('g',$_GET))
	{
		// set json headers
		@header('Content-Type: application/json; charset=utf-8');
		// switch g
		switch (trim($_GET['g'])) {
			// get all pages api=pages&g=n
			case urldecode(trim('a')):
				// if empty
				if($method == null):
					$pages = Barrio::pages(null,'date','DESC',array('404'),null);
				else:
					$pages = Barrio::pages($method,'date','DESC',array('index','404'),null);
				endif;
				gAll($pages);
			// get title api=pages&g=n
			case urldecode(trim('t')):
				// if name
				if(array_key_exists('n', $_GET))
				{	
					$nameOfPage = ($_GET['n']) ? urldecode(trim($_GET['n'])) : null;
					$page = Barrio::page($nameOfPage);
					gContent($page);
				}
				break;
		}
	}
	else
	{
		// html
		$html = '<p>Esta es la api de Barrio CMS</p>';
		$html .= '<p>Puedes usar los siguientes <b>Metodos: </b></p>';
		$html .= '<p><b>Todas las paginas: </b> <a href="index.php?api&g=a"><code>index.php?api&g=a</code></a></p>';
		$html .= '<p><b>Filtrar por titulo: </b> <a href="index.php?api&g=t&n=index"><code>index.php?api&g=t&n</code></a></p>';
		$html .= '<p><b>Filtrar por titulo: </b> <a href="index.php?api&g=t&n=contacto"><code>index.php?api&g=t&n=contacto</code></a></p>';
		die($html);
	}

	
}