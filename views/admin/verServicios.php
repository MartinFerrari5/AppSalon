<?php include_once __DIR__ . '/../templates/cierreSesion.php' ;
$msg=$_GET['msg'] ?? '';
if($msg=='deleted'):?>
    <p class="alerta errores"><?php echo "Servicio Eliminado" ?></p>
<?php elseif($msg=='created'):?>
    <p class="alerta correcto"><?php echo "Servicio Actualizado" ?></p>
<?php endif; ?>
<h1>Elimina o actualiza un servicio</h1>
<div class="serviceContainer">
    <?php foreach($servicios as $servicio):?>
    <div class="servicio admin">
        
        <p class="producto"><?php echo $servicio->nombre ?></p>
        <p class="precio"><?php echo $servicio->precio ?></p>
        <form class="form-servicios" action="api/editarServicio" method="POST">
            <input type="hidden" name="id" value="<?php echo $servicio->id ?>">
            <button class="btnRed" name="boton" value="eliminar" type="submit">Eliminar</button>
            <button class="btnGreen" name="boton" value="actualizar" type="submit">Actualizar</button>
        </form>
    </div>
    <?php endforeach;?>
</div>
