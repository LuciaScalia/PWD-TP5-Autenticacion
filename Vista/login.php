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
  <button type="submit" class="btn btn-primary" onclick="encriptarPass()">Ingresar</button>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bcryptjs/2.4.3/bcrypt.min.js"></script>
<script>
  async function encriptarPass() {
      const pass = document.getElementById('uspass').value;
      const salt = await bcrypt.genSalt(10);
      const hash = await bcrypt.hash(pass, salt)
      document.getElementById('uspass').value = hash;
      console.log({
          pass,
          hash
      });
  }
</script>

<?php
// footer
?>

