<!DOCTYPE html>

 <meta charset="UTF-8">
<link rel="stylesheet" href="css/central.css">

<title> Principal </title>
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
<h4>Bienvenido!</h4>

<p> Esta web se enmarca en el Proyecto Final de Carrera de Ingeniería en Informática
"Diseño e implementación de un dispositivo de medición hidroambiental basado en hardware
libre gestionado por un sistema de monitoreo remoto".<br>
Desde aquí podrá monitorear las variables hidroambientales medidas por las distintas estaciones
Arduino instaladas en campo y gestionar de forma remota dichos dispositivos modificando los 
parámetros de configuración. <br>
 </p>
</div>
</body>
