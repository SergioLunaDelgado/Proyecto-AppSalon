<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu email a continuación</p>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

<form action="/olvide" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Tu Email">
    </div>
    <div class="centro"><input type="submit" value="Enviar instrucciones" class="boton"></div>
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta?, inicia sesión aquí</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta?, crea una aquí</a>
</div>