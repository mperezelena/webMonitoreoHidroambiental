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




 $nivelUs=$_GET['nivelUs'];
 
 

  ?>
  
  
<script>

//función que cambia las provincias del select de provincias en función del país que se haya escogido en el select de país.
function muestraParams(){
	//tomo el valor del select del pais elegido
	var estacion
	estacion = document.form.lista_est[document.form.lista_est.selectedIndex].value
	//miro a ver si el pais está definido
	if (estacion== 1) {
     document.getElementById("tablaInter1").style.display = 'block';
     document.getElementById("tablaInter2").style.display = 'none';
     document.getElementById("tablaSens1").style.display = 'block';
     document.getElementById("tablaSens2").style.display = 'none';
     
	}
	else if (estacion==2)  {
	  document.getElementById("tablaInter2").style.display = 'block';
     document.getElementById("tablaInter1").style.display = 'none';
     document.getElementById("tablaSens2").style.display = 'block';
     document.getElementById("tablaSens1").style.display = 'none';
	}

}

       
function activar(l_str_input) {

document.getElementById(l_str_input).disabled = !document.getElementById(l_str_input).disabled;
}
</script>






<title> Gestión </title>

<body>
<br>
<br>
<br>

<h6> Selección de estaciones y parámetros a modificar </h6>
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
 <form name="form"  action="confirmaCambios.php?nivelUs=<?php echo $nivelUs ?>" method="post">
     <select id="lista_est" name="lista_est" onchange="muestraParams()" >
        <option selected value="0">Seleccionar estación</option>
       <?php echo $concatenado; ?>
    </select>
<br>
<br>
<br>

   
<!--    /*****************   INTERVALO****************/ -->
    
<div class="subtitulo">
<h6>Modificar intervalo</h6>
</div>

   <br>
   
   <!-- ********************************************** -->
  <!-- /////////Tabla Intervalo estación 1//////// -->
  <!-- ********************************************** -->
  <table id="tablaInter1" style="display: none; margin-left:350px;">
  <?php

    $sql=intervaloEst(1);  
	 $result= mysql_query($sql,$link);
	 $intervalo=mysql_result($result,0);
  
    ?>
     
   <tr>
    <td><h5> Intevalo de medición (minutos): </h5></td>
    <td> <input type="checkbox"  onclick="javascript:activar('intervalo1');"  name="checkIntervalo" /> </td>
    <td>  <input type="text"  id="intervalo1" name="intervalo1"  value= <?php echo $intervalo ?> disabled="true" /> </td>
   </tr>
 </table>   
    
    <!-- ********************************************** -->
    <!-- ///////Tabla Intervalo estación 2///////// -->
    <!-- ********************************************** -->
  <table id="tablaInter2" style="display: none; margin-left:350px;"> 
  <?php

    $sql=intervaloEst(2);  
	 $result= mysql_query($sql,$link);
	 $intervalo=mysql_result($result,0);
  
    ?>
   <tr>
    <td><h5> Intevalo de medición (minutos): </h5></td>
    <td> <input type="checkbox"  onclick="javascript:activar('intervalo2');"  name="checkIntervalo" /> </td>
    <td>  <input type="text"  id="intervalo2" name="intervalo2"  value=<?php echo $intervalo ?> disabled="true" /> </td>
   </tr>
 </table> 
  
 <br>
      


<div class="subtitulo">
<h6>Activar/Desactivar sensores</h6>
</div>
<br>
<br>

