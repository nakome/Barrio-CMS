Title: Shortcodes plantilla
Description:  Shortcodes que se pueden usar en la plantilla
Template: articulo

----



{Alert type='info' clase='mt-5 mb-5'}
**Nota!** Si te fijas en el shortcode hay un espacio en el primer corchete, esto lo hago para que no se convierta en html solamente.
{/Alert}




## Alerts


{Alert type='primary'}**Primary!** This is a primary alert-check it out!{/Alert}
{Alert type='secondary'}**Secondary!** This is a primary alert-check it out!{/Alert}
{Alert type='success'}**Success!** This is a primary alert-check it out!{/Alert}
{Alert type='info'}**Info!** This is a primary alert-check it out!{/Alert}
{Alert type='warning'}**Warning!** This is a primary alert-check it out!{/Alert}
{Alert type='danger'}**Danger!** This is a primary alert-check it out!{/Alert}
{Alert type='light'}**Light!** This is a primary alert-check it out!{/Alert}
{Alert type='dark'}**Dark!** This is a primary alert-check it out!{/Alert}

---
{Code type='php'}// type [primary|secondary|success|info|warning|danger|light|dark]
{ Alert type='primary'} **Primary!** This is a primary alert-check it out! {/Alert}
{/Code}

## Botones


**Color**


{Btn color='primary' text='Primary' link='http://example.com'}
{Btn color='secondary' text='Secondary' link='http://example.com'}
{Btn color='success' text='Success' link='http://example.com'}
{Btn color='info' text='Info' link='http://example.com'}
{Btn color='warning' text='Warning' link='http://example.com'}
{Btn color='danger' text='Danger' link='http://example.com'}
{Btn color='light' text='Light' link='http://example.com'}
{Btn color='dark' text='Dark' link='http://example.com'}
{Btn color='link' text='Link' link='http://example.com'}


---

{Code type='php'}// color = [primary|secondary|success|info|warning|danger|light|dark|link]
// text = texto del boton
// id =  id del boton (opcional)
// link = direcciÃ³n  (opcional)
{ Btn color='link' text='Link' link='http://example.com'}
{/Code}



**Outline**

{Btn type="outline" color='primary' text='Primary' link='http://example.com'}
{Btn type="outline" color='secondary' text='Secondary' link='http://example.com'}
{Btn type="outline" color='success' text='Success' link='http://example.com'}
{Btn type="outline" color='info' text='Info' link='http://example.com'}
{Btn type="outline" color='warning' text='Warning' link='http://example.com'}
{Btn type="outline" color='danger' text='Danger' link='http://example.com'}
{Btn type="outline" color='light' text='Light' link='http://example.com'}
{Btn type="outline" color='dark' text='Dark' link='http://example.com'}
{Btn type="outline" color='link' text='Link' link='http://example.com'}


---
{Code type='php'}// type = Tipo de boton [ouline] ( opcinal )
// color = [primary|secondary|success|info|warning|danger|light|dark|link]
// text = texto del boton
// id =  id del boton (opcional)
// link = direcciÃ³n  (opcional)
{ Btn type="outline" color='primary' text='Primary' id='btn' link='http://example.com' }
{/Code}

---


### Columnas


{Bloques}

{Bloque col='4'}
**col 4**

Labore ipsum ea dolor labore deserunt magna magna sit consequat magna eiusmod consequat.
{/Bloque}

{Bloque col='4'}
**col 4**

Labore ipsum ea dolor labore deserunt magna magna sit consequat magna eiusmod consequat.
{/Bloque}

{Bloque col='4'}
**col 4**

Labore ipsum ea dolor labore deserunt magna magna sit consequat magna eiusmod consequat.
{/Bloque}

{/Bloques}


{Bloques}

{Bloque col='3'}
**col 3**

Labore ipsum ea dolor labore deserunt magna magna sit consequat magna eiusmod consequat.
{/Bloque}
{Bloque col='3'}
**col 3**

Labore ipsum ea dolor labore deserunt magna magna sit consequat magna eiusmod consequat.
{/Bloque}
{Bloque col='3'}
**col 3**

Labore ipsum ea dolor labore deserunt magna magna sit consequat magna eiusmod consequat.
{/Bloque}
{Bloque col='3'}
**col 3**

Labore ipsum ea dolor labore deserunt magna magna sit consequat magna eiusmod consequat.
{/Bloque}
{/Bloques}


{Bloques}
{Bloque col='6'}
**col 6**

Labore ipsum ea dolor labore deserunt magna magna sit consequat magna eiusmod consequat.
{/Bloque}
{Bloque col='6'}
**col 6**

Labore ipsum ea dolor labore deserunt magna magna sit consequat magna eiusmod consequat.
{/Bloque}
{/Bloques}

{Bloques}
{Bloque col='8'}
**col 8**

Labore ipsum ea dolor labore deserunt magna magna sit consequat magna eiusmod consequat.
{/Bloque}
{Bloque col='4'}
**col 4**

Labore ipsum ea dolor labore deserunt magna magna.
{/Bloque}
{/Bloques}

{Bloques}
{Bloque col='4'}
**col 4**

Labore ipsum ea dolor labore deserunt magna magna.
{/Bloque}
{Bloque col='8'}
**col 8**

Labore ipsum ea dolor labore deserunt magna magna sit consequat magna eiusmod consequat.
{/Bloque}
{/Bloques}

---

{Code type='php'}// clase = se le puede añadir cualquer classe
{ Bloques}

// col = numero de columnas que al sumarse sean igual a 12
{ Bloque col='4'}
Labore ipsum ea dolor labore deserunt magna magna sit consequat magna eiusmod consequat.
{/Bloque}

{ Bloque col='4'}
Labore ipsum ea dolor labore deserunt magna magna sit consequat magna eiusmod consequat.
{/Bloque}

{ Bloque col='4'}
Labore ipsum ea dolor labore deserunt magna magna sit consequat magna eiusmod consequat.
{/Bloque}

{/Bloques}
{/Code}


### Bloque_izq y Bloque_drch


{Bloque_izq img='{url}/content/imagenes/sin-imagen.svg' text='esta es una imagen'}

Enim nostrud Lorem pariatur dolore aute labore quis minim commodo deserunt sint et. Cillum quis aliqua ipsum nisi consequat et Lorem consectetur. Esse occaecat magna reprehenderit.

{/Bloque_izq}


{Bloque_drch img='{url}/content/imagenes/sin-imagen.svg' text='esta es una imagen'}

Enim nostrud Lorem pariatur dolore aute labore quis minim commodo deserunt sint et. Cillum quis aliqua ipsum nisi consequat et Lorem consectetur. Esse occaecat magna reprehenderit

{/Bloque_drch}


---

{Code type='php'}// img = ruta de una imagen para la izquierda
// text= de la imagen
// col = numero de la primera columna por defecto 6
// clase = class
{ Bloque_izq clase='img-cover' col='8' img='{ url}/content/imagenes/sin-imagen.svg' text='Imagen en Izquierda'}

Enim nostrud Lorem pariatur dolore aute labore quis minim commodo deserunt sint et. Cillum quis aliqua ipsum nisi consequat et Lorem consectetur. Esse occaecat magna reprehenderit.

{/Bloque_izq}


{ Bloque_drch clase='img-cover' col='8' img='{ url}/content/imagenes/sin-imagen.svg' text='Imagen en Derecha'}

Enim nostrud Lorem pariatur dolore aute labore quis minim commodo deserunt sint et. Cillum quis aliqua ipsum nisi consequat et Lorem consectetur. Esse occaecat magna reprehenderit

{/Bloque_drch}
{/Code}


### Barra de progreso


{Barra  size='25' color='success'}
{Barra  size='30' color='info'}
{Barra  size='40' color='warning'}
{Barra  size='60' color='danger' clase='mb-5'}

---

