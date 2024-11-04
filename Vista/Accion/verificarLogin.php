<?php
include_once '../../configuracion.php';

$datosForm = data_submitted();

if (isset($datosForm['uspass'])) {
    echo "Pass: " . htmlspecialchars($datosForm['uspass']);
    $hash = password_hash($datosForm['uspass'], PASSWORD_DEFAULT);
    echo " Hash: " . htmlspecialchars($datosForm['uspass']);
}
/*$usuarioAbm = new AbmUsuario();
$usuario = $usuarioAbm->buscar(['usnombre' => $datosForm['usnombre']]);
$sessionObj = new Session();
$iniciaSession = $sessionObj->iniciar($datosForm['usnombre'], password_verify($usuario[0]->get_uspass(), $hash));*/

if ($iniciaSession) {
    echo "<script>location.href = '../paginaSegura.php';</script>";
} else {
    echo "<script>location.href = '../login.php';</script>";
}