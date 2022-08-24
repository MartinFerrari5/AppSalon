<?php ?> 
<h2>Restablezca su password</h2>
<?php include_once __DIR__ . '/../alertas/alertas.php';
if($error) return null; ?>
<form  method="POST"> 
    <!-- NO LE AGREGO UN ACTION PORQUE ME ELIMINIARIA EL TOKEN
DE LA URL (?tokne=65f58df28f8d2f) Y PERDERIA ESA REFERENCIA -->
<div class="campos">
        <label for="pass" >Password</label>
        <input placeholder="Your New Password"
         type="password"  id="pass" name="password">
</div>
<!-- <div class="campos">
<label for="passRepeated" >Password Repeated</label>
        <input placeholder="Repeat your Password" type="password"  id="passRepeated" name="passwordRepeated">
</div> -->
    <button class="login-button btnBlue">Restaurar Password</button>
</form>
<div class="options">
    <a class="options-msg" href="../">¿Tienes una cuenta? Inicia Sesión</a>
    <a class="options-msg" href="../log/create">Crea una cuenta</a>
</div>