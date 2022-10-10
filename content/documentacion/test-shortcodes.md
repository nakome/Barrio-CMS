Title: Test Shortcodes
Description: Todos los Shortcodes de Barrio CMS.
Template: index
----


[Styles minify=true]
main p {margin: 0;padding: 0;}
main pre {margin-top: 0.5rem;}
[/Styles]



**Nombre:** Urls

**Descripcción:**  Podremos incrustar enlaces de la página

    [Esc] 
    [Site_url]  // https://localhost/cmsbarrio
    [Site_current]  // obtenemos el hash, en este caso editor
    [/Esc]

[Details title='Demostración']
[Site_url]

[Site_current]
[/Details]


[Divider type=br]


**Nombre:** Php

**Descripcción:**  Podemos incrustar funciones Php

    [Esc][Php]echo 'holas';[/Php] [/Esc]

[Details title='Demostración']
[Text bg='#f55' color='#fff']El shortcode Php se ha desactivado por precaución.[/Text]
[/Details]

[Divider type=br]


**Nombre:** Estilos css

**Descripcción:**  Podremos incrustar css en la cabecera

    [Esc]
    [Styles]body{background:red;}[/Styles]
    [Styles minify=true]body{background:red;}[/Styles]
    [/Esc]

[Details title='Demostración']
Podemos ver la demostración abriendo devtools f12.
[/Details]

[Divider type=br]

**Nombre:** Archivo Estilos css

**Descripcción:**  Podremos incrustar un archivo de css en la cabecera

    [Esc]
    [Style href='//example.css']
    [/Esc]

[Details title='Demostración']
Podemos ver la demostración abriendo devtools f12.
[/Details]

[Divider type=br]

**Nombre:** Scripts

**Descripcción:** Podremos incrustar Javascript al final de body

    [Esc]
    [Scripts]console.log("test");[/Scripts]
    [Scripts minify=true]console.log("test");[/Scripts]
    [/Esc]

[Details title='Demostración']
Podemos ver la demostración abriendo devtools f12.
[/Details]

[Divider type=br]

**Nombre:** Script

**Descripcción:** Podremos incrustar un archivo Javascript al final de body

    [Esc]
    [Script src='//example.js']
    [/Esc]

[Details title='Demostración']
Podemos ver la demostración abriendo devtools f12.
[/Details]

[Divider type=br]

**Nombre:** Archivo texto

**Descripcción:**  Podremos incrustar un archivo de texto

    [Esc]
    [Html src='/public/lorem.txt']
    [/Esc]

[Details title='Demostración']
[Html src='/public/apps/demo3/lorem.txt']
[/Details]

[Divider type=br]


**Nombre:** Config

**Descripcción:** Podremos incrustar un objecto del archivo de configuración

    [Esc]
    [Config name='title']
    [/Esc]

[Details title='Demostración']
[Config name='title']
[/Details]

[Divider type=br]

**Nombre:** Divider

**Descripcción:** Podremos incrustar un barra de division (hr)

    [Esc]
    [Divider]
    [Divider num='2']
    [Divider type='br' num='2']
    [/Esc]

[Details title='Demostración']
[Divider]
[Divider num='2']
[Divider type='br' num='2']
[/Details]

[Divider type=br]

**Nombre:** Button

**Descripcción:** Podremos incrustar un boton

    [Esc]
    [Btn text='hola' id='btn' href='//example.com']
    [/Esc]

[Details title='Demostración']
[Btn text='hola' id='btn' href='//example.com']
[/Details]

[Divider type=br]

**Nombre:** Space

**Descripcción:** Podremos incrustar un espacio

    [Esc]
    [Space]
    [Space num=2]
    [/Esc]

[Details title='Demostración']
hola [Space num=2] que tal [Space num=5] estas.
[/Details]

[Divider type=br]

**Nombre:** Code

**Descripcción:** Podremos incrustar un codigo

    [Esc]
    [Code type='php']php code here[/Code]
    [/Esc]

[Details title='Demostración']
[Code type='php']function sayname(name){[/Code]
[/Details]

[Divider type=br]

**Nombre:** Imagenes

**Descripcción:** Podremos incrustar imagenes

    [Esc]
    [Img src='public/notfound.jpg']
    [Img url='//google.es' src='public/notfound.jpg']
    [Img url='//google.es' title='Hello' src='public/notfound.jpg']
    [Img url='//google.es' title='Hello' cls='well' src='public/notfound.jpg']
    [Img url='//google.es' title='Hello' cls='well' ext='true' src='//localhost/cmsbarrio/public/notfound.jpg']    
    [/Esc]

[Details title='Demostración']
[Img src='public/notfound.jpg']
[/Details]

[Divider type=br]



**Nombre:** Text

**Descripcción:** Podremos incrustar textos con fondo y color o clases css

    [Esc]
    [Text]Color texto[/Text]
    [Text bg='red']Color texto[/Text]
    [Text bg='blue' color='white']Color texto[/Text]
    [/Esc]

[Details title='Demostración']
[Text bg='blue' color='white']Color texto[/Text]
[/Details]

[Divider type=br]


**Nombre:** Link 

**Descripcción:** Podremos incrustar enlaces con clasess css

    [Esc]
    [Link href='GxEc46k46gg']
    [Link title='Ir a monchovarela.es' href='//monchovarela.es']
    [Link alt='website' title='Ir a monchovarela.es' href='//monchovarela.es']
    [Link cls='btn btn-primary' alt='pagina ' title='Ir a monchovarela.es' href='//monchovarela.es']
    [/Esc]

[Details title='Demostración']
[Link title='Ir a monchovarela.es' href='//monchovarela.es']
[/Details]

[Divider type=br]


**Nombre:** Details

**Descripcción:** Podremos incrustar un bloque con contenido oculto

    [Esc]
    [Details title='example']Markdown Hidden content [/Details]
    [/Esc]

[Details title='Demostración']
Lo que estas viendo ya es el Shortcode.
[/Details]

[Divider type=br]

**Nombre:** Iframes

**Descripcción:** Podremos incrustar un bloque con un iframe

    [Esc]
    [Iframe src='//monchovarela.es']
    [/Esc]

[Details title='Demostración']
[Iframe src='//monchovarela.es']
[/Details]

[Divider type=br]

**Nombre:** Youtube

**Descripcción:** Podremos incrustar un bloque de Youtube

    [Esc]
    [Youtube id='GxEc46k46gg']
    [Youtube cls='ratio ratio-1x1' id='GxEc46k46gg']
    [/Esc]

[Details title='Demostración']
[Youtube id='GxEc46k46gg']
[/Details]

[Divider type=br]

**Nombre:** Vimeo

**Descripcción:** Podremos incrustar un bloque de Vimeo

    [Esc]
    [Vimeo id='149129821']
    [Vimeo cls='ratio ratio-1x1' id='149129821']
    [/Esc]

[Details title='Demostración']
[Vimeo id='149129821']
[/Details]

[Divider type=br]

**Nombre:** Video

**Descripcción:** Podremos incrustar un bloque de video

    [Esc]
    [Video cls='p-1' src='public/test.mp4']
    [Video cls='p-1' autoplay=true src='public/test.mp4']
    [Video cls='p-1' autoplay=true autobuffer=true src='public/test.mp4']
    [Video cls='p-1' controls=true autoplay=true autobuffer=true muted=true' loop=true src='public/test.mp4']
    [/Esc]

[Details title='Demostración']
[Video cls='p-1' autoplay=true muted=true src='public/test.mp4']
[/Details]

[Divider type=br]