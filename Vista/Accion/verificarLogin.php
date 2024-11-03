<?php
include_once '../../configuracion.php';

$datosForm = data_submitted();
print_r($datosForm);
$sessionObj = new Session();
$iniciaSession = $sessionObj->iniciar($datosForm['usnombre'], $datosForm['uspass']);

/*if ($iniciaSession) {
    echo "<script>location.href = '../paginaSegura.php';</script>";
} else {
    echo "<script>location.href = '../login.php';</script>";
}*/