<?php defined('BARRIO') or die('No hay acceso a este archivo');

// check cookie
if(isset($_COOKIE['Tema'])){
	Barrio::$config['theme'] = $_COOKIE['Tema'];
}

// form post
if(isset($_POST['changeTheme'])){
	 /* expira en una hora */
	setcookie("Tema", $_POST['theme'], time()+3600);
	$cookie = isset($_COOKIE['Tema']);
	$theme = ($cookie) ? $cookie : Barrio::$config['theme'];
	Barrio::$config['theme'] = $theme;
	@header('location: '.Barrio::urlBase().'/'.Barrio::urlCurrent());
	exit;
}

if(isset($_POST['defaultTheme'])){
	setcookie("Tema", 'default', time()+3600);
	@header('location: '.Barrio::urlBase().'/'.Barrio::urlCurrent());
	exit;
}


// styles
Barrio::actionAdd('head',function(){
	echo '<style rel="stylesheet">.topbar-theme{position:fixed;top:0;left:0;padding:1em;width:100%;min-height:10em;z-index:99999999;visibility:hidden;opacity:0;transition:opacity 300ms ease}.topbar-theme-show{visibility:visible;opacity:1;transition:opacity 300ms ease}.showThemePreview{z-index:9999}.closeThemePreview,.showThemePreview{position:fixed;top:1em;left:1em;width:50px;height:50px;line-height:1.5;margin:0;border-radius:4px}.showThemePreview{background:rgba(255,255,255,.18);color:#000;text-decoration:none!important;text-align:text-center!important;border:1px solid #000;transition:all 1s ease}.closeThemePreview{background:0 0;color:#dc3545;text-decoration:none!important;text-align:text-center!important;border:none;transition:all 1s ease}.closeThemePreview:focus,.closeThemePreview:hover{color:#fff;cursor:pointer;transition:all 1s ease}.showThemePreview:focus,.showThemePreview:hover{background:#111;color:#fff;width:auto;cursor:pointer;transition:all 1s ease}.closeThemePreview,.showThemePreview{padding:0;text-align:center}.showThemePreview>span{margin:0;padding:.5em 1em;visibility:hidden;opacity:0;font-family:Consolas,monospace;line-height:30px;display:none}.showThemePreview:focus i,.showThemePreview:hover i{visibility:hidden;opacity:0;display:none}.showThemePreview:focus span,.showThemePreview:hover span{visibility:visible;opacity:1;display:inline-block;margin-left:.5em}</style>';
});
// javascript
Barrio::actionAdd('footer',function(){
	echo '<script rel="javascript">var changeThemePreview = (function(){var showThemePreview = document.querySelector(".showThemePreview"),closeThemePreview =document.querySelector(".closeThemePreview");showThemePreview.addEventListener("click",showOrhideThemePreview);closeThemePreview.addEventListener("click",showOrhideThemePreview);function showOrhideThemePreview(){document.querySelector(".topbar-theme").classList.toggle("topbar-theme-show");}}).apply(this);</script>';
});
// html
Barrio::actionAdd('theme_before',function(){
	echo '
	<div class="topbar-theme bg-light text-dark">
		<button class="closeThemePreview"><i class="icon-circle-with-minus"></i> </button>
		<div class="center m-auto" style="width:330px">
			<form method="post" class="form">
				<div class="form-group">
					<label for="">Selecionar Tema  <small class="text-info">'.Barrio::$config['theme'].'</small></label>
					<select name="theme" class="form-control">
						<option value="'.Barrio::$config['theme'].'"> --- </option>
						<option value="default">Default</option>
						<option value="complex">Complex</option>
						<option value="savory">Savory</option>
						<option value="faneka">Faneka</option>
						<option value="univers">Univers</option>
					</select>
				</div>
				<div class="form-group">
					<input type="submit" name="changeTheme" class="btn btn-info" value="Cambiar Tema">
					<input type="submit" name="defaultTheme" class="btn btn-danger" value="Tema por defecto">
				</div>
			</form>
		</div>
	</div>
	<button class="showThemePreview"><i class="icon-menu"></i><span>Cambiar Plantilla</span></button>';
});
