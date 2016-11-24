<!DOCTYPE html>

 <meta charset="UTF-8">
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

	
<link rel="stylesheet" href="css/tabla.css">
 <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>



<script src="js/jquery.fixedTableHeader.js"></script>

	
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

<script type="text/javascript">
  $(document).ready(function () {
    $('table').fixedTableHeader();
 
  });
  
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




<?php

 $tipoVis=$_POST['boton1'];

 $fechaIni2='';
 $fechaFin2='';

 $idEstacion=$_POST['lista_est'];
 if($idEstacion==1) {
  $idVariables=$_POST['variables1'];}
  elseif($idEstacion==2) {
  	$idVariables=$_POST['variables2'];
  }
  $count = count($idVariables);
  

   $sql=nombreEstacion($idEstacion);
 	$result= mysql_query($sql,$link); 
 	$nombreEst=mysql_result($result,0);
 	
 	$periodo=$_POST['periodo'];
 	if($periodo=='dia') {
 		$concatenado='Último día';
 	}
 	elseif($periodo=='semana') {
     	$concatenado='Última semana';
 	}
 	elseif($periodo=='mes') {
     	$concatenado='Últimos 30 días';
 	}
 	elseif($periodo=='intervalo') {
 		$fechaIni=$_POST['fecha_ini'];
 		$fechaFin=$_POST['fecha_fin'];
     	$concatenado=$fechaIni.' - '.$fechaFin;
  
      $fechaIni2=str_replace('/', '-', $fechaIni);
      $fechaFin2=str_replace('/', '-', $fechaFin);


   $fechaIni2 = new DateTime($fechaIni2);
   $fechaFin2 = new DateTime($fechaFin2);
   
   $fechaIni2=date_format($fechaIni2, 'Y-m-d');
   $fechaFin2=date_format($fechaFin2, 'Y-m-d');

 
 	}

 	
$idVariables_b = serialize($idVariables);
$idVariables_b = urlencode($idVariables_b);

  ?>
  
<title> Datos </title>

<body>
<br>
<br>
<br>

