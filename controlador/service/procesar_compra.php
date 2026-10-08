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
                'success' => false,
                'message' => 'No se recibieron datos'
            ];
        }

        // =====================================
        // GENERAR ID DE VENTA
        // =====================================

        $consulta = mysqli_query(
            $conexion,
            "SELECT IFNULL(MAX(id_venta), 0) + 1 AS nueva_venta
             FROM compras"
        );

        $fila = mysqli_fetch_assoc($consulta);

        $id_venta = $fila['nueva_venta'];


        // =====================================
        // GUARDAR PRODUCTOS
        // =====================================

        foreach ($data as $item) {

            $stmt = mysqli_prepare(
                $conexion,
                "INSERT INTO compras
                (id_venta, id_producto, nombre_producto, precio)
                VALUES (?, ?, ?, ?)"
            );

            mysqli_stmt_bind_param(
                $stmt,
                "iisd",
                $id_venta,
                $item['id'],
                $item['nombre'],
                $item['precio']
            );

            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);
        }

        mysqli_close($conexion);


        // =====================================
        // RESPUESTA
        // =====================================

        return [
            'success' => true,
            'message' => 'Compra procesada exitosamente',
            'id_venta' => $id_venta
        ];
    }
}


// =====================================
// RECIBIR JSON
// =====================================

$data = json_decode(
    file_get_contents('php://input'),
    true
);


// =====================================
// PROCESAR COMPRA
// =====================================

$obj = new procesar_compra();

$resultado = $obj->procesar($data);


// =====================================
// RESPUESTA JSON
// =====================================

header('Content-Type: application/json');

echo json_encode($resultado);

?>