<!-- ********************************************** -->
<!-- /////// TABLA SENSORES ESTACION 1 //////////// -->
<!-- ********************************************** -->
<table style="display: none; margin-left:450px;" id="tablaSens1">
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
     
    if($estado==11) {
    	
      ${'opcion0'.$i}="<option value=11>Activado</option>";
      ${'concatenado'.$i} = "<option value=10>Desactivado</option>";  

    }
    elseif($estado==10) {
     ${'opcion0'.$i}="<option selected value=10>Desactivado</option>";
     ${'concatenado'.$i} = "<option value=11>Activado</option>";  
     

    }
    
    mysql_free_result($result);
 }


   ?>
 
 <!-- /////////SENSOR[0]//////////////-->
   <tr>
      <td></td>
   <td> <h5> <?php echo $nombreSensores[0]; ?> </h5></td>
     
   <td>
    
    <input type="checkbox"  onclick="javascript:activar('lista_sens10');"  name='0'; value='<?php echo $nombreSensores[0]; ?> '/> 
   </td> 
     

   <td>

    <select id= "lista_sens10" name="lista_sens10" disabled="true" >
       <?php echo $opcion00; ?>
       <?php echo $concatenado0; ?>
    </select>
   </td>

    </tr>
    
 <!--    /////////SENSOR[1]////////////// -->
   <tr>
      <td></td>
   <td> <h5> <?php echo $nombreSensores[1]; ?> </h5></td>
     
   <td>
    
    <input type="checkbox"  onclick="javascript:activar('lista_sens11');"  name='1'; value='<?php echo $nombreSensores[1]; ?> '/> 
   </td> 
     

   <td>

    <select id= "lista_sens11"  name="lista_sens11" disabled="true" >
        <?php echo $opcion01; ?>
       <?php echo $concatenado1; ?>
    </select>
   </td>

    </tr>
   
  <!--    /////////SENSOR[2]////////////// -->
   <tr>
      <td></td>
   <td> <h5> <?php echo $nombreSensores[2]; ?> </h5></td>
     
   <td>
    
    <input type="checkbox"  onclick="javascript:activar('lista_sens12');"  name='2'; value='<?php echo $nombreSensores[2]; ?> '/> 
   </td> 
     

   <td>

    <select id= "lista_sens12"  name="lista_sens12" disabled="true" >
        <?php echo $opcion02 ?>
       <?php echo $concatenado2; ?>
    </select>
   </td>

 <!--    /////////SENSOR[3]////////////// -->
   <tr>
      <td></td>
   <td> <h5> <?php echo $nombreSensores[3]; ?> </h5></td>
     
   <td>
    
    <input type="checkbox"  onclick="javascript:activar('lista_sens13');"  name='3'; value='<?php echo $nombreSensores[3]; ?> '/> 
   </td> 
     

   <td>

    <select id= "lista_sens13"  name="lista_sens13" disabled="true" >
        <?php echo $opcion03; ?>
       <?php echo $concatenado3; ?>
    </select>
   </td>

    </tr>
   
    </tr>
   
    <!--    /////////SENSOR[4]////////////// -->
   <tr>
      <td></td>
   <td> <h5> <?php echo $nombreSensores[4]; ?> </h5></td>
     
   <td>
    
    <input type="checkbox"  onclick="javascript:activar('lista_sens14');"  name='4'; value='<?php echo $nombreSensores[4]; ?> '/> 
   </td> 
     

   <td>

    <select id= "lista_sens14" name="lista_sens14" disabled="true" >
         <?php echo $opcion04; ?>
       <?php echo $concatenado4; ?>
    </select>
   </td>

    </tr>
   
   
      </table>
      
<!-- ********************************************** -->
<!-- /////// TABLA SENSORES ESTACION 2 //////////// -->
<!-- ********************************************** -->
<table style="display:none; margin-left:450px;" id="tablaSens2">
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
       
     if($estado==11) {
    	${'opcion0'.$i}="<option value=11>Activado</option>";
      ${'concatenado'.$i} = "<option value=10>Desactivado</option>";  

    }
    elseif($estado==10) {
     ${'opcion0'.$i}="<option selected value=10>Desactivado</option>";
     ${'concatenado'.$i} = "<option value=11>Activado</option>";  
     

    }
    
    mysql_free_result($result);
 }
    


   ?>
 
 <!-- /////////SENSOR[0]//////////////-->
   <tr>
      <td></td>
   <td> <h5> <?php echo $nombreSensores[0]; ?> </h5></td>
     
   <td>
    
    <input type="checkbox"  onclick="javascript:activar('lista_sens20');"   name='checkSens20' value='<?php echo $nombreSensores[0]; ?> '/> 
   </td> 
     

   <td>
  
    <select id= "lista_sens20" name="lista_sens20" disabled="true" >
       <?php echo $opcion00; ?>
       <?php echo $concatenado0; ?>
    </select>
   </td>

    </tr>
    
 <!--    /////////SENSOR[1]////////////// -->
   <tr>
      <td></td>
   <td> <h5> <?php echo $nombreSensores[1]; ?> </h5></td>
     
   <td>
    
    <input type="checkbox"  onclick="javascript:activar('lista_sens21');"   name='checkSens21' value='<?php echo $nombreSensores[1]; ?> '/> 
   </td> 
     

   <td>
   <?php echo $parametro ?>
    <select id= "lista_sens21" name="lista_sens21" disabled="true" >
         <?php echo $opcion01; ?>
       <?php echo $concatenado1; ?>
    </select>
   </td>

    </tr>
   


  </table>
  
<br>
<br>

     <div align="center"> 
  			
       		<input name="boton1" id="boton1" type="submit" value="Aplicar cambios" class="boton">

     		
     		</div>
     		<br>
     		<br>

</form>

</div>

</body>