Title: Kitchen Sink
Description: De todo un poco como en bótica.
Template: post
----

[Styles]
.demo1,.demo2,.demo3,.demo4 {padding: 0.2rem 0;background: var(--bs-light);color: var(--bs-dark);font-weight: bold;letter-spacing: 3.3px;text-transform: uppercase;display:flex;justify-content: space-around;align-items: center;height:4rem;}
.demo1 *,.demo2 *,.demo3 *,.demo4 *{margin:0;}
.demo1,.demo2,.demo3,.demo4 {animation:flash 3s infinite ease-in-out;}
@keyframes flash{50%{background:var(--bs-gray)}}
[/Styles]


#### Columnas
Las columnas tienen que sumar entre ellas 12, por ejemplo por defecto la columna tiene 
6 asi que serian dos 6+6  tambien pueden ser 4+8, 8+4, 3+3+6 etc...

    [Esc]
    [Row]
      [Col]Columna[/Col]
      [Col]Columna[/Col]
    [/Row]   
    [/Esc]


[Row]
  [Col cls='demo1']Columna[/Col]
  [Col cls='demo2']Columna[/Col]
[/Row]  

[Divider type=br]

    [Esc]
    [Row]
      [Col num=4]Columna[/Col]
      [Col num=4]Columna[/Col]
      [Col num=4]Columna[/Col]
    [/Row]   
    [/Esc]


[Row]
  [Col num=4 cls='demo1']Columna[/Col]
  [Col num=4 cls='demo2']Columna[/Col]
  [Col num=4 cls='demo3']Columna[/Col]
[/Row]  

[Divider type=br]

    [Esc]
    [Row]
      [Col num=3]Columna[/Col]
      [Col num=3]Columna[/Col]
      [Col num=3]Columna[/Col]
      [Col num=3]Columna[/Col]
    [/Row]   
    [/Esc]


[Row]
  [Col num=3 cls='demo1']Columna[/Col]
  [Col num=3 cls='demo2']Columna[/Col]
  [Col num=3 cls='demo3']Columna[/Col]
  [Col num=3 cls='demo4']Columna[/Col]
[/Row]


[Divider type=br]

**Otras:**

[Row]
  [Col num=4 cls='demo1']Columna 4[/Col]
  [Col num=8 cls='demo2']Columna 8[/Col]
[/Row]
[Row]
  [Col num=8 cls='demo2']Columna 8[/Col]
  [Col num=4 cls='demo1']Columna 4[/Col]
[/Row]
[Row]
  [Col num=3 cls='demo2']Columna 3[/Col]
  [Col num=3 cls='demo2']Columna 3[/Col]
  [Col num=6 cls='demo1']Columna 6[/Col]
[/Row]
[Row]
  [Col num=6 cls='demo1']Columna 6[/Col]
  [Col num=3 cls='demo2']Columna 3[/Col]
  [Col num=3 cls='demo2']Columna 3[/Col]
[/Row]
[Row]
  [Col num=3 cls='demo2']Columna 3[/Col]
  [Col num=6 cls='demo1']Columna 6[/Col]
  [Col num=3 cls='demo2']Columna 3[/Col]
[/Row]


#### Details

  [Esc]
    [Details title='Texto oculto']
      Markdown Hidden content 
    [/Details]
  [/Esc]


[Details title='Texto oculto']
Estoy escondidoo.
[/Details]


    [Esc]
    [Row]
      [Col]
      [Details title='Texto oculto']
        Estoy escondidoo.
      [/Details]
      [/Col]
      [Col]
      [Details title='Texto oculto']
        Estoy escondidoo.
      [/Details]
      [/Col]
    [/Row]  
    [/Esc]

[Row]
  [Col]
  [Details title='Texto oculto']
    Estoy escondidoo.
  [/Details]
  [/Col]
  [Col]
  [Details title='Texto oculto']
    Estoy escondidoo.
  [/Details]
  [/Col]
[/Row]  


[Divider type=br]


#### Imagenes

**Normal:**

    [Esc][Img src='public/notfound.jpg'][/Esc]

[Img src='public/notfound.jpg']


**Con clases css:**

    [Esc][Img cls='clase css' src='public/notfound.jpg'][/Esc]

