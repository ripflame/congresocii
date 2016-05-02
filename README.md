#Congreso de ingeniería e innovación

Web app para el registro de los participantes del congreso de ingeniería e innovación.

###Consideraciones para la base de datos:

* Se debe agregar a la base de datos en la tabla de visitas una entrada que
tendrá `id = 100` y `nombre=Concurso - Participante`
* Se debe agregar otra entrada similar pero con `id=101` y `nombre=Concurso - Expectador`

Los demás campos de esas dos filas se pueden llenar a criterio, se recomienda
poner como cupo el número máximo de participantes del congreso.

###Consideraciones varias

El link de la página de registro del concurso andromie debe configurarse en las
lineas 247 y 255 del archivo `seleccion.php` actualmente direccionan a Google.
