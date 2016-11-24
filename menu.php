 <link href="css/styles.css" rel="stylesheet">
 <link href="css/font-awesome.min.css" rel="stylesheet">
    
<?php


$nivelUs=$_GET['nivelUs'];

 
?>
 <?php if($nivelUs==2) { ?>
<div class="men">
<?php } ?>
<nav>
        <ul>
             <li>
                <a href="estaciones.php?nivelUs=<?php echo $nivelUs ?>">
                    Estaciones
                    
                </a>
              		
            </li>
               <li>
                <a href="">
                    Monitoreo
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul>
                  <li><a href="monitoreoDatos.php?nivelUs=<?php echo $nivelUs ?>" >Datos medidos</a></li>
                 
                  <li><a href="monitoreoEstado.php?nivelUs=<?php echo $nivelUs ?>" >Estado de los nodos</a></li>
                 </ul>
                  
               
           
				
            </li>
             <?php if($nivelUs==1) { ?>
            <li>
                <a href="gestion.php?nivelUs=<?php echo $nivelUs ?>">
                    Gestión
                  
                </a>
                
            </li>
			<?php }?>
          <?php if($nivelUs==1) { ?>
           <li>
              <a href="#"> 
                Usuario
                <i class="fa fa-angle-down"></i>
                </a>
                <ul>
                  <li><a href="cambiarClave.php?nivelUs=<?php echo $nivelUs ?>" >Cambiar contraseña</a>
                 </ul> 
           </li>
           <?php }?>
        </ul>
    </nav>
    <?php if($nivelUs==2) { ?>
    </div>
    <?php } ?>
    <br>