Title: Que es Markdown?
Description:  Tutorial de markdown
Template: articulo

----


**Markdown** nació como herramienta de **conversión de texto plano a HTML**.

Esta herramienta fue creada en 2004 por John Gruber, y se distribuye de manera gratuita bajo una [licencia BSD](https://es.wikipedia.org/wiki/Licencia_BSD).

Aunque en realidad Markdown también se considera un lenguaje que tiene la finalidad de permitir crear contenido de una manera sencilla de escribir, y que en todo momento mantenga un diseño legible, así que para simplificar puedes considerar Markdown como un método de escritura.

{cut}


Este método te permitirá añadir formatos tales como **negritas**, _cursivas_ o [enlaces](http), utilizando simplemente texto plano, lo que hará de tu escritura algo más simple y eficiente al evitar distracciones.

---

### Párrafos y saltos de línea

Para generar un nuevo párrafo en Markdown simplemente separa el texto mediante una línea en blanco **(pulsando dos veces intro)**

Al igual que sucede con HTML, **Markdown no soporta dobles líneas en blanco**, así que si intentas generarlas estas se convertirán en una sola al procesarse.

Para realizar un salto de línea y empezar **una frase en una línea siguiente dentro del mismo párrafo**, tendrás que pulsar dos veces la barra espaciadora antes de pulsar una vez intro.

Por ejemplo si quisieses escribir un poema Haiku quedaría tal que así:


{Code type='markdown'}“Andando con sus patitas mojadas,
el gorrión
por la terraza de madera”
{/Code}

Donde cada verso tiene dos espacios en blanco al final.


---


### Encabezados

Las `#` **almohadillas** son uno de los métodos utilizados en Markdown para crear encabezados. Debes usarlos añadiendo **uno por cada nivel**.

Es decir,

{Code type='markdown'}# Encabezado 1
## Encabezado 2
### Encabezado 3
#### Encabezado 4
##### Encabezado 5
###### Encabezado 6
{/Code}


Se corresponde con

# Encabezado 1
## Encabezado 2
### Encabezado 3
#### Encabezado 4
##### Encabezado 5
###### Encabezado 6


También puedes cerrar los encabezados con el mismo número de almohadillas, por ejemplo escribiendo `### Encabezado 3 ###`. Pero la única finalidad de esto es un **motivo estético**.

Existe otra manera de generar encabezados, aunque este método está **limitado a dos niveles**.

Consiste en subrayar los encabezados con el símbolo `=` (para el encabezado 1), o con guiones `-` para el encabezado 2.

Es decir,

{Code type='markdown'}Esto sería un encabezado 1
===
Esto sería un encabezado 2
—-
{/Code}

No existe un número concreto `=` o `-` que necesites escribir para que esto funcione, ¡incluso bastaría con uno!



---


### Citas

Las citas se generar utilizando el carácter mayor que `>` al comienzo del bloque de texto.


> Un país, una civilización se puede juzgar por la forma en que trata a sus animales.  — Mahatma Gandhi
Un país, una civilización se puede juzgar por la forma en que trata a sus animales. — Mahatma Gandhi



Si la cita en cuestión se compone de varios párrafos, deberás añadir el mismo símbolo `>` al comienzo de cada uno de ellos.

{Code type='markdown'}> Creo que los animales ven en el hombre un ser igual a ellos que ha perdido de forma extraordinariamente peligrosa el sano intelecto animal.


> Es decir, que ven en él al animal irracional, al animal que ríe, al animal que llora, al animal infeliz. — Friedrich Nietzsche
Creo que los animales ven en el hombre un ser igual a ellos que ha perdido de forma extraordinariamente peligrosa el sano intelecto animal.
{/Code}

> Creo que los animales ven en el hombre un ser igual a ellos que ha perdido de forma extraordinariamente peligrosa el sano intelecto animal.


> Es decir, que ven en él al animal irracional, al animal que ríe, al animal que llora, al animal infeliz. — Friedrich Nietzsche
Creo que los animales ven en el hombre un ser igual a ellos que ha perdido de forma extraordinariamente peligrosa el sano intelecto animal.



Incluso puedes concatenar varios `>>` para crear **citas anidadas**.

{Code type='markdown'}> Esto sería una cita como la que acabas de ver.
>
> > Dentro de ella puedes anidar otra cita.
>
> La cita principal llegaría hasta aquí.
{/Code}

> Esto sería una cita como la que acabas de ver.
>
> > Dentro de ella puedes anidar otra cita.
>
> La cita principal llegaría hasta aquí.



Recuerda separar los saltos de línea con `>`, o `>>` si te encuentras dentro de la cita anidada; para crear párrafos dentro del mismo bloque de cita.



---



### Listas

A diferencia de lo que ocurre en HTML, generar listas en Markdown es tremendamente sencillo. Puedes encontrarte con dos tipos.


**Listas desordenadas**


Para crear l**istas desordenadas** utiliza `*` **asteriscos**, `-` **guiones**, o `+` **símbolo de suma**.

{Code type='markdown'}- Elemento de lista 1
- Elemento de lista 2
* Elemento de lista 3
* Elemento de lista 4
+ Elemento de lista 5
+ Elemento de lista 6
{/Code}

Da igual qué elemento escojas, incluso puedes intercambiarlos. Todos se verán igual al procesarse.

- Elemento de lista 1
- Elemento de lista 2
- Elemento de lista 3
- Elemento de lista 4
- Elemento de lista 5
- Elemento de lista 6

Para generar **listas anidadas** dentro de otras, simplemente tendrás que añadir **cuatro espacios en blanco** antes del siguiente `*`, `-` o `+`.

{Code type='markdown'}- Elemento de lista 1
- Elemento de lista 2
    - Elemento de lista 3
    - Elemento de lista 4
        - Elemento de lista 5
        - Elemento de lista 6
{/Code}

- Elemento de lista 1
- Elemento de lista 2
    - Elemento de lista 3
    - Elemento de lista 4
        - Elemento de lista 5
        - Elemento de lista 6



---


### Listas ordenadas

Para crear listas ordenadas debes utilizar la sintaxis de tipo: “número.” 1.. Al igual que ocurre con las listas desordenadas, también podrás anidarlas o combinarlas.


{Code type='markdown'}1. Elemento de lista 1
2.  Elemento de lista 2
    - Elemento de lista 3
    - Elemento de lista 4
        1. Elemento de lista 5
        2. Elemento de lista 6
{/Code}

1. Elemento de lista 1
2. Elemento de lista 2
    - Elemento de lista 3
    - Elemento de lista 4
        1. Elemento de lista 5
        2. Elemento de lista 6


---


### Códigos de bloque

Si quieres crear un bloque entero que contenga código. Lo único que tienes que hacer es **encerrar dicho párrafo entre dos líneas formadas por tres `~` o virgulillas** o dos tabulaciones cuando es mucho codigo.


Tal que así:


{Code type='markdown'}~~~
Creando códigos de bloque.
Puedes añadir tantas líneas y párrafos como quieras.
~~~

``` Otro aqui ```
{/Code}

De esta forma, obtendrás el siguiente resultado:


~~~
Creando códigos de bloque.
Puedes añadir tantas líneas y párrafos como quieras.
~~~


``` Otro aqui ```



---


### Reglas horizontales

Las reglas horizontales se utilizan para separar secciones de una manera visual. Las estás viendo constantemente en este artículo ya que las estoy utilizando para separar los diferentes elementos de sintaxis de Markdown.

Para crearlas, en una línea en blanco deberás incluir **tres de los siguientes elementos:** asteriscos, guiones, o guiones bajos.


Es decir

{Code type='markdown'}***
---
___
{/Code}

También puedes separarlos mediante un espacio en blanco por pura estética.


{Code type='markdown'}* * *
- - -
_ _ _
{/Code}


---


### Elementos de línea

**Énfasis (negritas y cursivas)**

Markdown utiliza **asteriscos** o **guiones bajos** para enfatizar.

Simplemente tendrás que envolver palabras o textos en éstos símbolos para conseguir cursivas o negritas.



{Code type='markdown'}*cursiva*

_cursiva_

**negrita**

__negrita__
{/Code}



*cursiva*

_cursiva_

**negrita**

__negrita__




Por supuesto si quieres utilizar los dos tipos de énfasis no tienes más que **combinar la sintaxis**, envolviendo la palabra entre tres asteriscos o tres guiones bajos.


{Code type='markdown'}***cursiva y negrita***

___cursiva y negrita___
{/Code}


***cursiva y negrita***

___cursiva y negrita___



---



### Links o enlaces

Añadir enlaces a una publicación, más que común, hoy en día es algo **casi obligatorio**. Con Markdown tendrás varias formas de hacerlo.

Son los enlaces de toda la vida. Como su nombre indica, se encuentran en línea con el texto.

Se crean escribiendo la palabra o texto enlazada entre `[]`  **corchetes**, y el link en cuestión entre `()` **paréntesis**.


{Code type='markdown'}[enlace en línea](http://www.example.com){/Code}

[enlace en línea](http://www.example.com)


**Links o enlaces como referencia**

La desventaja del método anterior, es que si utilizas links demasiado complejos o largos pueden dificultarte la lectura de tu texto.

Para solucionarlo y crear tu contenido de una manera más ordenada puedes generar enlaces de referencia.

Esto quiere decir que en tu texto enlazarás palabras o códigos concretos **(formados por letras y/o números)**, que en otro lugar más apartado de tu documento tendrás definidos como determinadas URL.


{Code type='markdown'}[nombre que quieres darle a tu enlace][nombre de tu referencia]

[nombre de tu referencia]: http:www.tuenlace.com
{/Code}

Esto se ve más claro con un ejemplo.


{Code type='markdown'}Me llamo Javier Cristóbal y tengo un blog sobre [productividad mac][blog].

En dicha [web][blog] recopilo artículos sobre todo lo relacionado con automatización, gestión y eficiencia.

[blog]: http://limni.net/blog/
{/Code}

La referencia `[blog]` puede estar incluida en cualquier parte del documento, así puedes organizarte mejor y de una manera más limpia, recopilando todas tus referencias en un mismo lugar.



----


### Código

En según que tipo de publicaciones (sobre todo las de carácter técnico), necesitarás añadir pequeñas secciones donde mostrar código de otro lenguaje, atajos de teclado, o demás contenido que no debería ser tratado como tal.

Para ello tienes disponible dos alternativas.


**Código puro `<code>`**


La forma más sencilla de escribir código en Markdown es envolver el texto entre dos comillas sencillas ` ` `

Esto se corresponde con la etiqueta HTML `<code>`

`Esto es una línea de código`

Se verá como Esto es una línea de código.

Como ves, es muy útil para introducir código dentro de la misma línea o párrafo, algo que no permite el método siguiente.

Texto preformateado `<pre>`
La otra manera de añadir código en Markdown es comenzar el párrafo con cuatro espacios en blanco. Esto se corresponde con la etiqueta HTML `<pre>`


{Code type='markdown'}Esto es una línea de código{/Code}

Se convierte en


{Code type='markdown'}`Esto es una línea de código`{/Code}

Ojo, ¡estos espacios deberás incluirlos en cada línea que escribas! Para añadir código en bloque es mejor utilizar la sintaxis que viste anteriormente: códigos de bloque.



---



### Imágenes

Insertar una imagen con Markdown se realiza de una manera prácticamente idéntica a insertar links.

Solo que en este caso, deberás añadir un símbolo de `!` **exclamación** al principio y el **enlace** no será otro que **la ubicación de la imagen**.


{Code type='markdown'}![Texto alternativo](/ruta/a/la/imagen.jpg){/Code}

El texto alternativo es lo que se mostraría si la carga de la imagen fallase.

También podrás añadir un **título alternativo** entrecomillándolo al final de la ruta. Esto sería el título mostrado al dejar el cursor del ratón sobre la imagen.


{Code type='markdown'}![Texto alternativo](/ruta/a/la/imagen.jpg "Título alternativo"){/Code}

Ya que al añadir imágenes también estás tratando con URLs, puedes utilizar el método que viste anteriormente para incluir links **mediante referencias**, solo que en este caso **los enlaces de referencia serán aquellos donde se encuentre tu imagen**.


{Code type='markdown'}De esta forma podrías insertar una imagen
![nombre de la imagen][img1]

O dos, sin ensuciar tu espacio de escritura.
![nombre de la imagen2][img2]

[img1]: /ruta/a/la/imagen.jpg "Título alternativo"
[img2]: /ruta/a/la/imagen2.jpg "Título alternativo"
{/Code}

---



### Elementos varios

**Links automáticos**

Cuando viste los tipos de links te comenté que había un tipo más: los automáticos.

Estos son necesarios cuando lo que quieres es **mostrar una URL completa**, y no un enlace enmascarado bajo una palabra o frase como ocurre con los links en línea.

Para generar links automáticos tan solo tendrás que rodearlos con los símbolos `< >`

{Code type='markdown'} <http://www.limni.net>{/Code}

http://www.limni.net


**Omitir Markdown**

Si has llegado hasta aquí es probable que te estés preguntando cómo he conseguido escribir ciertos símbolos como `*` asteriscos o `_` guiones bajos, sin que Markdown los interprete para convertirlos en negritas, cursivas…

Esto es muy sencillo, ya que en este lenguaje existe un elemento estrella para especificar que todo lo que escribas a continuación, no se interprete como Markdown.

Se trata de la barra invertida `\`.

**Escribiéndola justo delante de cualquiera** de los elementos que verás a continuación, los mismos **no tendrán efecto** a la hora de convertirse en negritas, cursivas, links…


{Code type='markdown'}\  barra invertida
`  acento invertido
*  asterisco
_  guión bajo
{} llaves
[] corchetes
() paréntesis
#  almohadilla
+  símbolo de suma
-  guión
.  punto
!  exclamación
{/Code}

**Nota:** _Texto sacado de [markdown.es](https://markdown.es/sintaxis-markdown)_


