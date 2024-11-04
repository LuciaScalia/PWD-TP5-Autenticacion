<?php 
include_once '../configuracion.php';

$obj= new AbmUsuario();
$param="";
$usuarios=$obj->buscar($param);
echo "
<div class='container d-flex justify-content-center'>
    <div  class='col-md-10'><br>
        <div class='d-flex justify-content-center'>
            <h3>Todos los usuarios</h3>
        </div>
        <div class='d-flex justify-content-center'>
            <table border='1' class='table table-sm text-center table-bordered'>
                <tr>
                    <th>Nombre de usuario</th>
                    <th>Contraseña</th>
                    <th>Mail</th>
                </tr>
                <tr>";

                    foreach($usuarios as $usuario) {
                        echo "<tr class='table-active text-black'>";
                        echo    "<td class='bg-success'>" . $usuario->get_usnombre();
                        echo    "<td class='table-success'>" . $usuario->get_uspass();
                        echo    "<td class='table-success'>" . $usuario->get_usmail();
                        echo "<td class='table-success'>";
                        echo "<a href='Accion/actualizarLogin.php?idusuario=" . $usuario->get_idusuario() . "'>Actualizar</a> ";
                        echo "<a href='Accion/eliminarLogin.php?idusuario=" . $usuario->get_idusuario() . "' onclick='return confirm(\"¿Estás seguro de que quieres eliminar este usuario?\");'>Eliminar</a>";
                        echo "</td>";
                        echo "</tr>";
                    
                    }
                
            echo "</tr>
            </table>
        </div>
    </div>
</div>";



?>