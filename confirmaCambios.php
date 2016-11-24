<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8">

 

      <link rel="stylesheet" href="css/modal.css">
 
	<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
    <title> Confirmar cambios </title>
    
 
 <?php
  include("conec_db.php");
include("functions.php");
$link=Conection();

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
     //si pasaron 20 minutos o más 
      session_destroy(); // destruyo la sesión 
      $error='expiro';
      header('Location: index.php?error='.$error); //envío al usuario a la pag. de autenticación 
      //sino, actualizo la fecha de la sesión 
    }else { 
    $_SESSION["ultimoAcceso"] = $ahora; 
   } 
}*/
?>


	
	<?php

  include('encabezado.php');
  include('btncerrar.php');
  include('menu.php');


 $nivelUs=$_GET['nivelUs'];
 
 

  ?>
  
	<script type="text/javascript">
	function mostrarVentana()
{
    var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
    ventana.style.marginTop = "200px"; // Definimos su posición vertical. La ponemos fija para simplificar el código
    ventana.style.marginLeft = ((document.body.clientWidth-350) / 2) +  "px"; // Definimos su posición horizontal
    ventana.style.display = 'block'; // Y lo hacemos visible
}

function ocultarVentana()
{
    var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
    ventana.style.display = 'none'; // Y lo hacemos invisible
    
}

</script>

</head>

<?php

    
  $idEstacion=$_POST['lista_est'];
  $checkIntervalo=$_POST['checkIntervalo'];
echo $checkIntervalo;
  if($idEstacion==1) {
   $checkSensor[0]=$_POST['checkSens'.$idEstacion.'0'];
   $checkSensor[1]=$_POST['checkSens'.$idEstacion.'1'];
   $checkSensor[2]=$_POST['checkSens'.$idEstacion.'2'];
   $checkSensor[3]=$_POST['checkSens'.$idEstacion.'3'];
   $checkSensor[4]=$_POST['checkSens'.$idEstacion.'4']; 

  }
  elseif($idEstacion==2) {
   $checkSensor[0]=$_POST['checkSens'.$idEstacion.'0'];
   $checkSensor[1]=$_POST['checkSens'.$idEstacion.'1'];
  
  }
  echo $checkSensor[0];
  echo $checkSensor[3];
?>

<body onload="javascript:mostrarVentana();">
 
 <div id="miVentana" style="position: fixed; width: 350px; height: 190px; top: 0; left: 0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">
 <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#36868d">Mensaje</div>
 <p style="padding: 5px; text-align: justify; line-height:normal">
 
 <?php
 if($idEstacion==0) {
   	 ?>
      	<h3> Debe ingresar la estación</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break;
 }
  if($checkIntervalo!='on' && $checkSensor[0]=='' && $checkSensor[1]=='' && $checkSensor[2]=='' && $checkSensor[3]=='' && $checkSensor[4]=='') {
   	 ?>
      	<h3> Debe modificar al menos un parámetro</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break;
 }
 
  /// INTERVALO
  $cont=count($checkSensor);
  if($checkIntervalo=='on') {
     $intervalo=$_POST['intervalo'.$idEstacion];
    
     $sql=modificarIntervalo($idEstacion,$intervalo); 
     $cambiaIntervalo=mysql_query($sql, $link);  
       if(!$cambiaIntervalo) {
       	 ?>
      	<h3> El intervalo no pudo ser modificado. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 2;}
    }
    
     /// SENSORES
  $cont=count($checkSensor);
  for($i=0;$i<$cont;$i++) {
   if($checkSensor[$i]!='') {
     $nombreSensor=$checkSensor[$i];
     $estado=$_POST['lista_sens'.$idEstacion.$i];
    
     //Obtengo el nombre del sensor
   //  $sql2=nombreSensor($idSensor);
   //  $result=mysql_query($sql2,$link);
   //  $nombre=mysql_result($result,0); 
        
     $sql=modificarSensor($idEstacion,$nombreSensor,$estado); 
     $cambiaEstado=mysql_query($sql, $link);  
       if(!$cambiaEstado) {
         
       	 ?>
      	<h3> El estado del sensor <?php echo $nombre ?> no pudo ser modificado. Intente nuevamente</h3>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>        
       <?php  break 3;}
    }
    
 }
 
     $sql=intervaloEst($idEstacion);
    $result=mysql_query($sql,$link);
    $intervalo=mysql_result($result,0);
    
    $nombreArchivo='gestionE'.$idEstacion.'.txt';
  
    $file = fopen($nombreArchivo, "w");
   
	 fwrite($file, $intervalo . PHP_EOL);
	 
    $sql2=obtenerEstado('',$idEstacion);
    $result2=mysql_query($sql2,$link);

    while($row = mysql_fetch_array($result2)){
     $estado=$row[$idEstacion];
     $estado=substr($estado, 0, 1);
     fwrite($file, $estado . PHP_EOL);
    }
     
     fclose($file);
    
     ?>

<h3>Las modificaciones se realizaron correctamente</h3>
     <form action="gestion.php?&nivelUs=<?php echo $nivelUs ?>" method="post">
     <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
	  <input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
		</div>
		</form>  
     

</html> 
 
