Title: Paso a paso
Description: Pasa texto a mp3 con Python
Template: post
----

Primero tenemos que instalar la libreria gTTS asi que abrimos un terminal como admin y escribimos esto:
```
> pip install gTTS
```

Ahora crearemos una carpeta donde estara el archivo de python y el archivo de texto.

```
> cd Documents
> mkdir texto-a-voz
> touch texto.txt
> touch procesar.py
```

Ahora escribimos en el archivo procesar.py esto:

```
# importamos el modulo gTTS
from gtts import gTTS
# abrimos el texto que queremos pasar a audio
archivo = open("texto.txt",mode="r", encoding="utf-8")
# leemos el texto
texto = archivo.read()
# el texto queda guardado asi que cerramos el archivo
archivo.close()
print('Abriendo archivo')
# iniciamos el proceso de convertir el texto
audio = gTTS(text = texto, lang = "es", slow = False)
print('Grabando texto en mp3')
# guardamos en formato mp3
audio.save('audio.mp3')
print('Proceso terminado')
```


Una vez hecho solo tenemos que escribir en el terminal python procesar.py esperamos un poco y listo el archivo mp3 se ha creado.