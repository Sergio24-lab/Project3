<?php
/*
Querido programador: 
cuando escribí este código, solo Dios y yo sabíamos cómo funcionaba. 
¡Ahora solo Dios lo sabe! 

Asi que si estas tratando de 'optimizar' esta rutina fracasa (seguramente),
porfavor incrementa el siguiente contador como una advertencia
para el siguiente colega:

total_de_horas_perdidas_aqui = 0 (CHISTE PARA ALEGRAR EL DIA)

Codigo fuente Original de SOFTCODEPM by Emmanuel. (Puedes usarlo para cualquier proposito que tengas)..
Sin embargo si vas a usar nuestro material para subir a Youtube o algun otro medio y hacerlo pasar por tuyo,
te agradeceriamos mucho si pudieras nombrarnos en los creditos o nos veremos obligados a DENUNCIAR tu contenido y Youtube eliminara el video
Hasta ahora van 4/6 canales con videos BORRADOS, evitanos la pena de hacerlo :v fuera de eso espero que te sirva este codigo

Mucha Suerte, modificalo a tu gusto!! 

*/

$host = "localhost";
$user = "root";
$password = "";
$database = "tienda_basica";


$conexion = mysqli_connect($host, $user, $password, $database);
if (!$conexion) {
    echo "No se realizo la conexion a la basa de datos, el error fue:" .
        mysqli_connect_error();
}
