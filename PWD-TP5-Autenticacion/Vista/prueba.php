<?php

$obj = new Session();
$obj->iniciar('Mora', 123);
$rol = $obj->getRol();
print_r($rol);