{Code type='php'}// size = Tamaño de la barra
// color = [success | info | warning | danger ]
// clase = otra clase
{ Barra  size='25' color='success'}
{/Code}



## Servicios

{Bloques clase='mt-4'}
{Servicio icon='heart' clase='mb-5'}
### Crafted With Love
Lorem ipsum dolor sit amet, consectetur adipisicing.
{/Servicio}
{Servicio icon='laptop' clase='mb-5 text-center'}
### Web Developement
Lorem ipsum dolor sit amet, consectetur adipisicing.
{/Servicio}
{Servicio icon='video' clase='mb-5 text-right'}
### Video Editing
Lorem ipsum dolor sit amet, consectetur adipisicing.
{/Servicio}
{/Bloques}

---

{Code type='php'}{ Bloques clase='mt-4'}

{ Servicio
    icon='heart'
    clase='mb-5'
}
### Crafted With Love
Lorem ipsum dolor sit amet, consectetur adipisicing.
{/Servicio}

{ Servicio
    icon='laptop'
    clase='mb-5 text-center'
}
### Web Developement
Lorem ipsum dolor sit amet, consectetur adipisicing.
{/Servicio}

{ Servicio
    icon='video'
    clase='mb-5 text-right'
}
### Video Editing
Lorem ipsum dolor sit amet, consectetur adipisicing.
{/Servicio}

{/Bloques}
{/Code}



## Cards

{Bloques}
{Card col='4' title='heart' img='{url}/content/imagenes/sin-imagen.svg'}
bloques que sumen 12 en total

{Btn color='primary' text='Primary' id='btn' link='//example.com'}
{/Card}
{Card col='4' title='heart' img='{url}/content/imagenes/sin-imagen.svg'}
bloques que sumen 12 en total

{Btn color='primary' text='Primary' id='btn' link='//example.com'}
{/Card}
{Card col='4' title='heart' img='{url}/content/imagenes/sin-imagen.svg'}
bloques que sumen 12 en total

{Btn color='primary' text='Primary' id='btn' link='//example.com'}
{/Card}
{/Bloques}


---

{Code type='php'}// Bloques para agrupar
// col = numero de columna que sume 12 en total en el bloque
// title =  titulo
// img = imagen
// clase = css class
{ Bloques}
{ Card col='4' title='heart' img='{ url}/content/imagenes/sin-imagen.svg'}
bloques que sumen 12 en total

{ Btn color='primary' text='Primary' id='btn' link='//example.com'}
{/Card}
{ Card col='4' title='heart' img='{ url}/content/imagenes/sin-imagen.svg'}
bloques que sumen 12 en total

{ Btn color='primary' text='Primary' id='btn' link='//example.com'}
{/Card}
{ Card col='4' title='heart' img='{ url}/content/imagenes/sin-imagen.svg'}
bloques que sumen 12 en total

{ Btn color='primary' text='Primary' id='btn' link='//example.com'}
{/Card}
{/Bloques}
{/Code}


## Acordeones

{Acordeones id='acordeon'}
{Acordeon clase='active' title='Acordeon uno'}
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus sit similique quidem, sint veniam amet nostrum facilis eius consectetur. Doloremque fuga, libero veritatis itaque nisi numquam earum. Ipsum explicabo, quasi.
{/Acordeon}
{Acordeon  title='Acordeon dos'}
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic quam quasi, officia nulla est possimus fugit nesciunt, dolores dolore eaque. Consequatur, ipsa. Voluptas, laborum voluptatum aliquid doloribus quos praesentium quod.
{/Acordeon}
{Acordeon  title='Acordeon tres'}
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero aperiam nemo adipisci cumque qui vitae nihil. Consequatur quo explicabo dolore quas, autem, temporibus repellendus nostrum qui in necessitatibus optio, non.
{/Acordeon}
{/Acordeones}




---

{Code type='php'}// id = id del acordeon
{ Acordeones id='acordeon'}
// title = el titulo
// clase = la clase ( si es active el acordeon se expande)
{ Acordeon clase='active' title='Acordeon uno'}
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus sit similique quidem, sint veniam amet nostrum facilis eius consectetur. Doloremque fuga, libero veritatis itaque nisi numquam earum. Ipsum explicabo, quasi.
{/Acordeon}
{ Acordeon  title='Acordeon dos'}
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic quam quasi, officia nulla est possimus fugit nesciunt, dolores dolore eaque. Consequatur, ipsa. Voluptas, laborum voluptatum aliquid doloribus quos praesentium quod.
{/Acordeon}
{ Acordeon  title='Acordeon tres'}
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero aperiam nemo adipisci cumque qui vitae nihil. Consequatur quo explicabo dolore quas, autem, temporibus repellendus nostrum qui in necessitatibus optio, non.
{/Acordeon}
{/Acordeones}
{/Code}


## Iconos

{Code type='php'}// type = nombre
{ Icono type='mobile'}
{/Code}

---