<?php 
     if($idEstacion==0) {  ?>
     <body onload="javascript:mostrarVentana();">
<div id="miVentana" style="position: fixed; width: 350px; height: 190px; top: 0; left: 0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">
 <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#36868d">Mensaje</div>
 <p style="padding: 5px; text-align: justify; line-height:normal">

<!-- ///Aviso: falta ingresar estación -> Regresar///-->	
	
     	 <div class="titulo"> Debe seleccionar la estación</div>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>
	</div>
		
 <!--///Aviso: falta seleccionar variable -> Regresar///-->
    <?php  break; } 
    if($count==0) {  ?>
     <body onload="javascript:mostrarVentana();">
		<div id="miVentana" style="position: fixed; width: 350px; height: 190px; top: 0; left: 0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">
 		<div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#36868d">Mensaje</div>
 		<p style="padding: 5px; text-align: justify; line-height:normal">


     	 <div class="titulo"> Debe seleccionar al menos una variable</div>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>
	</div>
		
 <!--///Aviso: falta seleccionar variable -> Regresar///-->
    <?php  break; } 
    if($periodo=='') {  ?>
     <body onload="javascript:mostrarVentana();">
		<div id="miVentana" style="position: fixed; width: 350px; height: 190px; top: 0; left: 0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">
 		<div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#36868d">Mensaje</div>
 		<p style="padding: 5px; text-align: justify; line-height:normal">

<!-- ///Aviso: falta seleccionar período -> Regresar///-->	
	
     	 <div class="titulo"> Debe seleccionar el período</div>
     	 <form action="javascript:history.back(-1);">
     	  <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 44px;"> 
			<input id="btnRegresar" type="submit" name="btnRegresar" size="20" type="button" value="Regresar" />
			</div>
		</form>
	</div>
		
 <!--///Aviso: falta seleccionar variable -> Regresar///-->
    <?php  break; } ?>


  <div class="titulo"> Estación <?php echo $nombreEst ?>  -- Período: <?php echo $concatenado ?> </div>

   <?php if($tipoVis=='Ver tabla') {
   	  if($nivelUs==1) {?>
          <div align="right"> 
          
  			 	 <form action="descarga.php?idEstacion=<?php echo $idEstacion ?>&nombreEst=<?php echo $nombreEst ?>&idVariables=<?php echo $idVariables_b ?>&periodo=<?php echo $periodo ?>&fechaIni=<?php echo $fechaIni2 ?>&fechaFin=<?php echo $fechaFin2 ?>"  method="post" >
      	   	<input name="boton" type="submit" value="Descargar datos" class="boton2">
    	   	</form>
    		
     		</div>
     		
     		<?php } ?>

     		
 <div class="table-title">
  
</div>

<div class="monit">
  
 <table class="table-fill">
 <thead>
 <tr>
 <th>Fecha Hora</th>
  <?php 
  for ($i = 0; $i < $count; $i++){
     $sql1=obtenerNombre($idVariables[$i]);
 	  $result1= mysql_query($sql1,$link); 
 	  $nombre=mysql_result($result1,0,0);
 	  $sensor=mysql_result($result1,0,1);
 	  echo "<th> &nbsp" . $nombre.' - '. $sensor  . "&nbsp </th>";
}  
  ?>  
  
  </tr>
</thead>

<tbody>
<tr>
 <?php 
     
     $sql=obtenerDatos($idEstacion,$periodo,$fechaIni2,$fechaFin2);
 	  $result= mysql_query($sql,$link);
 	  while($row = mysql_fetch_array($result)){
 	  	$fechaFormat=cambiaf_a_normal($row["fecha_hora"]);
 	  	echo  "<tr><td>" .$fechaFormat  . "</td>";
 	    for ($i = 0; $i < $count; $i++){ 
 	      echo "<td>" . $row[$idVariables[$i]] . "</td>";
 	   }
 	   echo "</tr>";
 	
}  

  ?>  
</tr>
</tbody>
</table>
</div>

 <?php }

 elseif($tipoVis=='Ver gráfico') {
   for ($i = 0; $i < $count; $i++){
     $sql1=obtenerNombre($idVariables[$i]);
 	  $result1= mysql_query($sql1,$link); 
 	  $nombres[$i]=mysql_result($result1,0,0);
 	  $sensores[$i]=mysql_result($result1,0,1);
 	 
}  
 
     $sql=obtenerDatos($idEstacion,$periodo,$fechaIni2,$fechaFin2);
 	  $result= mysql_query($sql,$link);
 	  $j=0;
 	  while($row = mysql_fetch_array($result)){
 	  	//$fechaFormat=cambiaf_a_normal($row["fecha_hora"]);
 	  	$fecha[$j]=$row["fecha_hora"];//$fechaFormat;

 	    for ($i = 0; $i < $count; $i++){ 
 	       $variables[$j][$i]=$row[$idVariables[$i]];
 	   }
 	   $j++;
   }
 
$margenInterno=[0,15,15,15,15,15,15,15];
$colores=['#72b352','#3f7b8f'];

//for($j=0,$j<2; $j++) {
 $j=0;
 	$nombre=$nombres[$j];
 	$sensor=$sensores[$j];
 	$color=$colores[$j];
   $top=$j*440+$margenInterno[$j];
   $top=(string)$top;
   $marginTop=$top.'px';
   
   $id='plotly-div'.$j;
   $id=(string)$id;


?> 
 <div id='plotly-div0' style="margin-left:-90px; height:440px; margin-top:0px; display: none; "></div>
 <div id='plotly-div1' style="margin-left:-90px; height:440px; margin-top:0px; display: none;"></div>
 <div id='plotly-div2' style="margin-left:-90px; height:440px; margin-top:0px; display: none;"></div>
 <div id='plotly-div3' style="margin-left:-90px; height:440px; margin-top:0px; display: none;"></div>
 <div id='plotly-div4' style="margin-left:-90px; height:440px; margin-top:0px; display: none;"></div>
 <div id='plotly-div5' style="margin-left:-90px; height:440px; margin-top:0px; display: none;"></div>
 <div id='plotly-div6' style="margin-left:-90px; height:440px; margin-top:0px; display: none;"></div>
  
<script type="text/javascript">

    // obtenemos el array de valores mediante la conversion a json del
    // array de php
     var arrayVariables=<?php echo json_encode($variables);?>; //arrary de mxn con los m valores de las n variables elegidas 
     var arrayFecha=<?php echo json_encode($fecha);?>;   //array de mx1 con la fecha-hora de cada medición
      var arrayNombres=<?php echo json_encode($nombres); ?>;
      var arraySensores=<?php echo json_encode($sensores); ?>;
      var arrayColores=['#72b352','#3f7b8f','#c83535','#d2cb02','#a054ae','#54a7ae','#8e6f33'];
      
      for (var j=0; j<arrayNombres.length;j++) {
      	
      
      //var j=0;
      var id='plotly-div'+j;
      
      var nombreTrace='trace'+j;
      var nombreLayout='layout'+j;
      var nombreData='data'+j;      
 
     
    var columna = [];

   for(var i=0; i<arrayVariables.length; i++){
          columna.push(arrayVariables[i][j]);
       
   }
    
  nombreTrace = {
  x:arrayFecha, 
  y:columna, 
   marker: {
   	color: arrayColores[j],
   opacity: 1, 
    line: {
    width: 0.5},
    opacity: 0.8},
  
 mode: 'lines+markers',

  type: 'scatter',
  uid: "e1f084", 
  xsrc: "wapmorgan:90:a35c75", 
  ysrc: "wapmorgan:90:89d2be"
  };
  
  //}
 
 nombreData = [nombreTrace];
 nombreLayout = {
  autosize: true, 
  //height: 400, 
  title:  arraySensores[j] + ' - '+arrayNombres[j].substring(0, arrayNombres[j].indexOf('[')),
     titlefont:{
     family: 'Old Standard TT, serif',
     color: arrayColores[j]   
    },
  
   margin: {
    l: 40,
    r: 50,
    b: 100,
    t: 100,
    pad: 1
  },
  width: 1200, 
 
 xaxis: {
  	type: 'date',
    title: 'Fecha Hora Medición',
    titlefont:{
     family: 'Old Standard TT, serif',
      size: 12,
      color: 'grey'    
    },
   showticklabels: true,
  
    tickfont: {
      family: 'Old Standard TT, serif',
      size: 11,
      color: 'grey'
    }
  
  }, 
  yaxis: {
    autorange: true, 
    range: [0, 100], 
    title:arrayNombres[j],
    titlefont:{
     family: 'Old Standard TT, serif',
      size: 12,
      color: 'grey'    
    },
     tickfont: {
      family: 'Old Standard TT, serif',
      size: 11,
      color: 'grey',
      margin:{
      pad: 15 },
    },
    type: "linear"
  }
};
document.getElementById(id).style.display = 'block';
Plotly.plot(id,nombreData, nombreLayout);
}
</script> 

 
 
 <?php
 }

 
  ?>
 
 


 
  </body>
  

        	
   
  
  
  