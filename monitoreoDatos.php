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



 $link=Conection();
 $nivelUs=$_GET['nivelUs'];
 
 

  ?>
  
  
<script>

//función que cambia las provincias del select de provincias en función del país que se haya escogido en el select de país.
function muestraVariables(){
	//tomo el valor del select del pais elegido
	var estacion
	estacion = document.form.lista_est[document.form.lista_est.selectedIndex].value
	//miro a ver si el pais está definido
	if (estacion== 1) {
     document.getElementById("tablaVar1").style.display = 'block';
     document.getElementById("tablaVar2").style.display = 'none';
     
	}
	else if (estacion==2)  {
	  document.getElementById("tablaVar2").style.display = 'block';
     document.getElementById("tablaVar1").style.display = 'none';
	}

}

	
jQuery(function($){
	$.datepicker.regional['es'] = {
		closeText: 'Cerrar',
		prevText: '&#x3c;Ant',
		nextText: 'Sig&#x3e;',
		currentText: 'Hoy',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
		'Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
		dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
		weekHeader: 'Sm',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['es']);
});    

        $(document).ready(function() {
           $("#fecha_ini").datepicker();
        });
        
        $(document).ready(function() {
           $("#fecha_fin").datepicker();
        });
        
function activar(l_str_input) {
document.getElementById(l_str_input).disabled = !document.getElementById(l_str_input).disabled;

}

function desactivar(l_str_input) {

document.getElementById(l_str_input).disabled = "true";
}

        
</script>






<title> Monitoreo </title>

<body>
<br>
<br>
<br>

<h6> Selección de estaciones y parámetros </h6>
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
 <form name="form"  action="datos.php?nivelUs=<?php echo $nivelUs ?>" method="post">
     <select id="lista_est" name="lista_est" onchange="muestraVariables()" >
        <option selected value="0">Seleccionar estación</option>
       <?php echo $concatenado; ?>
    </select>
<br>
<br>
<br>
<div class="subtitulo">
<h6>Datos</h6>
</div>
<br>
<br>

<!-- Variables estación 1 ocultas inicialmente-->

 <table class="tabla-check" id="tablaVar1" style="display: none; ">
<?php  
 $sql=listarVariables(1); 
 $result= mysql_query($sql,$link);
  while($row = mysql_fetch_array($result)){ ?>
  
 <td> <input type="checkbox" name="variables1[]"  value="<?php echo $row['id']; ?>"  ><?php echo $row['nombre'].' - '.$row['sensor'] ?> &nbsp; &nbsp;</td>  
         
<?php } ?>

</table>


<!-- Variables estación 2 ocultas inicialmente-->

 <table class="tabla-check" id="tablaVar2" style="display: none; margin-left:250px">
<?php  
 $sql=listarVariables(2); 
 $result= mysql_query($sql,$link);
  while($row = mysql_fetch_array($result)){ ?>
  
 <td> <input type="checkbox" name="variables2[]"  value="<?php echo $row['id']; ?>"  > <?php echo $row['nombre'].' - '.$row['sensor'] ?> &nbsp; &nbsp; &nbsp;</td>  

         
<?php } ?>


  </table>
<br>
<br>
<div class="subtitulo">
<h6>Período</h6>
</div>
<br>
<br>
 <table style="margin-left:350px">
 <form action="">
  <td><input   type="radio" name="periodo" value="dia" onclick="javascript:desactivar('fecha_ini');javascript:desactivar('fecha_fin')"> Último día </td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  
  <td><input    type="radio" name="periodo" value="semana" onclick="javascript:desactivar('fecha_ini');javascript:desactivar('fecha_fin')"> Última semana </td>
     
  <td></td>  
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  
  <td> <input   type="radio" name="periodo" value="mes" onclick="javascript:desactivar('fecha_ini');javascript:desactivar('fecha_fin')"> Últimos 30 días </td>
     
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td><input   type="radio" name="periodo" value="intervalo" onclick="javascript:activar('fecha_ini');javascript:activar('fecha_fin')"> Intervalo entre fechas </td> 
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td><label> Fecha Inicio:</label><input type="text" name="fecha_ini" id="fecha_ini" readonly="readonly" size="12" disabled="true"  /> </td>
  <td></td>
  <td></td>
  <td></td>
  <td><label> Fecha Fin:</label><input type="text" name="fecha_fin" id="fecha_fin" readonly="readonly" size="12" disabled="true" /> </td>
  </form>
</table>

<br>
<br>
<br>
<br>
     <div align="center"> 
  			
       		<input name="boton1" id="boton1" type="submit" value="Ver tabla" class="boton">
       		&nbsp;&nbsp;&nbsp;&nbsp;
       		<input name="boton1" id="boton1" type="submit" value="Ver gráfico" class="boton">
     		
     		</div>
     		<br>
     		<br>

</form>

</div>

</body>