[Img cls='border border-width-2 border-primary shadow-lg' src='public/notfound.jpg']


**También añadir enlaces:**

    [Esc][Img url='//google.es' src='public/notfound.jpg'][/Esc]

[Img url='//google.es' src='public/notfound.jpg']

**O también añadir texto:**

    [Esc][Img title='Hello' src='public/notfound.jpg'][/Esc]

[Img title='Hello' src='public/notfound.jpg']

**Si el enlace es de otro dominio**

    [Esc][Img title='Hello' ext='true' src='//monchovarela.es/public/proyectos/colectoxo.png'][/Esc]

[Img title='Hello' ext='true' src='//monchovarela.es/public/proyectos/colectoxo.png']

**Nota:** Los enlaces de otro dominio no hace falta poner `https:` solo basta con poner `//` por ejemplo `//example.com/image.png`


[Divider type=br]

#### Textos

A veces necesitamos añadir un texto o nota con un color diferente, para eso usaremos `[Esc][Text][/Esc]`


    [Esc]
    [Text bg='blue' color='white']
    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim 
    veniam, quis nostrud exercitation  ullamco laboris nisi ut aliquip 
    ex ea commodo consequat. Duis aute irure dolor in** reprehenderit 
    in voluptate velit esse cillum dolore eu fugiat nulla pariatur**. 
    [/Text]
    [/Esc]

[Text bg='LightCoral' color='Maroon']
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation  ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in **reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur**. 
[/Text]

[Divider type=br]

#### Divisores (separadores)


    <br/> // normal
    <hr/> // linea normal
    [Esc]
    [Divider] // numero de espacios 1
    [Divider type='br'] // sin linea // numero de espacios 1
    [Divider color='Khaki'] // color
    [Divider cls=demo6] // clase opcional
    [Divider num='2'] // numero de espacios maximo 3
    [Divider type='br' num='2'] // sin linea numero de espacios maximo 3
    [/Esc]

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
<hr/>
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
[Divider color=Indigo]
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
[Divider num='3' color=MediumSpringGreen]
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.


[Divider type=br]


#### Botones

    [Esc]
    [Btn  text='hola' id='btn1'] // para usar javascript
    [Btn  text='hola' cls='btn btn-sm btn-primary'] // con clase
    [Btn  text='hola' href='//example.com'] // enlaces
    [/Esc]


[Btn  text='hola' cls='btn btn-success' href='//google.es']
[Btn  text='hola' cls='btn btn-info' href='//google.es']
[Btn  text='hola' cls='btn btn-warning' href='//google.es']
[Btn  text='hola' cls='btn btn-dark' href='//google.es']
[Btn  text='hola' cls='btn btn-secondary' href='//google.es']
[Btn  text='hola' cls='btn btn-primary' href='https://google.es']

[Btn  text='hola' cls='btn btn-sm btn-success' href='//google.es']
[Btn  text='hola' cls='btn btn-sm btn-info' href='//google.es']
[Btn  text='hola' cls='btn btn-sm btn-warning' href='//google.es']
[Btn  text='hola' cls='btn btn-sm btn-dark' href='//google.es']
[Btn  text='hola' cls='btn btn-sm btn-secondary' href='//google.es']
[Btn  text='hola' cls='btn btn-sm btn-primary' href='https://google.es']

[Divider type=br]


#### Php


    [Esc]
    [Php]
      function sayName($name)[
        print($name);
      ]
      sayName('Hello World');
    [/Php]
    [/Esc]



#### Estilos Css y Javascript

Podemos incluir en cada pagina un Css o Jvascript personalizado.
El Css se añadirá automaticamente al head y el Javascript al footer.


**Css normal:**

    [Esc]
    [Styles]
    body[
      background:red;
      color:white;
    ]
    [/Styles]
    [/Esc]

**Css en archivo:**

    [Esc]
    // no hace falta incluir https
    [Style href='linkto.css']
    [/Esc]

**Javascript normal:**


    [Esc]
    [Scripts]
    function sayName(name)[
      console.log(name);
    ]
    [/Scripts]
    [/Esc]

**Javascript en archivo:**


    [Esc]
    // no hace falta incluir https
    [Script src='linkto.js']
    [/Esc]


[Divider type=br]