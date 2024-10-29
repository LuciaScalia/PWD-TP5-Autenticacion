<?php

class Rol {
    private $idrol;
    private $rodescripcion;
    private $mensaje_operacion;

    public function __construct() {
        $this->idrol = "";
        $this->rodescripcion = "";
    }

    public function setear($idrol, $rodescripcion) {
        $this->set_idrol($idrol);
        $this->set_rodescripcion($rodescripcion);
    }

    public function get_idrol() {
        return $this->idrol;
    }
    public function get_rodescripcion() {
        return $this->rodescripcion;
    }
    public function get_mensajeoperacion() {
        return $this->mensaje_operacion;
    }

    public function set_idrol($idrol) {
        $this->idrol = $idrol;
    }
    public function set_rodescripcion($rodescripcion) {
        $this->rodescripcion = $rodescripcion;
    }
    public function set_mensajeoperacion($mensaje_operacion) {
        $this->mensaje_operacion = $mensaje_operacion;
    }

    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM rol WHERE idrol = '".$this->get_idrol()."'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>-1){
                    $row = $base->Registro();
                    $this->setear($row['idrol'], $row['rodescripcion']);
                    //$resp = true;
                }
            }
        } else {
            $this->set_mensajeoperacion("rol->listar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO rol(`idrol`, `rodescripcion`) 
              VALUES('".$this->get_idrol()."', '".$this->get_rodescripcion()."'";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->set_mensajeoperacion("rol->insertar: ".$base->getError());
            }
        } else {
            $this->set_mensajeoperacion("rol->insertar: ".$base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base= new BaseDatos();
        $sql = "UPDATE rol SET `rodescripcion` = '".$this->get_usnombre()."' WHERE `idrol` = '".$this->get_idrol()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->set_mensajeoperacion("rol->modificar: ".$base->getError());
            }
        } else {
            $this->set_mensajeoperacion("rol->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM rol WHERE `idrol` = '".$this->get_idrol()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->set_mensajeoperacion("rol->eliminar: ".$base->getError());
            }
        } else {
            $this->set_mensajeoperacion("rol->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM rol";
        if ($parametro!="") {
           $sql.=' WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj= new Rol();
                    $obj->setear($row['idrol'], $row['rodescripcion']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->set_mensajeoperacion("rol->listar: ".$base->getError());
        }
        return $arreglo;
    }
}