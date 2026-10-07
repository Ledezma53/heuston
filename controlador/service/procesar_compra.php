<?php

include_once("../../modelo/cn.php");

class procesar_compra extends cn
{
    public function procesar($data)
    {
        $conexion = $this->f_cn();
        if (!$data) {
            mysqli_close($conexion);
            return [
                'message' => 'No se recibieron datos'
            ];
        }
        foreach ($data as $item) {
            $stmt = mysqli_prepare(
                $conexion,
                 "INSERT INTO compras(id_producto, nombre_producto, precio)
                 VALUES (?, ?, ?)"
            );
            mysqli_stmt_bind_param(
                $stmt,
                "isd",
                $item['id'],
                $item['nombre'],
                $item['precio']
            );
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        mysqli_close($conexion);
        
        return ['message' => 'Compra procesada exitosamente'];
    }
}


$data = json_decode(file_get_contents('php://input'), true);

$obj = new procesar_compra();

$resultado = $obj->procesar($data);

echo json_encode($resultado);

?>
