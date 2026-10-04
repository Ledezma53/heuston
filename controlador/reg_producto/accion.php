<?php
   require_once("../../helpers/helpers.php");

   include_once("../../modelo/reg_producto.php");
    $obj_reg_producto= new reg_producto();
        /*---- Activar y desactivar Estado ----$_SESSION["idUser"]*/

          

         /*---- Crear y actualizar marca comercial ----*/
         if($_REQUEST["id"]>0){
                $obj_reg_producto->id_producto=intval($_REQUEST["id"]);
               $obj_reg_producto->consult();
               $obj_reg_producto->nombre=strClean($_REQUEST["txt_producto"]);
               $obj_reg_producto->precio=strClean($_REQUEST["txt_precio"]);
               $obj_reg_producto->fecha_caducidad=strClean($_REQUEST["txt_f_c"]);                           
               $obj_reg_producto->categoria=strClean($_REQUEST["txt_cat"]);
               $obj_reg_producto->stock=strClean($_REQUEST["txt_stock"]);
               
                 
               if (isset($_FILES["txt_imagen"]) && $_FILES["txt_imagen"]["error"] == 0) {

                    $nombre_imagen = $_FILES["txt_imagen"]["name"];
                    $tmp_imagen = $_FILES["txt_imagen"]["tmp_name"];

                    $extension = pathinfo($nombre_imagen, PATHINFO_EXTENSION);
                    $nuevo_nombre = uniqid("producto_") . "." . $extension;

                    $carpeta = "../../archivo/imagenes/";

                    if (!is_dir($carpeta)) {
                        mkdir($carpeta, 0777, true);
                    }

                    move_uploaded_file($tmp_imagen, $carpeta . $nuevo_nombre);

                    $obj_reg_producto->imagen = "archivo/imagenes/" . $nuevo_nombre;
                }

               if ($obj_reg_producto->nombre == '' ) {
                echo "error_datos";
                return false;
               }else{
                   $obj_reg_producto->update();
                   echo "true_update";
                   die();
               }
          }else{
                $obj_reg_producto->nombre=strClean($_REQUEST["txt_producto"]);
                $obj_reg_producto->precio=strClean($_REQUEST["txt_precio"]);
                $obj_reg_producto->fecha_caducidad=strClean($_REQUEST["txt_f_c"]);             
                $obj_reg_producto->categoria=strClean($_REQUEST["txt_cat"]);
                $obj_reg_producto->stock=strClean($_REQUEST["txt_stock"]);
                // Imagen
                if (isset($_FILES["txt_imagen"]) && $_FILES["txt_imagen"]["error"] == 0) {

                    $nombre_imagen = $_FILES["txt_imagen"]["name"];
                    $tmp_imagen = $_FILES["txt_imagen"]["tmp_name"];

                    $extension = pathinfo($nombre_imagen, PATHINFO_EXTENSION);
                    $nuevo_nombre = uniqid("producto_") . "." . $extension;

                    $carpeta = "../../archivo/imagenes/";

                    if (!is_dir($carpeta)) {
                        mkdir($carpeta, 0777, true);
                    }

                    move_uploaded_file($tmp_imagen, $carpeta . $nuevo_nombre);

                    $obj_reg_producto->imagen = "archivo/imagenes/" . $nuevo_nombre;
                } else {
                    $obj_reg_producto->imagen = "";
                }
               if ($obj_reg_producto->nombre == '') {
                        echo "error_datos";
               } else {
                   $obj_reg_producto->create(); 
                   echo "true_create"; 
                   
               }

                die();
         }

?>