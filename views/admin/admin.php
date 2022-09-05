<?php include_once __DIR__ . '/../templates/cierreSesion.php'  ;
$url='http://localhost:3000/admin?fecha=2022-09-12';
// debuguear(parse_url($url));
$msg=$_GET['msg'] ?? '';
if($msg=='created'):?>
    <p class="alerta correcto"><?php echo "Servicio creado con éxito" ?></p>
<?php endif;?>
<h2 class="">Panel de Administracion</h1>
<h3>Buscar citas</h3>

            <div class="campos">
                <label  for="fecha">Fecha</label>
                <input value="<?php echo $date?>" name=fecha  id="fecha" class="cita-fecha" type="date" >
            </div>       
            <?php if($msg=='deleted'):?>
                <p class="alerta errores"><?php echo "Fecha del {$date} eliminada" ?></p>
            <?php endif;?>
           
            <!-- <input type="hidden" class="cita-id" value=""> -->

<?php foreach($alertas as $alerta=>$msg):

    foreach($msg as $message): ?>
        <p class="alerta <?php echo $alerta ?>"><?php echo $message ?></p>
    <?php endforeach; ?>
<?php endforeach;?>
<div class="citas-admin">
    
        <?php  $idCita='';
        $total=false;  
        foreach($fechas as $key=>$fecha):
            
        ?>
       
            <?php    if($idCita!==$fecha->id):
                        $total=0
            ?>
                <ul>
                 <form action="api/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $fecha->id ?>">
                    <button class="boton-eliminar" type="submit">x</button>
                 </form>
                    <p>Cliente</p>
                    <li> <span>Id:</span> <?php echo $fecha->id?></li>
                    <li> <span>Hora:</span> <?php echo $fecha->hora?></li>
                    <li><span>Nombre:</span> <?php echo $fecha->nombreCompleto?></li>
                    <li><span>Tel:</span> <?php echo $fecha->telefono?></li>
                    <p>Servicios</p>
                    
                    <?php $total=0; endif; ?>
                
                </ul>
            <?php $idCita=$fecha->id; 
           ?>
           
                <ul class="listas">
                    
                    <li><span>Servicio:</span> <?php echo $fecha->servicio?></li>
                    <li><span>Precio:</span> <?php echo $fecha->precio?></li> <br>
                   
                </ul>
                
            
              
        <?php 
         $total=$total + $fecha->precio;
        
         $actual=$fecha->id;
         $proximo=$fechas[$key + 1]->id ?? 0;
         if($actual!==$proximo):
        ?>
            <p class="total"><span>Total: </span>$<?php echo $total  ?></p>
         <?php endif;?>
         <?php endforeach;?>
          
        <script src="public/build/js/buscador.js"></script>
</div>