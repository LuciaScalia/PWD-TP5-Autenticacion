<?php
class UsuarioRol{
    private $idUsuario;
    private $idRol;
    private $mensajeOperacion;
    
    public function __construct(){
        $this->idUsuario="";
        $this->idRol="";
        $this->mensajeOperacion="";
    }   

    public function setear ($idUsuario,$idRol){
        $this->setIdUsuario($idUsuario);
        $this->setIdRol($idRol);
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario){
        $this->idUsuario=$idUsuario;
    }

    public function getIdRol(){
        return $this->idRol;
    }
    public function setIdRol($idRol){
        $this->idRol=$idRol;
    }

    public function getMensajeOperacion(){
        return $this->mensajeOperacion;
    }
    public function setMensajeOperacion($valor){
        $this->mensajeOperacion = $valor;
    }

    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql = "SELECT * FROM usuariorol WHERE idusuario = '" . $this->getIdUsuario() . "' AND idrol = " . $this->getIdRol();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>-1){
                    $row = $base->Registro();
                    $this->setear($row['idusuario'],$row['idrol']);
                    $resp=true;
                }
            }
        } else {
            $this->setMensajeOperacion("usuariorol->listar: ".$this->getError());
        }
        return $resp;   
    }

    public function insertar(){
        $resp=false;
        $base= new BaseDatos();
        $sql="INSERT INTO usuariorol (idusuario, idrol)
        VALUES ('".$this->getIdUsuario()."', '".$this->getIdRol()."')";
        if ($base->Iniciar()){
            if($elid = $base->Ejecutar($sql)){
                $this->setIdUsuario($elid);
                $resp=true;
            }else{
                $this->setMensajeOperacion("usuariorol->insertar: ".$base->getError());
            }
            return $resp;
        }else {
            $this->setMensajeOperacion("usuariorol->insertar: ".$base->getError());
        }
    }

    public function modificar(){
        $resp = false;
        $base= new BaseDatos();
        $sql = "UPDATE usuariorol 
        SET idusuario = '" . $this->getIdUsuario() . "', 
            idrol = '" . $this->getIdRol() . "' 
        WHERE idusuario = '" . $this->getIdUsuario() . "' 
          AND idrol = " . $this->getIdRol();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("usuariorol->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("usuariorol->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM usuariorol WHERE `idusuario` = '".$this->getIdUsuario()."' AND idrol = ".$this->getIdRol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeOperacion("usuariorol->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("usuariorol->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM usuariorol";
        if ($parametro!="") {
           $sql.=' WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj= new UsuarioRol();
                    $obj->setear($row['idusuario'], $row['idrol']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("usuariorol->listar: ".$base->getError());
        }
        return $arreglo;
    }
    
    
}

?>