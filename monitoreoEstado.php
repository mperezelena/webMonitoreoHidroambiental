<!DOCTYPE html>

 <meta charset="UTF-8">
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/central.css">

<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
	

	
<?php
 include("conec_db.php");
include("functions.php");
$link=Conection();

 $nivelUs=$_GET['nivelUs'];
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

?>






<?php
 include('encabezado.php');
 include('btncerrar.php');
 include('menu.php');



 
 

  ?>
  
  
<script>

//función que cambia las provincias del select de provincias en función del país que se haya escogido en el select de país.
function muestraParams(){
	//tomo el valor del select del pais elegido
	var estacion
	estacion = document.form.lista_est[document.form.lista_est.selectedIndex].value
	//miro a ver si el pais está definido
	if (estacion== 1) {
	  document.getElementById("tablaEstado1").style.display = 'block';
     document.getElementById("tablaEstado2").style.display = 'none';
     document.getElementById("tablaInter1").style.display = 'block';
     document.getElementById("tablaInter2").style.display = 'none';
     document.getElementById("tablaSens1").style.display = 'block';
     document.getElementById("tablaSens2").style.display = 'none';
     
	}
	else if (estacion==2)  {
	  document.getElementById("tablaEstado2").style.display = 'block';
     document.getElementById("tablaEstado1").style.display = 'none';
	  document.getElementById("tablaInter2").style.display = 'block';
     document.getElementById("tablaInter1").style.display = 'none';
     document.getElementById("tablaSens2").style.display = 'block';
     document.getElementById("tablaSens1").style.display = 'none';
	}

}


</script>






<title> Estado </title>

<body>
<br>
<br>
<br>

<h6> Seleccionar estación para ver su estado </h6>
<div class="monit">
<div class="subtitulo">
<h6>Estación</h6>
</div>
<br>
<br>
<?php
    $sql=listarEstaciones(); //Obtener todos los modelos de disco
	 $result= mysql_query($sql,$link);
       
    $concatenado=""; //El resto de la lista select
    while($row = mysql_fetch_array($result))
    /*Concateno en una variable todas las filas que devolvió el SELECT para pasarlo como
    parámetro al combobox (select)*/  
     { $concatenado .=" <option value='".$row['id']."'>Estación ".$row['nombre']."</option>"; //concatenamos
      }
          
     mysql_free_result($result);
       
     ?>
<form name="form"  action="" >
     <select id="lista_est" name="lista_est" onchange="muestraParams()" >
        <option selected value="0">Seleccionar estación</option>
       <?php echo $concatenado; ?>
    </select>
<br>
<br>
<br>

<!--    /*****************   ESTADO ****************/ -->
    
<div class="subtitulo">
<h6>Estado</h6>
</div>

   <br>
    <br>
   <!-- ********************************************** -->
  <!-- /////////Tabla estado estación 1//////// -->
  <!-- ********************************************** -->
  <div id="tablaEstado1" style="display: none; align:center">
  <?php

    $sql=estadoEstacion(1);  
	 $result= mysql_query($sql,$link);
	 $estadoEst1=mysql_result($result,0);
	 if($estadoEst1>1) {
     $estConcatenado='Sin respuesta';	 
	 }
	 elseif($estadoEst1<=1) {
     $estConcatenado='Funcionando correctamente';	 
	 }
  
    ?>
 
   <input type="text"  id="estado1" name="estado1"  style="width: auto;" disabled="true" value= '<?php echo $estConcatenado ?>'  >

 </div>  
    
    <!-- ********************************************** -->
    <!-- ///////Tabla estado estación 2///////// -->
    <!-- ********************************************** -->
  <div id="tablaEstado2" style="display: none; align:center"> 
  <?php

    $sql=estadoEstacion(2);  
	 $result= mysql_query($sql,$link);
	 $estado=mysql_result($result,0);
    $estadoEst2=mysql_result($result,0);
	  if($estadoEst2>1) {
      $estConcatenado='Sin respuesta';	 
	  }
	  elseif($estadoEst2<=1) {
      $estConcatenado='Funcionando correctamente';	 
	 }
    ?>
  

    <input type="text"  id="intervalo2" name="intervalo2" style="width: auto;" value='<?php echo $estConcatenado ?>' disabled="true" /> 

  </div>
  <br>
 <br>   
