Title: Primeros pasos
Description: Como funciona Barrio CMS.
Template: index
----


#### Requisitos de Apache

Aunque la mayoría de las distribuciones de Apache vienen con todo lo necesario, en aras de la exhaustividad, aquí hay una lista de los módulos de Apache necesarios:

	mod_rewrite

También debe asegurarse de tener **AllowOverride All** configurado en los bloques **<Directory>** y / o **<VirtualHost>** para que el archivo **.htaccess** se procese correctamente y las reglas de reescritura surtan efecto.

#### Requerimientos PHP

La mayoría de los proveedores de alojamiento e incluso las configuraciones locales de **LAMP** tienen **PHP** preconfigurado con todo lo que necesita para que Barrio CMS se ejecute. 

#### Instalación.

Si descargó el archivo ZIP y luego planea moverlo a su raíz web, mueva **TODA LA CARPETA** porque contiene varios archivos ocultos (como .htaccess) que no se seleccionarán de manera predeterminada. La omisión de estos archivos ocultos puede causar problemas al ejecutar Barrio CMS.

Ahora ya solo queda abrir el archivo ```config.php``` que se encuentra en **core/storage** configurarlo y ya estaria listo.

#### Archivo config

En el archivo <mark>config.php</mark> encontraras la configuración de la web, desde el titulo, descripción hasta la configuración del menu de navegación.

Puedes crear tu propia configuración pero <mark>no borres las variables que hay por defecto</mark>.

Puedes llamar cualquier variable e el archivo _.md_ .

**Ejemplo:**  `[Esc][Config name='title'][/Esc]` = [Config name='title'] 
