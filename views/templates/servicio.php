<?php 

?>
<form method="POST" action="">
    <div class="campo">
        <label for="producto" >Servicio</label>
        <input value="<?php echo $servicio->nombre ?? ''?>" placeholder="Nombre del Servicio" max="2" name="nombre" class="servicio-input" id="producto" type="text">
    </div>
    <div class="campo">
        <label for="precio">Precio</label>
        <input value="<?php echo $servicio->precio ?? ''?>" placeholder="Precio del Servicio" type="number" max="10000" name="precio" class="servicio-input" id="precio" type="text">
    </div>
    