<?php
  
?>
<h1>Log In</h1>
<h2>Inicia sesion con tus datos</h2>
<?php include_once __DIR__ . '/../alertas/alertas.php';
?>
<form action="./" method="POST"><!--action="/" hace referencia que es este
 mismo archivo que el que manda el post  -->
    <fieldset class="">
        <div class="email campos">
            <label for="logEmail">Email</label>
            <input id="logEmail" name="login[email]" type="email"  placeholder="Tu email">
        </div>
        <div class="password campos">
            <label for="logPass">Password</label>
            <input id="logPass" name="login[password]" type="password"  placeholder="Tu password">
        </div>
        
    </fieldset>
    <button class="login-button btnBlue">Iniciar Sesión</button>
</form>
<div class="options">
    <a href="log/forget" class="options-msg">Olvide mi contraseña</a>
    <a href="log/create" class="options-msg">Crear Cuenta</a>
</div>
