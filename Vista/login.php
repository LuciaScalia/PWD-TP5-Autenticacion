<?php
$link = "";
$titulo = "Login";
include_once 'Estructura/header.php';
?>

<form name="login" id="login" method="post" enctype="multipart/form-data" action="Accion/verificarLogin.php">
  <div class="form-group">
    <label for="usnombre">Usuario</label>
    <input type="text" class="form-control" name="usnombre" id="usnombre" placeholder="Usuario" required>
  </div>
  <div class="form-group">
    <label for="uspass">Contraseña</label>
    <input type="password" class="form-control" name="uspass" id="uspass" placeholder="Contraseña" required>
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Ingresar</button>
</form>
<?php
// footer
?>