<!--    /*****************   INTERVALO****************/ -->
    
<div class="subtitulo">
<h6>Intervalo de medición (minutos)</h6>
</div>

   <br>
   <br>
   <!-- ********************************************** -->
  <!-- /////////Tabla Intervalo estación 1//////// -->
  <!-- ********************************************** -->
  <div id="tablaInter1" style="display: none; align:center">
  <?php

    $sql=intervaloEst(1);  
	 $result= mysql_query($sql,$link);
	 $intervalo1=mysql_result($result,0);
  
    ?>
     
  <input type="text"  id="intervalo1" name="intervalo1"  value= <?php echo $intervalo1 ?> disabled="true" /> </td>
  
 </div>   
    
    <!-- ********************************************** -->
    <!-- ///////Tabla Intervalo estación 2///////// -->
    <!-- ********************************************** -->
  <div id="tablaInter2" style="display: none; align:center"> 
  <?php

    $sql=intervaloEst(2);  
	 $result= mysql_query($sql,$link);
	 $intervalo2=mysql_result($result,0);
	 mysql_free_result($result);
  
    ?>
 
      <input type="text"  id="intervalo2" name="intervalo2"  value=<?php echo $intervalo2 ?> disabled="true" />
      
      </div>
  
 <br>
 <br>      


<div class="subtitulo">
<h6>Sensores</h6>
</div>
<br>
<br>

<!-- ********************************************** -->
<!-- /////// TABLA SENSORES ESTACION 1 //////////// -->
<!-- ********************************************** -->
<table id="tablaSens1" style="display: none; margin-left:450px" >
<?php
  $idEstacion =1;

  $sql=listarSensores($idEstacion);
  $result=mysql_query($sql,$link);

  $cont=0;
  while($row = mysql_fetch_array($result)){
   $idSensores[$cont]=$row['id'];  
   $nombreSensores[$cont]=$row['sensor'];

    $cont++;
  }


  for($i=0;$i<$cont;$i++) {
    $sql2=obtenerEstado($idSensores[$i],$idEstacion);
    $result2= mysql_query($sql2,$link);
    $estado=mysql_result($result2,0);
    
    $sql3=ultimoDato($idSensores[$i],$idEstacion);
    $result3= mysql_query($sql3,$link);
    $dato=mysql_result($result3,0,0);
    $fecha=mysql_result($result3,0,1);
    
    $segundos=strtotime($fecha) - strtotime('now');
    $diferencia_min=intval($segundos/60);

    ${'funcSensor1'.$i}='';
    
    if($estado==11) {
    	
      ${'estadoSensor1'.$i}='Activado';
      
      if($estadoEst1<=1) {      
    
       if($diferencia_min>$intervalo1+5) { //si la diferencia de la hora actual con la última medición es mayor al intervalo+min de tolerancia
         ${'funcSensor1'.$i}= 'Sin respuesta';
       }
       elseif(!is_numeric($dato)) {
      	 ${'funcSensor1'.$i}= 'Error en dato recibido'; 
       }
       else {
         ${'funcSensor1'.$i}= 'Funcionando correctamente'; 
       }
      
      } 
      
      elseif($estadoEst1>1) {
      
        ${'funcSensor1'.$i}= 'Estación sin respuesta';
        
      }
      

    }
    elseif($estado==10) {
     ${'estadoSensor1'.$i}='Desactivado';
      }
    
    mysql_free_result($result);
 }


   ?>
 
 <!-- /////////SENSOR[0]//////////////-->
   <tr>
      <td></td>
   <td> <h5> <?php echo $nombreSensores[0]; ?> </h5></td>
     
   <td>  <input type="text"  id="sens10" value='<?php echo $estadoSensor10.' - '.$funcSensor10 ?>' style="width: 130%;" disabled="true" /> </td> 

    </tr>
    
 <!--    /////////SENSOR[1]////////////// -->
   <tr>
      <td></td>
   <td> <h5> <?php echo $nombreSensores[1]; ?> </h5></td>
     
   <td>  <input type="text"  id="sens11" value='<?php echo $estadoSensor11.' - '.$funcSensor11 ?>' style="width: 130%;" disabled="true" /> </td> 

    </tr>
   
  <!--    /////////SENSOR[2]////////////// -->
   <tr>
      <td></td>
   <td> <h5> <?php echo $nombreSensores[2]; ?> </h5></td>
     
    <td>  <input type="text"  id="sens12" value='<?php echo $estadoSensor12.' - '.$funcSensor12 ?>' style="width: 130%;" disabled="true" /> </td> 
    </tr>

 <!--    /////////SENSOR[3]////////////// -->
   <tr>
      <td></td>
   <td> <h5> <?php echo $nombreSensores[3]; ?> </h5></td>
     
   <td>  <input type="text"  id="sens13" value='<?php echo $estadoSensor13.' - '.$funcSensor13 ?>' style="width: 130%;" disabled="true" /> </td> 
   
    </tr>
   
    <!--    /////////SENSOR[4]////////////// -->
   <tr>
      <td></td>
   <td> <h5> <?php echo $nombreSensores[4]; ?> </h5></td>
     
   <td>  <input type="text"  id="sens14" value='<?php echo $estadoSensor14.' - '.$funcSensor14 ?>' style="width: 130%;" disabled="true" /> </td> 

    </tr>
   
   
      </table>
      
