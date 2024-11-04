<?php 
include_once '../../configuracion.php';

    
    $data=data_submitted();
    //print_r($data);

    $objUsuario= new AbmUsuario();
    $idusuario= ['idusuario'=>$data['idusuario']];
    $usuario=$objUsuario->buscar($idusuario);
    if(isset($usuario)){
        //print_r($usuario);
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $timestamp = date("Y-m-d H:i:s");
        $param= ['idusuario'=>$data['idusuario'],
        'usnombre'=>$usuario[0]->get_usnombre(),'uspass'=>$usuario[0]->get_uspass(),
        'usmail'=>$usuario[0]->get_usmail(),'usdeshabilitado'=>$timestamp];
        
       $m=$objUsuario->modificacion($param);

    }
   
    

  /* $DATO= ['idusuario'=>"",'usnombre'=>"Leo",'uspass'=>111,'usmail'=>"leo@gmail.com", 'usdeshabilitado'=>date("Y-m-d H:i:s")];
  $objUsuario->alta($DATO);*/
?>