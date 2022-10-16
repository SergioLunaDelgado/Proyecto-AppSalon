<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

<form action="/" method="POST" class="formulario">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Tu Email" name="email" value="<?php echo s($auth->email); ?>">
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Tu Password" name="password">
    </div>
    <div class="centro"><input type="submit" value="Iniciar Sesión" class="boton"></div>
</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes una cuenta?, crea una aquí</a>
    <a href="/olvide">¿Olvidaste tu password?</a>
</div>