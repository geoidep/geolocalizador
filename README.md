# Geolocalizador

Aplicativo que permite geolocalizar una dirección dentro de un formulario de registro.

### Procedimiento

El procedimiento para geolocalizar una dirección es:

-	1.- Agregar un botón UBICAR dentro de tu formulario de registro para invocar al api del mapa dentro de un iframe.

![N|Solid]( http://www.geoidep.gob.pe/images/github/geolocalizador/1.jpg)

-	2.- Buscar la dirección en el mapa, ubicar el punto de referencia y guardarlo.

![N|Solid]( http://www.geoidep.gob.pe/images/github/geolocalizador/2.jpg)

-	3.- Recepcionar la latitud y la longitud de las coordenadas en tu formulario.

![N|Solid]( http://www.geoidep.gob.pe/images/github/geolocalizador/3.jpg)

### Forma de implementar:

-	1.- Prepara tu base de datos agregando 2 campos (lat y lon) en la tabla que guarda tu formulario.
-	2.- Ejecuta los scripts en tu base de datos (utilizamos Postgresql).
-	3.- Publica las carpetas api y service en tu servidor de aplicaciones.
-	4.- Agrega un botón llamado UBICAR en tu formulario y al darle clic invoca al api del mapa dentro de un iframe pasándole el parámetro ubigeo (toma como ejemplo el archivo formulario.php).
-	5.- Recepciona los valores de latitud y longitud que devuelve el api y guárdalos en tu base de datos.


### Demo
[http://geoidep.gob.pe/georreferencia/formulario.php]( http://geoidep.gob.pe/georreferencia/formulario.php) 

### Licencia
Licencia Creative Commons Atribución 4.0 Internacional