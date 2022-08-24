<div class="back">
    <a href="../"><</a>
</div>
<?php include_once __DIR__ . '/../alertas/alertas.php';
?>
<h1>Restaurar contraseña</h1>
<h3>Complete the brackets to recover your password</h3>
<form action="./forget" method="POST">
    <div class="campos">
        <label for="Email" >Email</label>
        <input placeholder="Your Email" type="email"  id="Email" name="email">
    </div>
    <button class="login-button btnBlue">Restaurar Password</button>
</form>
<div class="options">
    <a class="options-msg" href="../">¿Tienes una cuenta? Inicia Sesión</a>
    <a class="options-msg" href="create">Crea una cuenta</a>
</div>