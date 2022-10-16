<h1 class="nombre-pagina">Recuperar Passowrd</h1>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

<?php if ($error) return; ?>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>
<!-- Es necesario quitar el "action" ya que si lo pongo me borrara en token en el url -->
<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Tu nuevo password">
    </div>
    <div class="centro"><input type="submit" value="Enviar instrucciones" class="boton"></div>
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta?, inicia sesión aquí</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta?, crea una aquí</a>
</div>