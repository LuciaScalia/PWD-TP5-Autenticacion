<?php 
include_once '../../configuracion.php';

    
    $data=data_submitted();

    $objUsuario= new AbmUsuario();
    $idusuario= ['idusuario'=>$data['idusuario']];
    $usuario=$objUsuario->buscar($idusuario);
    if(isset($usuario)){

        echo "<div class='container d-flex justify-content-center'>
            <div class='col-md-5'>
            <br>
            <div class='d-flex justify-content-center'>
                <h3>Actualizar datos</h3>
            </div>
            <div>
                <form name='formActualizarLogin' id='formActualizarLogin' method='post' action='' enctype='multipart/form-data'>
                    <label class='form-label' for='usnombre'>Nombre de usuario: </label>
                    <input class='form-control' type='text' name='usnombre' id='usnombre' required value=".$usuario[0]->get_usnombre()."><br>
                    
                    <label class='form-label' for='uspass'>Contraseña</label>
                    <input class='form-control' type='password' name='uspass' id='uspass' required value=".$usuario[0]->get_uspass()."><br>
                    
                    <label class='form-label' for='usmail'>Mail: </label>
                    <input class='form-control' type='text' name='usmail' id='usmail' required value=".$usuario[0]->get_usmail()."><br>
                    
                
                    <input type='hidden' name='idusuario' id='idusuario' value=".$usuario[0]->get_idusuario().">
                    <input type='hidden' name='usdeshabilitado' id='usdeshabilitado' value=".$usuario[0]->get_usdeshabilitado().">

                    <div class='d-flex justify-content-center'>
                        <input type='submit' value='Aceptar' class='btn btn-success col-md-5'>
                    </div>
                </form>
            </div>
        </div>
    </div><br>
    ";
    $datos=data_submitted();
    print_r($datos);
    $objUsuario->modificacion($datos);
    } 
?>