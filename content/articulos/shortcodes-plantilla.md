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

    // type [primary|secondary|success|info|warning|danger|light|dark]
    { Alert type='primary'} **Primary!** This is a primary alert-check it out! {/Alert}


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

    // color = [primary|secondary|success|info|warning|danger|light|dark|link]
    // text = texto del boton
    // id =  id del boton (opcional)
    // link = direcciÃ³n  (opcional)
    { Btn color='link' text='Link' link='http://example.com'}

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

    // type = Tipo de boton [ouline] ( opcinal )
    // color = [primary|secondary|success|info|warning|danger|light|dark|link]
    // text = texto del boton
    // id =  id del boton (opcional)
    // link = direcciÃ³n  (opcional)
    { Btn type="outline" color='primary' text='Primary' id='btn' link='http://example.com' }

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

    // clase = se le puede añadir cualquer classe
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



### Bloque_izq y Bloque_drch


{Bloque_izq img='{url}/content/imagenes/sin-imagen.svg' text='esta es una imagen'}

Enim nostrud Lorem pariatur dolore aute labore quis minim commodo deserunt sint et. Cillum quis aliqua ipsum nisi consequat et Lorem consectetur. Esse occaecat magna reprehenderit.

{/Bloque_izq}


{Bloque_drch img='{url}/content/imagenes/sin-imagen.svg' text='esta es una imagen'}

Enim nostrud Lorem pariatur dolore aute labore quis minim commodo deserunt sint et. Cillum quis aliqua ipsum nisi consequat et Lorem consectetur. Esse occaecat magna reprehenderit

{/Bloque_drch}


---


    // img = ruta de una imagen para la izquierda
    // text= de la imagen
    // col = numero de la primera columna por defecto 6
    // clase = class
    { Bloque_izq clase='img-cover' col='8' img='{url}/content/imagenes/sin-imagen.svg' text='Imagen en Izquierda'}

    Enim nostrud Lorem pariatur dolore aute labore quis minim commodo deserunt sint et. Cillum quis aliqua ipsum nisi consequat et Lorem consectetur. Esse occaecat magna reprehenderit.

    {/Bloque_izq}


    { Bloque_drch clase='img-cover' col='8' img='{url}/content/imagenes/sin-imagen.svg' text='Imagen en Derecha'}

    Enim nostrud Lorem pariatur dolore aute labore quis minim commodo deserunt sint et. Cillum quis aliqua ipsum nisi consequat et Lorem consectetur. Esse occaecat magna reprehenderit

    {/Bloque_drch}



### Barra de progreso


{Barra  size='25' color='success'}
{Barra  size='30' color='info'}
{Barra  size='40' color='warning'}
{Barra  size='60' color='danger' clase='mb-5'}

---


    // size = Tamaño de la barra
    // color = [success | info | warning | danger ]
    // clase = otra clase
    { Barra  size='25' color='success'}






