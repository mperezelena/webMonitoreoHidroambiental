<?php
 include("conec_db.php");
 include("functions.php");
 $link=Conection();

 $fecha=getdate();
 $fecha1=$fecha[mday].'/'.$fecha[mon].'/'.$fecha[year];
 
 $fechaIni='';
 $fechaFin='';
 
 $idEstacion=$_GET[idEstacion];
 
 $idVariables=stripslashes ($_GET[idVariables]);
 $idVariables=unserialize($idVariables);
 $count = count($idVariables);
 
 $nombreEst=$_GET[nombreEst];
 $nombreConc='Estación '.$nombreEst;
 
 $periodo=$_GET[periodo];
 
 	if($periodo=='dia') {
 		$perConc='Período: Último día';
 	}
 	elseif($periodo=='semana') {
     	$perConc='Período: Última semana';
 	}
 	elseif($periodo=='mes') {
     	$perConc='Período: Últimos treinta días';
 	}
 	elseif($periodo=='intervalo') {
 		$fechaIni=$_GET[fechaIni];
 		$fechaFin=$_GET[fechaFin];
     	$perConc='Período: '.$fechaIni.' - '.$fechaFin;

 
 	}
 	
 
 $comentarios='/***************************************************************/';
 $detalle='/******** '.$nombreConc.'  '.$perConc.' *********/';
 $fechaConc='/*********************** '.$fecha1.' ***********************/';
 
 $salto="\r\n";
 $esp=' ';
 $sep=',';

 
 
 $primFila='Fecha Hora'.$sep;
  for ($i = 0; $i < $count; $i++){
     $sql1=obtenerNombre($idVariables[$i]);
 	  $result1= mysql_query($sql1,$link); 
 	  $nombre=mysql_result($result1,0,0);
 	  $sensor=mysql_result($result1,0,1);
 	  $primFila.=$nombre.' - '.$sensor.$sep;
 	  
 	 
}  

$primFila.=$salto;

$filename='datos_estacion'.$nombreEst.'.csv';

$fp = fopen('php://output', 'w');
if ($fp ) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fwrite ($fp, $headers);
    fwrite($fp, $comentarios.$salto.$fechaConc.$salto.$detalle.$salto.$comentarios);
    fwrite ($fp, $salto);
    fwrite ($fp, $salto);
    fwrite ($fp, $primFila);
    
    $sql=obtenerDatos($idEstacion,$periodo,$fechaIni,$fechaFin);
 	 $result= mysql_query($sql,$link);
 	  while($row = mysql_fetch_array($result)){
 	  	$fechaFormat=cambiaf_a_normal($row["fecha_hora"]);
 	  	fwrite($fp,$fechaFormat.$sep);
 	  	  for ($i = 0; $i < $count; $i++){ 
 	  	   fwrite($fp,$row[$idVariables[$i]].$sep);
 	     }
 	    fwrite ($fp, $salto);
 	   
 	
}  
  
   
}

?>