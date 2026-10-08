<?php

include_once("../../modelo/cn.php");

require_once "../../vendor/autoload.php";

use Dompdf\Dompdf;

// =====================================
// RECIBIR ID DE VENTA
// =====================================

$id_venta = $_GET["id_venta"] ?? 0;

if ($id_venta == 0) {
    die("No se recibió el número de venta");
}


// =====================================
// CONEXIÓN A LA BASE DE DATOS
// =====================================

$obj = new cn();

$conexion = $obj->f_cn();


// =====================================
// CONSULTAR PRODUCTOS DE LA VENTA
// =====================================

$sql = "SELECT *
        FROM compras
        WHERE id_venta = ?";

$stmt = mysqli_prepare($conexion, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id_venta
);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);


// =====================================
// VERIFICAR SI EXISTEN PRODUCTOS
// =====================================

if (mysqli_num_rows($resultado) == 0) {

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);

    die("No se encontraron productos para esta venta");
}


// =====================================
// CREAR HTML DEL PDF
// =====================================

$html = '

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<style>

    body {
        font-family: Arial, sans-serif;
        margin: 40px;
    }

    h1 {
        text-align: center;
        margin-bottom: 5px;
    }

    .titulo {
        text-align: center;
        font-size: 20px;
        margin-bottom: 20px;
    }

    .datos {
        margin-bottom: 20px;
        font-size: 14px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background-color: #eeeeee;
        border: 1px solid #000;
        padding: 8px;
    }

    td {
        border: 1px solid #000;
        padding: 8px;
    }

    .total {
        text-align: right;
        font-size: 18px;
        font-weight: bold;
        margin-top: 20px;
    }

    .gracias {
        text-align: center;
        margin-top: 40px;
    }

</style>

</head>

<body>

<h1>HEUSTON</h1>

<div class="titulo">
    REPORTE DE VENTA
</div>

<div class="datos">

    <strong>Número de venta:</strong>
    ' . $id_venta . '

    <br>

    <strong>Fecha:</strong>
    ' . date("d/m/Y H:i:s") . '

</div>

<table>

<thead>

<tr>

    <th>Producto</th>
    <th>Precio</th>

</tr>

</thead>

<tbody>
';


// =====================================
// MOSTRAR PRODUCTOS
// =====================================

$total = 0;

while ($fila = mysqli_fetch_assoc($resultado)) {

    $nombre = htmlspecialchars($fila["nombre_producto"]);

    $precio = $fila["precio"];

    $total += $precio;

    $html .= '

    <tr>

        <td>
            ' . $nombre . '
        </td>

        <td>
            Bs. ' . number_format($precio, 2) . '
        </td>

    </tr>

    ';
}


// =====================================
// TOTAL
// =====================================

$html .= '

</tbody>

</table>

<div class="total">

    TOTAL: Bs. ' . number_format($total, 2) . '

</div>

<div class="gracias">

    ¡Gracias por su compra!

</div>

</body>

</html>

';


// =====================================
// CERRAR CONEXIÓN
// =====================================

mysqli_stmt_close($stmt);

mysqli_close($conexion);


// =====================================
// CREAR PDF
// =====================================

$dompdf = new Dompdf();

$dompdf->loadHtml($html);

$dompdf->setPaper("A4", "portrait");

$dompdf->render();


// =====================================
// MOSTRAR PDF
// =====================================

$dompdf->stream(
    "venta_" . $id_venta . ".pdf",
    [
        "Attachment" => false
    ]
);

?>