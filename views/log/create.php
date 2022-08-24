<div class="back">
    <a href="../"><</a>
</div>
<h1>Crea tu cuenta</h1>
<h3>Complete the brackets to finally achieve your an account </h3>

<?php include_once __DIR__ . '/../alertas/alertas.php'?>
    
<form action="./create" method="POST"> 
    <!-- NECESITO QUE EL ACTION SEA ESTE MISMO ARCHIVO ASI ENVIA 
LO SOLICITUD A ESTE MISMO Y SE ACTIVA EL POST -->
    <div class="campos">
        <label for="nombre">Nombre</label>
        <input placeholder="Your name" value="<?php echo s($usuarios->nombre) ?? ''?>" name="account[nombre]" id="nombre" type="text"  >
    </div>
    <div class="campos">
        <label for="apellido">Apellido</label>
        <input placeholder="Your surname" value="<?php echo s($usuarios->apellido) ?? ''?>" name="account[apellido]" id="apellido" type="text"  >
    </div>
    <div class="campos">
        <label for="tel">Telefono</label>
        <input placeholder="Your phone number" value="<?php echo s($usuarios->telefono) ?? ''?>" name="account[telefono]" id="tel" type="number"  >
    </div>
    <div class="campos">
        <label for="email">Email</label>
        <input placeholder="Your Email" value="<?php echo s($usuarios->email) ?? ''?>" name="account[email]" id="email" type="email"  >
    </div>
    <div class="campos">
        <label for="pass">Password</label>
        <input placeholder="Create a Password" value="" name="account[password]" id="pass" type="password"  >
    </div>
    
    
    <button class="login-button btnBlue">Crear Cuenta</button>
</form>
<div class="options">
    <a href="../" class="options-msg">¿Tienes una cuenta? Inicia Sesión</a>
    <a href="forget" class="options-msg">Olvide mi Password</a>
</div>