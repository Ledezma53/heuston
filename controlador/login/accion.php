<?php
require_once("../../helpers/helpers.php");
include_once("../../modelo/login.php");
$obj_login= new login();

$obj_login->usuario= strClean($_REQUEST["usuario"]);
$obj_login->contraseña= strClean($_REQUEST["contraseña"]);

    if ($obj_login->usuario == '' || $obj_login->contraseña == '') 
    {
        echo "error_datos";
        return false;
    } else {
        $requestUser = $obj_login->loginUser();
        if (empty($requestUser)) {
            echo "datos_incorrectos";
            return false;
        } else {
            if($fila = mysqli_fetch_array($requestUser)){
                $estado = $fila['estado'];
                if ($estado == 1) {
                    session_start();
                    $_SESSION['login'] = true;
                    $_SESSION["idUser"] = $fila["id_usuario"];

                    $rs_datos = $obj_login->sesionLogin($_SESSION['idUser']);
                    if($fila = mysqli_fetch_array($rs_datos)){
                   
                    $_SESSION['usuario']=$fila['usuario'];
                    $_SESSION['contraseña']=$fila['contraseña'];
                    $_SESSION['estado']=$fila['estado'];
                    $_SESSION['id_rol']=$fila['id_rol'];
                    echo "existe";
                    die();
                    } 
                                    
                }else {
                    echo "inactivo";
                    return false;
                }
            }  
        }
        die();
    }
?>