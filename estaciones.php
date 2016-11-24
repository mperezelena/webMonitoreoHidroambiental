<!DOCTYPE html>

 <meta charset="UTF-8">
<link rel="stylesheet" href="css/central.css">

<title> Estaciones </title>
<?php

	session_cache_limiter('private_no_expire');
//Inicio la sesión 
session_start(); 

//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO 
if ($_SESSION["autentificado"] != "SI") { 
   	//si no existe, envio a la página de autentificacion 
   	header("Location: index.php"); 
   	//ademas salgo de este script 
   	exit(); 
}	
/* else { 
    //sino, calculamos el tiempo transcurrido 
    $fechaGuardada = $_SESSION["ultimoAcceso"]; 
    $ahora = date("Y-n-j H:i:s"); 
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 

    //comparamos el tiempo transcurrido 
     if($tiempo_transcurrido >= 1200) { 
     //si pasaron 10 minutos o más 
      session_destroy(); // destruyo la sesión 
      $error='expiro';
      header('Location: index.php?error='.$error ); //envío al usuario a la pag. de autenticación 
      //sino, actualizo la fecha de la sesión 
    }else { 
    $_SESSION["ultimoAcceso"] = $ahora; 
   } 
}*/


 
 include('encabezado.php');
 include('btncerrar.php');
 include('menu.php');


  

 $nivelUs=$_GET['nivelUs'];

?>




<body>

<div class="content">


&nbsp<p> Las estaciones de medición están basadas en Hardware Libre, específicamente Arduino y se anexaron a dicha placa
módulos, sensores y shields.<br>
Cada estación está compuesta por dos nodos: emisor y receptor.<p>

<h4>&nbsp;Emisor</h4> <br>
<p>
Este nodo es el que se encuentra en el punto de observación midiendo los datos requeridos. Una vez obtenidos las
distintas variables envía estos valores al nodo receptor mediante radiofrecuencia.<br>
las variables que mide y por ende, los sensores varían de acuerdo a la estación.<br>
<br>
Nodo de <b> Estación FICH </b>está compuesto por: </p>
<h5>&nbsp;Sensores</h5>
<p>
* DHT22: Temperatura [°C] y Humedad ambiente [%]. <br>
* FC28: Humedad de suelo.<br>
* DS18B20: Temperatura de suelo [°C]. <br>
* SHT10: Temperatura [°C] y Humedad [%] de suelo <br>
* Anemómetro: Velocidad de viento [km/h]. <br>
</p>

<h5>&nbsp;Módulos</h5>
<p>
* NRF24L01: Transmisión wireless mediante radiofrecuencia. <br>
</p>

<h5>&nbsp;Shields</h5>
<p>
* DataLogger: RTC (Real Time Clock) para obtener la hora y SD para almacenamiento. <br>
</p>
<br>

<div style="text-align:center" >
<img src="images/arduino.jpg" width="40%" height="20%" hspace=3 >

<img src="images/campo4.jpg" width="40%" height="40%" align="top" >

</div>
<br>
<br>


<h4>&nbsp;Receptor</h4> <br>
<p>
Es el dispositivo encargado de recibir los datos del emisor y enviarlos al servidor. Está conectado a internet y situado
a una distancia no mayor a Xmts del emisor.<br>
Está compuesto por: </p>

<h5>&nbsp;Módulos</h5>
<p>
* NRF24L01: Transmisión wireless mediante radiofrecuencia. <br>
</p>

<h5>&nbsp;Shields</h5>
<p>
* Ethernet: para la conexión a internet. <br>
</p>

 <br>

</div>
</body>
