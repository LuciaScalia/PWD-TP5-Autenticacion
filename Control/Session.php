<?php
class Session{

    public function __construct(){  
        $resp= false;
        if (session_start()) {
            $resp= true;
        }
        return $resp;
      }
   
    /**
     * Actualiza las variables de sesión con los valores ingresados.
     */
    public function iniciar($usuario, $pass) {
        $iniciado = false;
        $abmUsuario = new AbmUsuario();
        $param['usnombre'] = $usuario;
        $param['uspass'] = $pass;
        $param['usdeshabilitado'] = null;
        
        $usuario = $abmUsuario->buscar($param);
        if (!empty($usuario)) {
            $usuario = $usuario[0];
            $_SESSION['idusuario'] = $usuario->get_idusuario();
            $iniciado = true;
        } else {
            $this->cerrar();
        }
        return $iniciado;
    }

    /**
     *Devuelve true o false si la sesión está activa o no.
     */
    public function activa() {
        $sesionActiva = session_status() === PHP_SESSION_ACTIVE ? true : false;
        //$sesionActiva = session_id() === '' ? false : true;
        return $sesionActiva;
    }
    
    /**
     * Valida si la sesión actual tiene usuario y psw válidos. Devuelve true o false.
     */
    public function validar() {
        $sesionValida = $this->activa() && isset($_SESSION['idusuario']) ? true : false;
        return $sesionValida;
    }
   
    /**
     * Devuelve el usuario logeado.
     */
    public function getUsuario() {
        $usuario = [];
        if ($this->validar()) {
            $usuarioAbm = new AbmUsuario();
            $resultado = $usuarioAbm->buscar(['idusuario' => $_SESSION['idusuario']]);
            if (!empty($resultado)) {
                $usuario = $resultado[0];
            }
        }
        return $usuario;
    }

     /**
     * Devuelve el rol del usuario logeado.
     */
    public function getRol() {
        $rol = [];
        $usuario = $this->getUsuario();
        if ($this->validar() && !empty($usuario)) {
            $rolUsuarioAbm = new AbmUsuarioRol();
            $rol = $rolUsuarioAbm->buscar(['idusuario' => $usuario->get_idusuario()]);
            if (!empty($rol)) {
                $rolAbm = new AbmRol();
                $rol = $rolAbm->buscar(['idrol' => $rol[0]->getIdRol()]);
                if (!empty($rol)) {
                    $rol = $rol[0];
                }
            }
        }
        return $rol;
    }
    
    /**
     *Cierra la sesión actual.
     */
    public function cerrar(){
        $resp = true;
        session_destroy();
        return $resp;
    }
}
?>