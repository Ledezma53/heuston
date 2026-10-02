<?php
require_once("../../helpers/helpers.php");
include_once("../../modelo/contact.php");
$obj_cont= new contact();



/*---- Crear ----*/

    $obj_cont->nombre=strClean($_REQUEST["nombre"]);
    $obj_cont->correo=strClean($_REQUEST["correo"]);
    $obj_cont->celular=strClean($_REQUEST["celular"]);
    $obj_cont->servicio=strClean($_REQUEST["servicio"]);
    $obj_cont->mensaje=strClean($_REQUEST["mensaje"]);

    $obj_cont->create();
    header('Location: /proyMorales/heuston/vista/contact.html');
?>