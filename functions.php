<?php

/********** USUARIO Y CLAVE ********/
function existeUsuario($usuario){
 $sql="SELECT nombre FROM usuario WHERE nombre='$usuario'";
 return $sql;
}

function comprobarClave($usuario,$clave){
 $sql="SELECT id, id_nivel FROM usuario WHERE nombre='$usuario' AND clave='$clave'";
 return $sql;
} 
               

/********* ESTACIONES ************/
function listarEstaciones() {
  $sql="SELECT id, nombre FROM estacion ORDER BY nombre";
  return $sql;
 }
 
function nombreEstacion($idEstacion) {
   $sql="SELECT nombre FROM estacion WHERE id='$idEstacion'";
  return $sql;
 }
 
 function intervaloEst($idEstacion) {
   $sql="SELECT intervalo FROM estacion WHERE id='$idEstacion'";
  return $sql;
 }
 
function estadoEstacion($idEstacion) {
  $sql="SELECT DATEDIFF(NOW(),(SELECT fecha_hora FROM `$idEstacion` ORDER BY fecha_hora DESC LIMIT 1))";
    return $sql; 
} 
 
 /********* VARIABLES ************/
 //Para completar la tabla - Listo las variables solo cuando el sensor está y está activado (columna $idEstacion==11)
function listarVariables($idEstacion) {
  $sql="SELECT id,nombre,sensor FROM variable WHERE `$idEstacion`=11 ORDER BY num";
       
  return $sql;
 }
 
 
 function obtenerNombre($idVariable) {
   $sql="SELECT nombre,sensor FROM variable WHERE id='$idVariable'";
  return $sql;
 }
 
  /********* DATOS ************/
   function obtenerDatos($idEstacion,$periodo,$fechaIni,$fechaFin) {
    if($periodo=='dia') {
     $sql="SELECT * FROM `$idEstacion` WHERE TIMESTAMPDIFF(HOUR,fecha_hora,NOW())<=24"; }
      elseif($periodo=='semana') {
       $sql="SELECT * FROM `$idEstacion` WHERE DATEDIFF(NOW(),fecha_hora)<=7"; }
        elseif($periodo=='mes') {
       	$sql="SELECT * FROM `$idEstacion` WHERE DATEDIFF(NOW(),fecha_hora)<=30"; }
       	 elseif($periodo=='intervalo') {
       	 	$hora=' 23:59:59';
       	 	$fechaFin=$fechaFin.$hora;
       	 
         	$sql="SELECT * FROM `$idEstacion` WHERE fecha_hora>='$fechaIni' AND fecha_hora<='$fechaFin'"; }
  return $sql;
 }
 
 /********* SENSORES ************/
function listarSensores($idEstacion) {
  $sql="SELECT id,sensor,num FROM variable WHERE `$idEstacion`=11 OR `$idEstacion`=10  GROUP BY sensor ORDER BY num";
       
  return $sql;
 } 
 
 //Obtener estado: Activado o Desactivado de un sensor o de todos si no se le pasa el id
function obtenerEstado($idSensor,$idEstacion) {
  if($idSensor!='') {  
    $sql="SELECT `$idEstacion` FROM variable WHERE id='$idSensor' AND (`$idEstacion`=11 OR `$idEstacion`=10)";}
  elseif($idSensor=='') {
  	$sql="SELECT sensor,`$idEstacion` FROM variable WHERE (`$idEstacion`=11 OR `$idEstacion`=10) GROUP BY sensor ORDER BY num";
      } 
  return $sql;
 }  
 
 function nombreSensor($idSensor){
  $sql="SELECT sensor FROM variable WHERE id='$idSensor' GROUP BY sensor";
  return $sql;
 }
 

//Obtener último dato medido para verificar funcionamiento
function ultimoDato($idSensor,$idEstacion){
  $sql="SELECT $idSensor,fecha_hora FROM `$idEstacion` ORDER BY fecha_hora DESC LIMIT 1";
  return $sql;
}
 
 
  /********* MODIFICACIONES ************/
  function modificarIntervalo($idEstacion, $intervalo){
    $sql="UPDATE estacion SET intervalo=$intervalo WHERE id=$idEstacion"; 
    return $sql;
  }
  
  function modificarSensor($idEstacion,$nombreSensor,$estado){
    $sql="UPDATE variable SET `$idEstacion`=$estado WHERE sensor='$nombreSensor'"; 
    return $sql;
  }

 function cambiaf_a_normal($fecha){ 
   	ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $fecha, $mifecha); 
   	$lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]." ".$mifecha[4].":".$mifecha[5].":".$mifecha[6]; 
   	return $lafecha; 
} 
 
  
 ?>