<!-- ********************************************** -->
<!-- /////// TABLA SENSORES ESTACION 2 //////////// -->
<!-- ********************************************** -->
<table id="tablaSens2" style="display:none; margin-left:450px;" >

<?php
  $idEstacion =2;

  $sql=listarSensores($idEstacion);
  $result=mysql_query($sql,$link);

  $cont=0;
  while($row = mysql_fetch_array($result)){
   $idSensores[$cont]=$row['id'];  
   $nombreSensores[$cont]=$row['sensor'];

   $cont++;
  }
  
  for($i=0;$i<$cont;$i++) {
    $sql2=obtenerEstado($idSensores[$i],$idEstacion);
    $result2= mysql_query($sql2,$link);
    $estado=mysql_result($result2,0);
       
    $sql3=ultimoDato($idSensores[$i],$idEstacion);
    $result3= mysql_query($sql3,$link);
    $dato=mysql_result($result3,0,0);
    $fecha=mysql_result($result3,0,1);
  
    $segundos=strtotime($fecha) - strtotime('now');
    $diferencia_min=intval($segundos/60);
           
     if($estado==11) {
    	${'estadoSensor2'.$i}='Activado'; 
    	
    	if($estadoEst2<=1) {
    	
   	 if($diferencia_min>$intervalo2+5) { //si la diferencia de la hora actual con la última medición es mayor al intervalo+min de tolerancia
         ${'funcSensor2'.$i}= 'Sin respuesta';   
       }
       elseif(!is_numeric($dato)) {
      	 ${'funcSensor2'.$i}= 'Error en dato recibido'; 
       }
       else {
         ${'funcSensor2'.$i}= 'Funcionando correctamente'; 
       }
     }
         
    elseif($estadoEst2>1) {
        ${'funcSensor2'.$i}= 'Estación sin respuesta';
      }
    	
   }
    elseif($estado==10) {
     ${'estadoSensor2'.$i}='Desactivado';  
   
    }
    
    mysql_free_result($result);
 }
    


   ?>
 
 <!-- /////////SENSOR[0]//////////////-->
   <tr>
      <td></td>
   <td> <h5> <?php echo $nombreSensores[0]; ?> </h5></td>
     
     <td>  <input type="text"  id="sens20" value='<?php echo $estadoSensor20.' - '.$funcSensor20 ?>' style="width: 130%;" disabled="true" /> </td> 

    </tr>
    
 <!--    /////////SENSOR[1]////////////// -->
   <tr>
      <td></td>
   <td> <h5> <?php echo $nombreSensores[1]; ?> </h5></td>
     
   <td>  <input type="text"  id="sens21" value='<?php echo $estadoSensor21.' - '.$funcSensor21 ?>' style="width: 130%;" disabled="true" /> </td> 

    </tr>
   


  </table>
  
<br>
<br>

</form>

</div>

</body>