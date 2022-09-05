<?php 

    if(!$auth){
        header('Location: ./');
    }
  include_once __DIR__ . '/../templates/cierreSesion.php'  
?>
<h2>Reserva una cita en estos dias</h2>
        <p class="text-center">Choose as your desire</p>
<div class="app" >
    <nav class="tabs" > <!-- data-paso -> atributo personalizado ya que tiene un guion -->
        <button class="actual"  type="button" data-paso="1">Servicios </button>
        <button type="button"  data-paso="2">Informacion</button>
        <button type="button"  data-paso="3">Resumen </button>
    </nav>
<!-- PARTE 1 -->
<div class="gigaconteiner">
    <div class="mostrar ocultar seccion" id="paso-1">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios</p>
        <div id="servicios"  class="listado-servicios"></div>
      
    </div>
<!-- PARTE 2 -->
    <div class="ocultar seccion" id="paso-2">
        <h2>Tus datos y cita</h2>
        <p class="text-center">Coloca tus datos y fecha de la cita</p>
        <p class="alerta errores msg-cerrado"> </p>
        <form action="" class="form">
            <div class="campos">
                <label for="nombre">Nombre</label>
                <input class="menu-name cita-cliente" disabled type="text" value="<?php echo $auth['nombre'] ?? "" ?>" placeholder="Your Name" name="" id="nombre">
            </div>
            
            <div class="campos">
                <label for="fecha">Fecha</label>
                <input class="cita-fecha" type="date" 
                min="<?php echo date('Y-m-d', strtotime('+1 day'))?>" 
                max="<?php echo date('Y-m-d', strtotime('+6 month'))?>" id="fecha">
            </div>       
            
            <div class="campos">
                <label for="hour">Hora</label>
                <input class="cita-hour" min="8:00:00" type="time" id="hour">
            </div>       
            <input type="hidden" class="cita-id" value="<?php echo $id ?>">
        </form>
    </div>
<!-- PARTE 3 -->
    <div class="ocultar seccion resumen-cont" id="paso-3">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la informacion sea la correcta</p>
        <div class="resumen">
          
        </div>
        <div class="resumenDatos">

        </div>
    </div>
    </div>
    <div class="paginacion">
        <button class="arrows left ocultar"> &laquo; Anterior</button>
        <button class="arrows right">Posterior &raquo; </button>
    </div>
    
</div>
<script src="public/build/js/app.js"></script> 
<?php $script='<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

';
echo $script;
// Asi agreamos los script en la pagina que queramos 