<a href="/App-salon/public/log/logout" class="options-msg">Cerrar Sesion</a>
<h1>Bienvenido <?php echo $nombre ?? ''?> </h1>
<?php if($_SESSION['admin']):?>
    <div class="barra-servicios">
          <a class="btnBlue" href="/admin">Ver Citas</a>
        <a class="btnBlue" href="admin/verServicios">Ver Servicios</a>
        <a class="btnBlue" href="/admin/crearServicios">Nuevo Servicios</a>
       
    </div>

<?php endif;?>
    
