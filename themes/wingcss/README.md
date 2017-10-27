
![](screenshot-wingcss.png)

## Alerts

    // type [primary|secondary|success|info|warning|danger|light|dark]
    {Alert type='primary'} **Primary!** This is a primary alert-check it out! {/Alert}

## Botones

    // type = Tipo de boton [ouline] ( opcinal )
    // color = [primary|secondary|success|info|warning|danger|light|dark|link]
    // text = texto del boton
    // id =  id del boton (opcional)
    // link = direcciÃ³n  (opcional)
    {Btn type="outline" color='primary' text='Primary' id='btn' link='http://example.com' }

### Columnas

    // clase = se le puede añadir cualquer classe
    {Bloques}

    // col = numero de columnas que al sumarse sean igual a 12
    {Bloque col='4'}
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

    // img = ruta de una imagen para la izquierda
    // text= de la imagen
    // col = numero de la primera columna por defecto 6
    // clase = class
    {Bloque_izq clase='img-cover' col='8' img='{ url}/content/imagenes/sin-imagen.svg' text='Imagen en Izquierda'}
    Enim nostrud Lorem pariatur dolore aute labore quis minim commodo deserunt sint et. Cillum quis aliqua ipsum nisi consequat et Lorem consectetur. Esse occaecat magna reprehenderit.
    {/Bloque_izq}

    {Bloque_drch clase='img-cover' col='8' img='{ url}/content/imagenes/sin-imagen.svg' text='Imagen en Derecha'}
    Enim nostrud Lorem pariatur dolore aute labore quis minim commodo deserunt sint et. Cillum quis aliqua ipsum nisi consequat et Lorem consectetur. Esse occaecat magna reprehenderit
    {/Bloque_drch}
    {/Code}


### Barra de progreso

    // size = Tamaño de la barra
    // color = [success | info | warning | danger ]
    // clase = otra clase
    {Barra  size='25' color='success'}




## Servicios

    {Bloques clase='mt-4'}

    {Servicio
        icon='heart'
        clase='mb-5'
    }
    ### Crafted With Love
    Lorem ipsum dolor sit amet, consectetur adipisicing.
    {/Servicio}

    {Servicio
        icon='laptop'
        clase='mb-5 text-center'
    }
    ### Web Developement
    Lorem ipsum dolor sit amet, consectetur adipisicing.
    {/Servicio}

    {Servicio
        icon='video'
        clase='mb-5 text-right'
    }
    ### Video Editing
    Lorem ipsum dolor sit amet, consectetur adipisicing.
    {/Servicio}

    {/Bloques}
    {/Code}



## Cards

    // Bloques para agrupar
    // col = numero de columna que sume 12 en total en el bloque
    // title =  titulo
    // img = imagen
    // clase = css class
    {Bloques}
    {Card col='4' title='heart' img='{ url}/content/imagenes/sin-imagen.svg'}
    bloques que sumen 12 en total

    {Btn color='primary' text='Primary' id='btn' link='//example.com'}
    {/Card}
    {Card col='4' title='heart' img='{ url}/content/imagenes/sin-imagen.svg'}
    bloques que sumen 12 en total

    {Btn color='primary' text='Primary' id='btn' link='//example.com'}
    {/Card}
    {Card col='4' title='heart' img='{ url}/content/imagenes/sin-imagen.svg'}
    bloques que sumen 12 en total

    {Btn color='primary' text='Primary' id='btn' link='//example.com'}
    {/Card}
    {/Bloques}
    {/Code}


## Acordeones

    // id = id del acordeon
    {Acordeones id='acordeon'}
    // title = el titulo
    // clase = la clase ( si es active el acordeon se expande)
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
    {/Code}


## Iconos

    // type = nombre
    {Icono type='mobile'}
