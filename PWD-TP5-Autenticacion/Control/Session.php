<?php
//$_SESSION — Variables de sesión
class Session {
    
    public function __construct() {
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function iniciar($usuario, $pass) {
        $_SESSION['usnombre'] = $usuario;
        $_SESSION['uspass'] = $pass;
    }

    public function validar() {
        $sesionValida = isset($_SESSION['usnombre']) && isset($_SESSION['uspass']) ? true : false;
        return $sesionValida;
    }

    public function activa() {
        $sesionActiva = $this->validar() && session_status() === PHP_SESSION_ACTIVE ? true : false;
        return $sesionActiva;
    }

    public function getUsuario() {
        $usuario = null;
        if ($this->activa()) {
            $usuarioAbm = new AbmUsuario();
            $usuario = $usuarioAbm->buscar(['usnombre' => $_SESSION['usnombre']]);
        }
        return $usuario;
    }

    public function getRol() {
        $usuario = $this->getUsuario();
        $rol = null;
        if (!empty($usuario)) {
            $rolUsuarioAbm = new AbmUsuarioRol();
            $rol = $rolUsuarioAbm->buscar(['idusuario' => $usuario['idusuario']]);
            if (!empty($rol)) {
                $rolAbm = new AbmRol();
                $rol = $rolAbm->buscar(['idrol' => $rolUsuarioAbm['idrol']]);
            }
        }
        return $rol;
    }

    public function cerrar() {
        //actualizar usdeshabilitado(? // eso sería para el borrado lógico
        session_unset();
        session_destroy();
    }
}