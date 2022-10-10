Title: Flat file CMS?
Description: Que es un sistema de contenidos en formato Flat file.
Json: /content/test.json
Template:home
----

Los grandes **CMS** utilizan `MySQL` o sistemas similares de gestión de bases de datos en un segundo plano. Los sistemas de gestión de bases de datos **(SGBD)** actúan de manera relacional y trabajan con varias tablas para gestionar las consultas, para lo que necesitan un servidor adicional. Los **flat file CMS** no cuentan con elementos de gestión de bases de datos, por lo que es habitual hablar de ellos como **CMS sin bases de datos**. Con ello no hay lugar para los **SGBD** y tampoco para los servidores configurados a tales efectos. 


Estos sistemas pueden o bien erigirse como la solución perfecta o lograr simplicidad donde se necesita complejidad. Las ventajas de los sistemas de gestión de contenidos basados en archivos planos surgen en la mayoría de los casos de su estructura simple:

[Divider type=br]

[Details title='Velocidad']
en el caso de los proyectos web de poca envergadura, una **SGBD** relacional excede el objetivo y no es realmente necesaria. Mediante la simplificación de la estructura en un sistema flat file se pueden lograr mejores tasas de velocidad.
[/Details]


[Details title='Sencillez']
las grandes bases de datos suelen tener una estructura compleja, compuesta por enlaces sobre enlaces. Cuando no se tiene mucha experiencia es fácil dar un paso en falso y provocar la caída de la base de datos como si se tratara de un castillo de naipes. Debido a que los flat file CMS se basan en una estructura sencilla de carpetas, es poco probable cometer un error fatal. Por ello, estos sistemas resultan adecuados para aquellos usuarios que ni están muy familiarizados con las bases de datos ni las necesitan realmente para sus proyectos.
[/Details]

[Details title='Seguridad']
cuanto más sencillo sea un sistema, más fácil es evitar errores, y es que la mayoría de percances ocurre al perder la visión global sobre la estructura porque es posible que se cuelen errores en la arquitectura y para encontrarlos y solucionarlos haya que invertir un gran esfuerzo. El mantenimiento de una estructura de carpetas sencilla en la que apenas haya ninguna interrelación es mucho más sencillo, lo que también se aplica a la seguridad externa, pues SQL es un blanco muy popular para ataques malintencionados. **Los atacantes utilizan inyecciones SQL** para filtrar comandos en la base de datos y así espiar y manipular información. **Estas brechas de seguridad, sin embargo, no existen en los flat file CMS**.
[/Details]
  
[Details title='Backup']
crear una copia de seguridad de un flat file CMS no puede ser más sencillo, y es que esto se realiza mediante la función de copiar y pegar. En el caso de los sistemas más complejos, la realización de copias de seguridad es una tarea diaria, pues con estas se guardan datos del sistema, la base de datos y todos los archivos integrados. Por el contrario, una solución flat file es suficiente para copiar todo e integrarlo en otra parte y para almacenar la información **solo se necesita una memoria USB**.
[/Details]
  
[Details title='Traslado']
cambiar de un servidor a otro en WordPress, Typo3 o Drupal es una tarea muy laboriosa. Lo que se dijo sobre el back up de un flat file CMS también tiene su validez para el traslado de la página web. Tan solo basta con copiar y pegar para que la página esté operativa en otro servidor.
[/Details]
  

[Details title='Flujo de trabajo']
cuando se utiliza un CMS clásico el contenido se edita en el backend. Por ello, para realizar cambios en un flat file CMS o crear contenido nuevo puedes recurrir a tu editor preferido.
[/Details]

[Divider type=br]

Los **flat file CMS** son una variante relativamente nueva de los sistemas de gestión de contenidos que se erige como competidora para los CMS tradicionales como **WordPress**, **Typo3** o **Drupal**. Estos sistemas se basan en los llamados flat files o archivos planos, es decir, archivos con una estructura muy sencilla, y plantean tanto ventajas como inconvenientes con respecto a los grandes rivales.