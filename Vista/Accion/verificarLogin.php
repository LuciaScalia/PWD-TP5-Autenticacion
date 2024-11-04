<?php
include_once '../../configuracion.php';

/*if (isset($datosForm['uspass'])) {
    echo "Pass: " . htmlspecialchars($datosForm['uspass']);
    $hash = password_hash($datosForm['uspass'], PASSWORD_DEFAULT);
    echo " Hash: " . htmlspecialchars($datosForm['uspass']);
}*/

$datosForm = data_submitted();

$usuarioAbm = new AbmUsuario();
$usuario = $usuarioAbm->buscar(['usnombre' => $datosForm['usnombre']]);

if (!empty($usuario)) {
    $uspass = $usuario[0]->get_uspass();
    $resp = password_verify($datosForm['uspass'], $uspass);
    $sessionObj = new Session();
    if ($resp) {
        $sessionResp = $sessionObj->iniciar($datosForm['usnombre'], $resp);
        if ($sessionResp) {
            echo "<script>location.href = '../paginaSegura.php';</script>";
        } else {
            echo "<script>location.href = '../login.php';</script>";
        }
    }
}
