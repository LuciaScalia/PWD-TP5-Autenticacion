<?php

class Usuario {
    private $idusuario;
    private $usnombre;
    private $uspass;
    private $usmail;
    private $usdeshabilitado;
    private $mensaje_operacion;

    public function __construct() {
        $this->idusuario = "";
        $this->usnombre = "";
        $this->uspass = "";
        $this->usmail = "";
        $this->usdeshabilitado = "";
    }

    public function setear($idusuario, $usnombre, $uspass, $usmail, $usdeshabilitado) {
        $this->set_idusuario($idusuario);
        $this->set_usnombre($usnombre);
        $this->set_uspass($uspass);
        $this->set_usmail($usmail);
        $this->set_usdeshabilitado($usdeshabilitado);
    }

    public function get_idusuario() {
        return $this->idusuario;
    }
    public function get_usnombre() {
        return $this->usnombre;
    }
    public function get_uspass() {
        return $this->uspass;
    }
    public function get_usmail() {
        return $this->usmail;
    }
    public function get_usdeshabilitado() {
        return $this->usdeshabilitado;
    }
    public function get_mensajeoperacion(){
        return $this->mensaje_operacion;
    }

    public function set_idusuario($idusuario) {
        $this->idusuario = $idusuario;
    }
    public function set_usnombre($usnombre) {
        $this->usnombre= $usnombre;
    }
    public function set_uspass($uspass) {
        $this->uspass = $uspass;
    }
    public function set_usmail($usmail) {
        $this->usmail = $usmail;
    }
    public function set_usdeshabilitado($usdeshabilitado) {
        $this->usdeshabilitado = $usdeshabilitado;
    }
    public function set_mensajeoperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM usuario WHERE idusuario = '".$this->get_idusuario()."'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>-1){
                    $row = $base->Registro();
                    $this->setear($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usmail'], $row['usdeshabilitado']);
                    //$resp = true;
                }
            }
        } else {
            $this->set_mensajeoperacion("usuario->listar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO usuario(`idusuario`, `usnombre`, `uspass`, `usmail`, `usdeshabilitado`) 
              VALUES('".$this->get_idusuario()."', '".$this->get_usnombre()."', '".$this->get_uspass()."', '".$this->get_usmail()."', '".$this->get_usdeshabilitado()."');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->set_mensajeoperacion("usuario->insertar: ".$base->getError());
            }
        } else {
            $this->set_mensajeoperacion("usuario->insertar: ".$base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base= new BaseDatos();
        $sql = "UPDATE usuario SET `usnombre` = '".$this->get_usnombre()."', `uspass` = '".$this->get_uspass()."', 
        `usmail` = '".$this->get_usmail()."', `usdeshabilitado` = '".$this->get_usdeshabilitado()."'
        WHERE `idusuario` = '".$this->get_idusuario()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->set_mensajeoperacion("usuario->modificar: ".$base->getError());
            }
        } else {
            $this->set_mensajeoperacion("usuario->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM usuario WHERE `idusuario` = '".$this->get_idusuario()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->set_mensajeoperacion("usuario->eliminar: ".$base->getError());
            }
        } else {
            $this->set_mensajeoperacion("usuario->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM usuario";
        if ($parametro!="") {
           $sql.=' WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj= new usuario();
                    $obj->setear($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usmail'], $row['usdeshabilitado']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->set_mensajeoperacion("usuario->listar: ".$base->getError());
        }
        return $arreglo;
    }
}