{Icono_demo type='mobile' texto=''}
{Icono_demo type='laptop' texto=''}
{Icono_demo type='desktop' texto=''}
{Icono_demo type='tablet' texto=''}
{Icono_demo type='phone' texto=''}
{Icono_demo type='document' texto=''}
{Icono_demo type='documents' texto=''}
{Icono_demo type='search' texto=''}
{Icono_demo type='clipboard' texto=''}
{Icono_demo type='newspaper' texto=''}
{Icono_demo type='notebook' texto=''}
{Icono_demo type='book-open' texto=''}
{Icono_demo type='browser' texto=''}
{Icono_demo type='calendar' texto=''}
{Icono_demo type='presentation' texto=''}
{Icono_demo type='picture' texto=''}
{Icono_demo type='pictures' texto=''}
{Icono_demo type='video' texto=''}
{Icono_demo type='camera' texto=''}
{Icono_demo type='printer' texto=''}
{Icono_demo type='toolbox' texto=''}
{Icono_demo type='briefcase' texto=''}
{Icono_demo type='wallet' texto=''}
{Icono_demo type='gift' texto=''}
{Icono_demo type='bargraph' texto=''}
{Icono_demo type='grid' texto=''}
{Icono_demo type='expand' texto=''}
{Icono_demo type='focus' texto=''}
{Icono_demo type='edit' texto=''}
{Icono_demo type='adjustments' texto=''}
{Icono_demo type='ribbon' texto=''}
{Icono_demo type='hourglass' texto=''}
{Icono_demo type='lock' texto=''}
{Icono_demo type='megaphone' texto=''}
{Icono_demo type='shield' texto=''}
{Icono_demo type='trophy' texto=''}
{Icono_demo type='flag' texto=''}
{Icono_demo type='map' texto=''}
{Icono_demo type='puzzle' texto=''}
{Icono_demo type='basket' texto=''}
{Icono_demo type='envelope' texto=''}
{Icono_demo type='streetsign' texto=''}
{Icono_demo type='telescope' texto=''}
{Icono_demo type='gears' texto=''}
{Icono_demo type='key' texto=''}
{Icono_demo type='paperclip' texto=''}
{Icono_demo type='attachment' texto=''}
{Icono_demo type='pricetags' texto=''}
{Icono_demo type='lightbulb' texto=''}
{Icono_demo type='layers' texto=''}
{Icono_demo type='pencil' texto=''}
{Icono_demo type='tools' texto=''}
{Icono_demo type='tools-2' texto=''}
{Icono_demo type='scissors' texto=''}
{Icono_demo type='paintbrush' texto=''}
{Icono_demo type='magnifying-glass' texto=''}
{Icono_demo type='circle-compass' texto=''}
{Icono_demo type='linegraph' texto=''}
{Icono_demo type='mic' texto=''}
{Icono_demo type='strategy' texto=''}
{Icono_demo type='beaker' texto=''}
{Icono_demo type='caution' texto=''}
{Icono_demo type='recycle' texto=''}
{Icono_demo type='anchor' texto=''}
{Icono_demo type='profile-male' texto=''}
{Icono_demo type='profile-female' texto=''}
{Icono_demo type='bike' texto=''}
{Icono_demo type='wine' texto=''}
{Icono_demo type='hotairballoon' texto=''}
{Icono_demo type='globe' texto=''}
{Icono_demo type='genius' texto=''}
{Icono_demo type='map-pin' texto=''}
{Icono_demo type='dial' texto=''}
{Icono_demo type='chat' texto=''}
{Icono_demo type='heart' texto=''}
{Icono_demo type='cloud' texto=''}
{Icono_demo type='upload' texto=''}
{Icono_demo type='download' texto=''}
{Icono_demo type='target' texto=''}
{Icono_demo type='hazardous' texto=''}
{Icono_demo type='piechart' texto=''}
{Icono_demo type='speedometer' texto=''}
{Icono_demo type='global' texto=''}
{Icono_demo type='compass' texto=''}
{Icono_demo type='lifesaver' texto=''}
{Icono_demo type='clock' texto=''}
{Icono_demo type='aperture' texto=''}
{Icono_demo type='quote' texto=''}
{Icono_demo type='scope' texto=''}
{Icono_demo type='alarmclock' texto=''}
{Icono_demo type='refresh' texto=''}
{Icono_demo type='happy' texto=''}
{Icono_demo type='sad' texto=''}
{Icono_demo type='facebook' texto=''}
{Icono_demo type='twitter' texto=''}
{Icono_demo type='googleplus' texto=''}
{Icono_demo type='rss' texto=''}
{Icono_demo type='tumblr' texto=''}
{Icono_demo type='linkedin' texto=''}
{Icono_demo type='dribbble' texto=''}
{Icono_demo type='box2' texto=''}
{Icono_demo type='write' texto=''}
{Icono_demo type='clock2' texto=''}
{Icono_demo type='reply2' texto=''}
{Icono_demo type='reply-all2' texto=''}
{Icono_demo type='forward2' texto=''}
{Icono_demo type='flag2' texto=''}
{Icono_demo type='search2' texto=''}
{Icono_demo type='trash2' texto=''}
{Icono_demo type='envelope2' texto=''}
{Icono_demo type='bubble' texto=''}
{Icono_demo type='bubbles' texto=''}
{Icono_demo type='user2' texto=''}
{Icono_demo type='users2' texto=''}
{Icono_demo type='cloud2' texto=''}
{Icono_demo type='download2' texto=''}
{Icono_demo type='upload2' texto=''}
{Icono_demo type='rain' texto=''}
{Icono_demo type='sun' texto=''}
{Icono_demo type='moon2' texto=''}
{Icono_demo type='bell2' texto=''}
{Icono_demo type='folder2' texto=''}
{Icono_demo type='pin2' texto=''}
{Icono_demo type='sound2' texto=''}
{Icono_demo type='microphone' texto=''}
{Icono_demo type='camera2' texto=''}
{Icono_demo type='image2' texto=''}
{Icono_demo type='cog2' texto=''}
{Icono_demo type='calendar2' texto=''}
{Icono_demo type='book2' texto=''}
{Icono_demo type='map-marker' texto=''}
{Icono_demo type='store' texto=''}
{Icono_demo type='support' texto=''}
{Icono_demo type='tag2' texto=''}
{Icono_demo type='heart2' texto=''}
{Icono_demo type='video-camera' texto=''}
{Icono_demo type='trophy2' texto=''}
{Icono_demo type='cart' texto=''}
{Icono_demo type='eye2' texto=''}
{Icono_demo type='cancel' texto=''}
{Icono_demo type='chart' texto=''}
{Icono_demo type='target2' texto=''}
{Icono_demo type='printer2' texto=''}
{Icono_demo type='location2' texto=''}
{Icono_demo type='bookmark2' texto=''}
{Icono_demo type='monitor' texto=''}
{Icono_demo type='cross2' texto=''}
{Icono_demo type='plus2' texto=''}
{Icono_demo type='left' texto=''}
{Icono_demo type='up' texto=''}
{Icono_demo type='browser2' texto=''}
{Icono_demo type='windows' texto=''}
{Icono_demo type='switch2' texto=''}
{Icono_demo type='dashboard' texto=''}
{Icono_demo type='play' texto=''}
{Icono_demo type='fast-forward' texto=''}
{Icono_demo type='next' texto=''}
{Icono_demo type='refresh2' texto=''}
{Icono_demo type='film' texto=''}
{Icono_demo type='home2' texto=''}
{Icono_demo type='add-to-list' texto=''}
{Icono_demo type='classic-computer' texto=''}
{Icono_demo type='controller-fast-backward' texto=''}
{Icono_demo type='creative-commons-attribution' texto=''}
{Icono_demo type='creative-commons-noderivs' texto=''}
{Icono_demo type='creative-commons-noncommercial-eu' texto=''}
{Icono_demo type='creative-commons-noncommercial-us' texto=''}
{Icono_demo type='creative-commons-public-domain' texto=''}
{Icono_demo type='creative-commons-remix' texto=''}
{Icono_demo type='creative-commons-share' texto=''}
{Icono_demo type='creative-commons-sharealike' texto=''}
{Icono_demo type='creative-commons' texto=''}
{Icono_demo type='document-landscape' texto=''}
{Icono_demo type='remove-user' texto=''}
{Icono_demo type='warning' texto=''}
{Icono_demo type='arrow-bold-down' texto=''}
{Icono_demo type='arrow-bold-left' texto=''}
{Icono_demo type='arrow-bold-right' texto=''}
{Icono_demo type='arrow-bold-up' texto=''}
{Icono_demo type='arrow-down' texto=''}
{Icono_demo type='arrow-left' texto=''}
{Icono_demo type='arrow-long-down' texto=''}
{Icono_demo type='arrow-long-left' texto=''}
{Icono_demo type='arrow-long-right' texto=''}
{Icono_demo type='arrow-long-up' texto=''}
{Icono_demo type='arrow-right' texto=''}
{Icono_demo type='arrow-up' texto=''}
{Icono_demo type='arrow-with-circle-down' texto=''}
{Icono_demo type='arrow-with-circle-left' texto=''}
{Icono_demo type='arrow-with-circle-right' texto=''}
{Icono_demo type='arrow-with-circle-up' texto=''}
{Icono_demo type='bookmark' texto=''}
{Icono_demo type='bookmarks' texto=''}
{Icono_demo type='chevron-down' texto=''}
{Icono_demo type='chevron-left' texto=''}
{Icono_demo type='chevron-right' texto=''}
{Icono_demo type='chevron-small-down' texto=''}
{Icono_demo type='chevron-small-left' texto=''}
{Icono_demo type='chevron-small-right' texto=''}
{Icono_demo type='chevron-small-up' texto=''}
{Icono_demo type='chevron-thin-down' texto=''}
{Icono_demo type='chevron-thin-left' texto=''}
{Icono_demo type='chevron-thin-right' texto=''}
{Icono_demo type='chevron-thin-up' texto=''}
{Icono_demo type='chevron-up' texto=''}
{Icono_demo type='chevron-with-circle-down' texto=''}
{Icono_demo type='chevron-with-circle-left' texto=''}
{Icono_demo type='chevron-with-circle-right' texto=''}
{Icono_demo type='chevron-with-circle-up' texto=''}
{Icono_demo type='cloud3' texto=''}
{Icono_demo type='controller-fast-forward' texto=''}
{Icono_demo type='controller-jump-to-start' texto=''}
{Icono_demo type='controller-next' texto=''}
{Icono_demo type='controller-paus' texto=''}
{Icono_demo type='controller-play' texto=''}
{Icono_demo type='controller-record' texto=''}
{Icono_demo type='controller-stop' texto=''}
{Icono_demo type='controller-volume' texto=''}
{Icono_demo type='dot-single' texto=''}
{Icono_demo type='dots-three-horizontal' texto=''}
{Icono_demo type='dots-three-vertical' texto=''}
{Icono_demo type='dots-two-horizontal' texto=''}
{Icono_demo type='dots-two-vertical' texto=''}
{Icono_demo type='download3' texto=''}
{Icono_demo type='emoji-flirt' texto=''}
{Icono_demo type='flow-branch' texto=''}
{Icono_demo type='flow-cascade' texto=''}
{Icono_demo type='flow-line' texto=''}
{Icono_demo type='flow-parallel' texto=''}
{Icono_demo type='flow-tree' texto=''}
{Icono_demo type='install' texto=''}
{Icono_demo type='layers2' texto=''}
{Icono_demo type='open-book' texto=''}
{Icono_demo type='resize-100' texto=''}
{Icono_demo type='resize-full-screen' texto=''}
{Icono_demo type='save' texto=''}
{Icono_demo type='select-arrows' texto=''}
{Icono_demo type='sound-mute' texto=''}
{Icono_demo type='sound' texto=''}
{Icono_demo type='trash' texto=''}
{Icono_demo type='triangle-down' texto=''}
{Icono_demo type='triangle-left' texto=''}
{Icono_demo type='triangle-right' texto=''}
{Icono_demo type='triangle-up' texto=''}
{Icono_demo type='uninstall' texto=''}
{Icono_demo type='upload-to-cloud' texto=''}
{Icono_demo type='upload3' texto=''}
{Icono_demo type='add-user' texto=''}
{Icono_demo type='address' texto=''}
{Icono_demo type='adjust' texto=''}
{Icono_demo type='air' texto=''}
{Icono_demo type='aircraft-landing' texto=''}
{Icono_demo type='aircraft-take-off' texto=''}
{Icono_demo type='aircraft' texto=''}
{Icono_demo type='align-bottom' texto=''}
{Icono_demo type='align-horizontal-middle' texto=''}
{Icono_demo type='align-left' texto=''}
{Icono_demo type='align-right' texto=''}
{Icono_demo type='align-top' texto=''}
{Icono_demo type='align-vertical-middle' texto=''}
{Icono_demo type='archive' texto=''}
{Icono_demo type='area-graph' texto=''}
{Icono_demo type='attachment2' texto=''}
{Icono_demo type='awareness-ribbon' texto=''}
{Icono_demo type='back-in-time' texto=''}
{Icono_demo type='back' texto=''}
{Icono_demo type='bar-graph' texto=''}
{Icono_demo type='battery' texto=''}
{Icono_demo type='beamed-note' texto=''}
{Icono_demo type='bell' texto=''}
{Icono_demo type='blackboard' texto=''}
{Icono_demo type='block' texto=''}
{Icono_demo type='book' texto=''}
{Icono_demo type='bowl' texto=''}
{Icono_demo type='box' texto=''}
{Icono_demo type='briefcase2' texto=''}
{Icono_demo type='browser3' texto=''}
{Icono_demo type='brush' texto=''}
{Icono_demo type='bucket' texto=''}
{Icono_demo type='cake' texto=''}
{Icono_demo type='calculator' texto=''}
{Icono_demo type='calendar3' texto=''}
{Icono_demo type='camera3' texto=''}
{Icono_demo type='ccw' texto=''}
{Icono_demo type='chat2' texto=''}
{Icono_demo type='check' texto=''}
{Icono_demo type='circle-with-cross' texto=''}
{Icono_demo type='circle-with-minus' texto=''}
{Icono_demo type='circle-with-plus' texto=''}
{Icono_demo type='circle' texto=''}
{Icono_demo type='circular-graph' texto=''}
{Icono_demo type='clapperboard' texto=''}
{Icono_demo type='clipboard2' texto=''}
{Icono_demo type='clock3' texto=''}
{Icono_demo type='code' texto=''}
{Icono_demo type='cog' texto=''}
{Icono_demo type='colours' texto=''}
{Icono_demo type='compass2' texto=''}
{Icono_demo type='copy' texto=''}
{Icono_demo type='credit-card' texto=''}
{Icono_demo type='credit' texto=''}
{Icono_demo type='cross' texto=''}
{Icono_demo type='cup' texto=''}
{Icono_demo type='cw' texto=''}
{Icono_demo type='cycle' texto=''}
{Icono_demo type='database' texto=''}
{Icono_demo type='dial-pad' texto=''}
{Icono_demo type='direction' texto=''}
{Icono_demo type='document2' texto=''}
{Icono_demo type='documents2' texto=''}
{Icono_demo type='drink' texto=''}
{Icono_demo type='drive' texto=''}
{Icono_demo type='drop' texto=''}
{Icono_demo type='edit2' texto=''}
{Icono_demo type='email' texto=''}
{Icono_demo type='emoji-happy' texto=''}
{Icono_demo type='emoji-neutral' texto=''}
{Icono_demo type='emoji-sad' texto=''}
{Icono_demo type='erase' texto=''}
{Icono_demo type='eraser' texto=''}
{Icono_demo type='export' texto=''}
{Icono_demo type='eye' texto=''}
{Icono_demo type='feather' texto=''}
{Icono_demo type='flag3' texto=''}
{Icono_demo type='flash' texto=''}
{Icono_demo type='flashlight' texto=''}
{Icono_demo type='flat-brush' texto=''}
{Icono_demo type='folder-images' texto=''}
{Icono_demo type='folder-music' texto=''}
{Icono_demo type='folder-video' texto=''}
{Icono_demo type='folder' texto=''}
{Icono_demo type='forward' texto=''}
{Icono_demo type='funnel' texto=''}
{Icono_demo type='game-controller' texto=''}
{Icono_demo type='gauge' texto=''}
{Icono_demo type='globe2' texto=''}
{Icono_demo type='graduation-cap' texto=''}
{Icono_demo type='grid2' texto=''}
{Icono_demo type='hair-cross' texto=''}
{Icono_demo type='hand' texto=''}
{Icono_demo type='heart-outlined' texto=''}
{Icono_demo type='heart3' texto=''}
{Icono_demo type='help-with-circle' texto=''}
{Icono_demo type='help' texto=''}
{Icono_demo type='home' texto=''}
{Icono_demo type='hour-glass' texto=''}
{Icono_demo type='image-inverted' texto=''}
{Icono_demo type='image' texto=''}
{Icono_demo type='images' texto=''}
{Icono_demo type='inbox' texto=''}
{Icono_demo type='infinity' texto=''}
{Icono_demo type='info-with-circle' texto=''}
{Icono_demo type='info' texto=''}
{Icono_demo type='key2' texto=''}
{Icono_demo type='keyboard' texto=''}
{Icono_demo type='lab-flask' texto=''}
{Icono_demo type='landline' texto=''}
{Icono_demo type='language' texto=''}
{Icono_demo type='laptop2' texto=''}
{Icono_demo type='leaf' texto=''}
{Icono_demo type='level-down' texto=''}
{Icono_demo type='level-up' texto=''}
{Icono_demo type='lifebuoy' texto=''}
{Icono_demo type='light-bulb' texto=''}
{Icono_demo type='light-down' texto=''}
{Icono_demo type='light-up' texto=''}
{Icono_demo type='line-graph' texto=''}
{Icono_demo type='link' texto=''}
{Icono_demo type='list' texto=''}
{Icono_demo type='location-pin' texto=''}
{Icono_demo type='location' texto=''}
{Icono_demo type='lock-open' texto=''}
{Icono_demo type='lock2' texto=''}
{Icono_demo type='log-out' texto=''}
{Icono_demo type='login' texto=''}
{Icono_demo type='loop' texto=''}
{Icono_demo type='magnet' texto=''}
{Icono_demo type='magnifying-glass2' texto=''}
{Icono_demo type='mail' texto=''}
{Icono_demo type='man' texto=''}
{Icono_demo type='map2' texto=''}
{Icono_demo type='mask' texto=''}
{Icono_demo type='medal' texto=''}
{Icono_demo type='megaphone2' texto=''}
{Icono_demo type='menu' texto=''}
{Icono_demo type='message' texto=''}
{Icono_demo type='mic2' texto=''}
{Icono_demo type='minus' texto=''}
{Icono_demo type='mobile2' texto=''}
{Icono_demo type='modern-mic' texto=''}
{Icono_demo type='moon' texto=''}
{Icono_demo type='mouse' texto=''}
{Icono_demo type='music' texto=''}
{Icono_demo type='network' texto=''}
{Icono_demo type='new-message' texto=''}
{Icono_demo type='new' texto=''}
{Icono_demo type='news' texto=''}
{Icono_demo type='note' texto=''}
{Icono_demo type='notification' texto=''}
{Icono_demo type='old-mobile' texto=''}
{Icono_demo type='old-phone' texto=''}
{Icono_demo type='palette' texto=''}
{Icono_demo type='paper-plane' texto=''}
{Icono_demo type='pencil2' texto=''}
{Icono_demo type='phone2' texto=''}
{Icono_demo type='pie-chart' texto=''}
{Icono_demo type='pin' texto=''}
{Icono_demo type='plus' texto=''}
{Icono_demo type='popup' texto=''}
{Icono_demo type='power-plug' texto=''}
{Icono_demo type='price-ribbon' texto=''}
{Icono_demo type='price-tag' texto=''}
{Icono_demo type='print' texto=''}
{Icono_demo type='progress-empty' texto=''}
{Icono_demo type='progress-full' texto=''}
{Icono_demo type='progress-one' texto=''}
{Icono_demo type='progress-two' texto=''}
{Icono_demo type='publish' texto=''}
{Icono_demo type='quote2' texto=''}
{Icono_demo type='radio' texto=''}
{Icono_demo type='reply-all' texto=''}
{Icono_demo type='reply' texto=''}
{Icono_demo type='retweet' texto=''}
{Icono_demo type='rocket' texto=''}
{Icono_demo type='round-brush' texto=''}
{Icono_demo type='rss2' texto=''}
{Icono_demo type='ruler' texto=''}
{Icono_demo type='scissors2' texto=''}
{Icono_demo type='share-alternitive' texto=''}
{Icono_demo type='share' texto=''}
{Icono_demo type='shareable' texto=''}
{Icono_demo type='shield2' texto=''}
{Icono_demo type='shop' texto=''}
{Icono_demo type='shopping-bag' texto=''}
{Icono_demo type='shopping-basket' texto=''}
{Icono_demo type='shopping-cart' texto=''}
{Icono_demo type='shuffle' texto=''}
{Icono_demo type='signal' texto=''}
{Icono_demo type='sound-mix' texto=''}
{Icono_demo type='sports-club' texto=''}
{Icono_demo type='spreadsheet' texto=''}
{Icono_demo type='squared-cross' texto=''}
{Icono_demo type='squared-minus' texto=''}
{Icono_demo type='squared-plus' texto=''}
{Icono_demo type='star-outlined' texto=''}
{Icono_demo type='star' texto=''}
{Icono_demo type='stopwatch' texto=''}
{Icono_demo type='suitcase' texto=''}
{Icono_demo type='swap' texto=''}
{Icono_demo type='sweden' texto=''}
{Icono_demo type='switch' texto=''}
{Icono_demo type='tablet2' texto=''}
{Icono_demo type='tag' texto=''}
{Icono_demo type='text-document-inverted' texto=''}
{Icono_demo type='text-document' texto=''}
{Icono_demo type='text' texto=''}
{Icono_demo type='thermometer' texto=''}
{Icono_demo type='thumbs-down' texto=''}
{Icono_demo type='thumbs-up' texto=''}
{Icono_demo type='thunder-cloud' texto=''}
{Icono_demo type='ticket' texto=''}
{Icono_demo type='time-slot' texto=''}
{Icono_demo type='tools2' texto=''}
{Icono_demo type='traffic-cone' texto=''}
{Icono_demo type='tree' texto=''}
{Icono_demo type='trophy3' texto=''}
{Icono_demo type='tv' texto=''}
{Icono_demo type='typing' texto=''}
{Icono_demo type='unread' texto=''}
{Icono_demo type='untag' texto=''}
{Icono_demo type='user' texto=''}
{Icono_demo type='users' texto=''}
{Icono_demo type='v-card' texto=''}
{Icono_demo type='video2' texto=''}
{Icono_demo type='vinyl' texto=''}
{Icono_demo type='voicemail' texto=''}
{Icono_demo type='wallet2' texto=''}
{Icono_demo type='water' texto=''}
{Icono_demo type='500px-with-circle' texto=''}
{Icono_demo type='500px' texto=''}
{Icono_demo type='basecamp' texto=''}
{Icono_demo type='behance' texto=''}
{Icono_demo type='creative-cloud' texto=''}
{Icono_demo type='dropbox' texto=''}
{Icono_demo type='evernote' texto=''}
{Icono_demo type='flattr' texto=''}
{Icono_demo type='foursquare' texto=''}
{Icono_demo type='google-drive' texto=''}
{Icono_demo type='google-hangouts' texto=''}
{Icono_demo type='grooveshark' texto=''}
{Icono_demo type='icloud' texto=''}
{Icono_demo type='mixi' texto=''}
{Icono_demo type='onedrive' texto=''}
{Icono_demo type='paypal' texto=''}
{Icono_demo type='picasa' texto=''}
{Icono_demo type='qq' texto=''}
{Icono_demo type='rdio-with-circle' texto=''}
{Icono_demo type='renren' texto=''}
{Icono_demo type='scribd' texto=''}
{Icono_demo type='sina-weibo' texto=''}
{Icono_demo type='skype-with-circle' texto=''}
{Icono_demo type='skype' texto=''}
{Icono_demo type='slideshare' texto=''}
{Icono_demo type='smashing' texto=''}
{Icono_demo type='soundcloud' texto=''}
{Icono_demo type='spotify-with-circle' texto=''}
{Icono_demo type='spotify' texto=''}
{Icono_demo type='swarm' texto=''}
{Icono_demo type='vine-with-circle' texto=''}
{Icono_demo type='vine' texto=''}
{Icono_demo type='vk-alternitive' texto=''}
{Icono_demo type='vk-with-circle' texto=''}
{Icono_demo type='vk' texto=''}
{Icono_demo type='xing-with-circle' texto=''}
{Icono_demo type='xing' texto=''}
{Icono_demo type='yelp' texto=''}
{Icono_demo type='dribbble-with-circle' texto=''}
{Icono_demo type='dribbble2' texto=''}
{Icono_demo type='facebook-with-circle' texto=''}
{Icono_demo type='facebook2' texto=''}
{Icono_demo type='flickr-with-circle' texto=''}
{Icono_demo type='flickr' texto=''}
{Icono_demo type='github-with-circle' texto=''}
{Icono_demo type='github' texto=''}
{Icono_demo type='google-with-circle' texto=''}
{Icono_demo type='google' texto=''}
{Icono_demo type='instagram-with-circle' texto=''}
{Icono_demo type='instagram' texto=''}
{Icono_demo type='lastfm-with-circle' texto=''}
{Icono_demo type='lastfm' texto=''}
{Icono_demo type='linkedin-with-circle' texto=''}
{Icono_demo type='linkedin2' texto=''}
{Icono_demo type='pinterest-with-circle' texto=''}
{Icono_demo type='pinterest' texto=''}
{Icono_demo type='rdio' texto=''}
{Icono_demo type='stumbleupon-with-circle' texto=''}
{Icono_demo type='stumbleupon' texto=''}
{Icono_demo type='tumblr-with-circle' texto=''}
{Icono_demo type='tumblr2' texto=''}
{Icono_demo type='twitter-with-circle' texto=''}
{Icono_demo type='twitter2' texto=''}
{Icono_demo type='vimeo-with-circle' texto=''}
{Icono_demo type='vimeo' texto=''}
{Icono_demo type='youtube-with-circle' texto=''}
{Icono_demo type='youtube' texto=''}
{Icono_demo type='home3' texto=''}
{Icono_demo type='home22' texto=''}
{Icono_demo type='home32' texto=''}
{Icono_demo type='office' texto=''}
{Icono_demo type='newspaper2' texto=''}
{Icono_demo type='pencil3' texto=''}
{Icono_demo type='pencil22' texto=''}
{Icono_demo type='quill' texto=''}
{Icono_demo type='pen' texto=''}
{Icono_demo type='blog' texto=''}
{Icono_demo type='eyedropper' texto=''}
{Icono_demo type='droplet' texto=''}
{Icono_demo type='paint-format' texto=''}
{Icono_demo type='image3' texto=''}
{Icono_demo type='images2' texto=''}
{Icono_demo type='camera4' texto=''}
{Icono_demo type='headphones' texto=''}
{Icono_demo type='music2' texto=''}
{Icono_demo type='play2' texto=''}
{Icono_demo type='film2' texto=''}
{Icono_demo type='video-camera2' texto=''}
{Icono_demo type='dice' texto=''}
{Icono_demo type='pacman' texto=''}
{Icono_demo type='spades' texto=''}
{Icono_demo type='clubs' texto=''}
{Icono_demo type='diamonds' texto=''}
{Icono_demo type='bullhorn' texto=''}
{Icono_demo type='connection' texto=''}
{Icono_demo type='podcast' texto=''}
{Icono_demo type='feed' texto=''}
{Icono_demo type='mic3' texto=''}
{Icono_demo type='book3' texto=''}
{Icono_demo type='books' texto=''}
{Icono_demo type='library' texto=''}
{Icono_demo type='file-text' texto=''}
{Icono_demo type='profile' texto=''}
{Icono_demo type='file-empty' texto=''}
{Icono_demo type='files-empty' texto=''}
{Icono_demo type='file-text2' texto=''}
{Icono_demo type='file-picture' texto=''}
{Icono_demo type='file-music' texto=''}
{Icono_demo type='file-play' texto=''}
{Icono_demo type='file-video' texto=''}
{Icono_demo type='file-zip' texto=''}
{Icono_demo type='copy2' texto=''}
{Icono_demo type='paste' texto=''}
{Icono_demo type='stack' texto=''}
{Icono_demo type='folder3' texto=''}
{Icono_demo type='folder-open' texto=''}
{Icono_demo type='folder-plus' texto=''}
{Icono_demo type='folder-minus' texto=''}
{Icono_demo type='folder-download' texto=''}
{Icono_demo type='folder-upload' texto=''}
{Icono_demo type='price-tag2' texto=''}
{Icono_demo type='price-tags' texto=''}
{Icono_demo type='barcode' texto=''}
{Icono_demo type='qrcode' texto=''}
{Icono_demo type='ticket2' texto=''}
{Icono_demo type='cart2' texto=''}
{Icono_demo type='coin-dollar' texto=''}
{Icono_demo type='coin-euro' texto=''}
{Icono_demo type='coin-pound' texto=''}
{Icono_demo type='coin-yen' texto=''}
{Icono_demo type='credit-card2' texto=''}
{Icono_demo type='calculator2' texto=''}
{Icono_demo type='lifebuoy2' texto=''}
{Icono_demo type='phone3' texto=''}
{Icono_demo type='phone-hang-up' texto=''}
{Icono_demo type='address-book' texto=''}
{Icono_demo type='envelop' texto=''}
{Icono_demo type='pushpin' texto=''}
{Icono_demo type='location3' texto=''}
{Icono_demo type='location22' texto=''}
{Icono_demo type='compass3' texto=''}
{Icono_demo type='compass22' texto=''}
{Icono_demo type='map3' texto=''}
{Icono_demo type='map22' texto=''}
{Icono_demo type='history' texto=''}
{Icono_demo type='clock4' texto=''}
{Icono_demo type='clock22' texto=''}
{Icono_demo type='alarm' texto=''}
{Icono_demo type='bell3' texto=''}
{Icono_demo type='stopwatch2' texto=''}
{Icono_demo type='calendar4' texto=''}
{Icono_demo type='printer3' texto=''}
{Icono_demo type='keyboard2' texto=''}
{Icono_demo type='display' texto=''}
{Icono_demo type='laptop3' texto=''}
{Icono_demo type='mobile3' texto=''}
{Icono_demo type='mobile22' texto=''}
{Icono_demo type='tablet3' texto=''}
{Icono_demo type='tv2' texto=''}
{Icono_demo type='drawer' texto=''}
{Icono_demo type='drawer2' texto=''}
{Icono_demo type='box-add' texto=''}
{Icono_demo type='box-remove' texto=''}
{Icono_demo type='download4' texto=''}
{Icono_demo type='upload4' texto=''}
{Icono_demo type='floppy-disk' texto=''}
{Icono_demo type='drive2' texto=''}
{Icono_demo type='database2' texto=''}
{Icono_demo type='undo' texto=''}
{Icono_demo type='redo' texto=''}
{Icono_demo type='undo2' texto=''}
{Icono_demo type='redo2' texto=''}
{Icono_demo type='forward3' texto=''}
{Icono_demo type='reply3' texto=''}
{Icono_demo type='bubble2' texto=''}
{Icono_demo type='bubbles2' texto=''}
{Icono_demo type='bubbles22' texto=''}
{Icono_demo type='bubble22' texto=''}
{Icono_demo type='bubbles3' texto=''}
{Icono_demo type='bubbles4' texto=''}
{Icono_demo type='user3' texto=''}
{Icono_demo type='users3' texto=''}
{Icono_demo type='user-plus' texto=''}
{Icono_demo type='user-minus' texto=''}
{Icono_demo type='user-check' texto=''}
{Icono_demo type='user-tie' texto=''}
{Icono_demo type='quotes-left' texto=''}
{Icono_demo type='quotes-right' texto=''}
{Icono_demo type='hour-glass2' texto=''}
{Icono_demo type='spinner' texto=''}
{Icono_demo type='spinner2' texto=''}
{Icono_demo type='spinner3' texto=''}
{Icono_demo type='spinner4' texto=''}
{Icono_demo type='spinner5' texto=''}
{Icono_demo type='spinner6' texto=''}
{Icono_demo type='spinner7' texto=''}
{Icono_demo type='spinner8' texto=''}
{Icono_demo type='spinner9' texto=''}
{Icono_demo type='spinner10' texto=''}
{Icono_demo type='spinner11' texto=''}
{Icono_demo type='binoculars' texto=''}
{Icono_demo type='search3' texto=''}
{Icono_demo type='zoom-in' texto=''}
{Icono_demo type='zoom-out' texto=''}
{Icono_demo type='enlarge' texto=''}
{Icono_demo type='shrink' texto=''}
{Icono_demo type='enlarge2' texto=''}
{Icono_demo type='shrink2' texto=''}
{Icono_demo type='key3' texto=''}
{Icono_demo type='key22' texto=''}
{Icono_demo type='lock3' texto=''}
{Icono_demo type='unlocked' texto=''}
{Icono_demo type='wrench' texto=''}
{Icono_demo type='equalizer' texto=''}
{Icono_demo type='equalizer2' texto=''}
{Icono_demo type='cog3' texto=''}
{Icono_demo type='cogs' texto=''}
{Icono_demo type='hammer' texto=''}
{Icono_demo type='magic-wand' texto=''}
{Icono_demo type='aid-kit' texto=''}
{Icono_demo type='bug' texto=''}
{Icono_demo type='pie-chart2' texto=''}
{Icono_demo type='stats-dots' texto=''}
{Icono_demo type='stats-bars' texto=''}
{Icono_demo type='stats-bars2' texto=''}
{Icono_demo type='trophy4' texto=''}
{Icono_demo type='gift2' texto=''}
{Icono_demo type='glass' texto=''}
{Icono_demo type='glass2' texto=''}
{Icono_demo type='mug' texto=''}
{Icono_demo type='spoon-knife' texto=''}
{Icono_demo type='leaf2' texto=''}
{Icono_demo type='rocket2' texto=''}
{Icono_demo type='meter' texto=''}
{Icono_demo type='meter2' texto=''}
{Icono_demo type='hammer2' texto=''}
{Icono_demo type='fire' texto=''}
{Icono_demo type='lab' texto=''}
{Icono_demo type='magnet2' texto=''}
{Icono_demo type='bin' texto=''}
{Icono_demo type='bin2' texto=''}
{Icono_demo type='briefcase3' texto=''}
{Icono_demo type='airplane' texto=''}
{Icono_demo type='truck' texto=''}
{Icono_demo type='road' texto=''}
{Icono_demo type='accessibility' texto=''}
{Icono_demo type='target3' texto=''}
{Icono_demo type='shield3' texto=''}
{Icono_demo type='power' texto=''}
{Icono_demo type='switch3' texto=''}
{Icono_demo type='power-cord' texto=''}
{Icono_demo type='clipboard3' texto=''}
{Icono_demo type='list-numbered' texto=''}
{Icono_demo type='list2' texto=''}
{Icono_demo type='list22' texto=''}
{Icono_demo type='tree2' texto=''}
{Icono_demo type='menu2' texto=''}
{Icono_demo type='menu22' texto=''}
{Icono_demo type='menu3' texto=''}
{Icono_demo type='menu4' texto=''}
{Icono_demo type='cloud4' texto=''}
{Icono_demo type='cloud-download' texto=''}
{Icono_demo type='cloud-upload' texto=''}
{Icono_demo type='cloud-check' texto=''}
{Icono_demo type='download22' texto=''}
{Icono_demo type='upload22' texto=''}
{Icono_demo type='download32' texto=''}
{Icono_demo type='upload32' texto=''}
{Icono_demo type='sphere' texto=''}
{Icono_demo type='earth' texto=''}
{Icono_demo type='link2' texto=''}
{Icono_demo type='flag4' texto=''}
{Icono_demo type='attachment3' texto=''}
{Icono_demo type='eye3' texto=''}
{Icono_demo type='eye-plus' texto=''}
{Icono_demo type='eye-minus' texto=''}
{Icono_demo type='eye-blocked' texto=''}
{Icono_demo type='bookmark3' texto=''}
{Icono_demo type='bookmarks2' texto=''}
{Icono_demo type='sun2' texto=''}
{Icono_demo type='contrast' texto=''}
{Icono_demo type='brightness-contrast' texto=''}
{Icono_demo type='star-empty' texto=''}
{Icono_demo type='star-half' texto=''}
{Icono_demo type='star-full' texto=''}
{Icono_demo type='heart4' texto=''}
{Icono_demo type='heart-broken' texto=''}
{Icono_demo type='man2' texto=''}
{Icono_demo type='woman' texto=''}
{Icono_demo type='man-woman' texto=''}
{Icono_demo type='happy2' texto=''}
{Icono_demo type='happy22' texto=''}
{Icono_demo type='smile' texto=''}
{Icono_demo type='smile2' texto=''}
{Icono_demo type='tongue' texto=''}
{Icono_demo type='tongue2' texto=''}
{Icono_demo type='sad2' texto=''}
{Icono_demo type='sad22' texto=''}
{Icono_demo type='wink' texto=''}
{Icono_demo type='wink2' texto=''}
{Icono_demo type='grin' texto=''}
{Icono_demo type='grin2' texto=''}
{Icono_demo type='cool' texto=''}
{Icono_demo type='cool2' texto=''}
{Icono_demo type='angry' texto=''}
{Icono_demo type='angry2' texto=''}
{Icono_demo type='evil' texto=''}
{Icono_demo type='evil2' texto=''}
{Icono_demo type='shocked' texto=''}
{Icono_demo type='shocked2' texto=''}
{Icono_demo type='baffled' texto=''}
{Icono_demo type='baffled2' texto=''}
{Icono_demo type='confused' texto=''}
{Icono_demo type='confused2' texto=''}
{Icono_demo type='neutral' texto=''}
{Icono_demo type='neutral2' texto=''}
{Icono_demo type='hipster' texto=''}
{Icono_demo type='hipster2' texto=''}
{Icono_demo type='wondering' texto=''}
{Icono_demo type='wondering2' texto=''}
{Icono_demo type='sleepy' texto=''}
{Icono_demo type='sleepy2' texto=''}
{Icono_demo type='frustrated' texto=''}
{Icono_demo type='frustrated2' texto=''}
{Icono_demo type='crying' texto=''}
{Icono_demo type='crying2' texto=''}
{Icono_demo type='point-up' texto=''}
{Icono_demo type='point-right' texto=''}
{Icono_demo type='point-down' texto=''}
{Icono_demo type='point-left' texto=''}
{Icono_demo type='warning2' texto=''}
{Icono_demo type='notification2' texto=''}
{Icono_demo type='question' texto=''}
{Icono_demo type='plus3' texto=''}
{Icono_demo type='minus2' texto=''}
{Icono_demo type='info2' texto=''}
{Icono_demo type='cancel-circle' texto=''}
{Icono_demo type='blocked' texto=''}
{Icono_demo type='cross3' texto=''}
{Icono_demo type='checkmark' texto=''}
{Icono_demo type='checkmark2' texto=''}
{Icono_demo type='spell-check' texto=''}
{Icono_demo type='enter' texto=''}
{Icono_demo type='exit' texto=''}
{Icono_demo type='play22' texto=''}
{Icono_demo type='pause' texto=''}
{Icono_demo type='stop' texto=''}
{Icono_demo type='previous' texto=''}
{Icono_demo type='next2' texto=''}
{Icono_demo type='backward' texto=''}
{Icono_demo type='forward22' texto=''}
{Icono_demo type='play3' texto=''}
{Icono_demo type='pause2' texto=''}
{Icono_demo type='stop2' texto=''}
{Icono_demo type='backward2' texto=''}
{Icono_demo type='forward32' texto=''}
{Icono_demo type='first' texto=''}
{Icono_demo type='last' texto=''}
{Icono_demo type='previous2' texto=''}
{Icono_demo type='next22' texto=''}
{Icono_demo type='eject' texto=''}
{Icono_demo type='volume-high' texto=''}
{Icono_demo type='volume-medium' texto=''}
{Icono_demo type='volume-low' texto=''}
{Icono_demo type='volume-mute' texto=''}
{Icono_demo type='volume-mute2' texto=''}
{Icono_demo type='volume-increase' texto=''}
{Icono_demo type='volume-decrease' texto=''}
{Icono_demo type='loop2' texto=''}
{Icono_demo type='loop22' texto=''}
{Icono_demo type='infinite' texto=''}
{Icono_demo type='shuffle2' texto=''}
{Icono_demo type='arrow-up-left' texto=''}
{Icono_demo type='arrow-up2' texto=''}
{Icono_demo type='arrow-up-right' texto=''}
{Icono_demo type='arrow-right2' texto=''}
{Icono_demo type='arrow-down-right' texto=''}
{Icono_demo type='arrow-down2' texto=''}
{Icono_demo type='arrow-down-left' texto=''}
{Icono_demo type='arrow-left2' texto=''}
{Icono_demo type='arrow-up-left2' texto=''}
{Icono_demo type='arrow-up22' texto=''}
{Icono_demo type='arrow-up-right2' texto=''}
{Icono_demo type='arrow-right22' texto=''}
{Icono_demo type='arrow-down-right2' texto=''}
{Icono_demo type='arrow-down22' texto=''}
{Icono_demo type='arrow-down-left2' texto=''}
{Icono_demo type='arrow-left22' texto=''}
{Icono_demo type='circle-up' texto=''}
{Icono_demo type='circle-right' texto=''}
{Icono_demo type='circle-down' texto=''}
{Icono_demo type='circle-left' texto=''}
{Icono_demo type='tab' texto=''}
{Icono_demo type='move-up' texto=''}
{Icono_demo type='move-down' texto=''}
{Icono_demo type='sort-alpha-asc' texto=''}
{Icono_demo type='sort-alpha-desc' texto=''}
{Icono_demo type='sort-numeric-asc' texto=''}
{Icono_demo type='sort-numberic-desc' texto=''}
{Icono_demo type='sort-amount-asc' texto=''}
{Icono_demo type='sort-amount-desc' texto=''}
{Icono_demo type='command' texto=''}
{Icono_demo type='shift' texto=''}
{Icono_demo type='ctrl' texto=''}
{Icono_demo type='opt' texto=''}
{Icono_demo type='checkbox-checked' texto=''}
{Icono_demo type='checkbox-unchecked' texto=''}
{Icono_demo type='radio-checked' texto=''}
{Icono_demo type='radio-checked2' texto=''}
{Icono_demo type='radio-unchecked' texto=''}
{Icono_demo type='crop' texto=''}
{Icono_demo type='make-group' texto=''}
{Icono_demo type='ungroup' texto=''}
{Icono_demo type='scissors3' texto=''}
{Icono_demo type='filter' texto=''}
{Icono_demo type='font' texto=''}
{Icono_demo type='ligature' texto=''}
{Icono_demo type='ligature2' texto=''}
{Icono_demo type='text-height' texto=''}
{Icono_demo type='text-width' texto=''}
{Icono_demo type='font-size' texto=''}
{Icono_demo type='bold' texto=''}
{Icono_demo type='underline' texto=''}
{Icono_demo type='italic' texto=''}
{Icono_demo type='strikethrough' texto=''}
{Icono_demo type='omega' texto=''}
{Icono_demo type='sigma' texto=''}
{Icono_demo type='page-break' texto=''}
{Icono_demo type='superscript' texto=''}
{Icono_demo type='subscript' texto=''}
{Icono_demo type='superscript2' texto=''}
{Icono_demo type='subscript2' texto=''}
{Icono_demo type='text-color' texto=''}
{Icono_demo type='pagebreak' texto=''}
{Icono_demo type='clear-formatting' texto=''}
{Icono_demo type='table' texto=''}
{Icono_demo type='table2' texto=''}
{Icono_demo type='insert-template' texto=''}
{Icono_demo type='pilcrow' texto=''}
{Icono_demo type='ltr' texto=''}
{Icono_demo type='rtl' texto=''}
{Icono_demo type='section' texto=''}
{Icono_demo type='paragraph-left' texto=''}
{Icono_demo type='paragraph-center' texto=''}
{Icono_demo type='paragraph-right' texto=''}
{Icono_demo type='paragraph-justify' texto=''}
{Icono_demo type='indent-increase' texto=''}
{Icono_demo type='indent-decrease' texto=''}
{Icono_demo type='share2' texto=''}
{Icono_demo type='new-tab' texto=''}
{Icono_demo type='embed' texto=''}
{Icono_demo type='embed2' texto=''}
{Icono_demo type='terminal' texto=''}
{Icono_demo type='share22' texto=''}
{Icono_demo type='mail2' texto=''}
{Icono_demo type='mail22' texto=''}
{Icono_demo type='mail3' texto=''}
{Icono_demo type='mail4' texto=''}
{Icono_demo type='amazon' texto=''}
{Icono_demo type='google2' texto=''}
{Icono_demo type='google22' texto=''}
{Icono_demo type='google3' texto=''}
{Icono_demo type='google-plus' texto=''}
{Icono_demo type='google-plus2' texto=''}
{Icono_demo type='google-plus3' texto=''}
{Icono_demo type='hangouts' texto=''}
{Icono_demo type='whatsapp' texto=''}
{Icono_demo type='spotify2' texto=''}
{Icono_demo type='telegram' texto=''}
{Icono_demo type='twitter3' texto=''}
{Icono_demo type='vine2' texto=''}
{Icono_demo type='vk2' texto=''}
{Icono_demo type='renren2' texto=''}
{Icono_demo type='sina-weibo2' texto=''}
{Icono_demo type='rss3' texto=''}
{Icono_demo type='rss22' texto=''}
{Icono_demo type='youtube2' texto=''}
{Icono_demo type='youtube22' texto=''}
{Icono_demo type='twitch' texto=''}
{Icono_demo type='vimeo2' texto=''}
{Icono_demo type='vimeo22' texto=''}
{Icono_demo type='lanyrd' texto=''}
{Icono_demo type='flickr2' texto=''}
{Icono_demo type='flickr22' texto=''}
{Icono_demo type='flickr3' texto=''}
{Icono_demo type='flickr4' texto=''}
{Icono_demo type='dribbble3' texto=''}
{Icono_demo type='behance2' texto=''}
{Icono_demo type='behance22' texto=''}
{Icono_demo type='deviantart' texto=''}
{Icono_demo type='500px2' texto=''}
{Icono_demo type='steam' texto=''}
{Icono_demo type='steam2' texto=''}
{Icono_demo type='dropbox2' texto=''}
{Icono_demo type='onedrive2' texto=''}
{Icono_demo type='github2' texto=''}
{Icono_demo type='npm' texto=''}
{Icono_demo type='basecamp2' texto=''}
{Icono_demo type='trello' texto=''}
{Icono_demo type='wordpress' texto=''}
{Icono_demo type='joomla' texto=''}
{Icono_demo type='ello' texto=''}
{Icono_demo type='blogger' texto=''}
{Icono_demo type='blogger2' texto=''}
{Icono_demo type='tumblr3' texto=''}
{Icono_demo type='tumblr22' texto=''}
{Icono_demo type='yahoo' texto=''}
{Icono_demo type='yahoo2' texto=''}
{Icono_demo type='tux' texto=''}
{Icono_demo type='appleinc' texto=''}
{Icono_demo type='soundcloud2' texto=''}
{Icono_demo type='soundcloud22' texto=''}
{Icono_demo type='skype2' texto=''}
{Icono_demo type='reddit' texto=''}
{Icono_demo type='hackernews' texto=''}
{Icono_demo type='wikipedia' texto=''}
{Icono_demo type='linkedin3' texto=''}
{Icono_demo type='linkedin22' texto=''}
{Icono_demo type='lastfm2' texto=''}
{Icono_demo type='lastfm22' texto=''}
{Icono_demo type='delicious' texto=''}
{Icono_demo type='xing2' texto=''}
{Icono_demo type='xing22' texto=''}
{Icono_demo type='flattr2' texto=''}
{Icono_demo type='foursquare2' texto=''}
{Icono_demo type='yelp2' texto=''}
{Icono_demo type='paypal2' texto=''}
{Icono_demo type='chrome' texto=''}
{Icono_demo type='firefox' texto=''}
{Icono_demo type='IE' texto=''}
{Icono_demo type='edge' texto=''}
{Icono_demo type='safari' texto=''}
{Icono_demo type='opera' texto=''}
{Icono_demo type='file-pdf' texto=''}
{Icono_demo type='file-openoffice' texto=''}
{Icono_demo type='file-word' texto=''}
{Icono_demo type='file-excel' texto=''}
{Icono_demo type='libreoffice' texto=''}
{Icono_demo type='html-five' texto=''}
{Icono_demo type='html-five2' texto=''}
{Icono_demo type='css3' texto=''}
{Icono_demo type='git' texto=''}
{Icono_demo type='codepen' texto=''}
{Icono_demo type='svg' texto=''}
{Icono_demo type='IcoMoon' texto=''}

