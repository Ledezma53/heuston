<?php
include_once("../../modelo/reg_producto.php");
$obj_reg_producto = new reg_producto();
$rs = $obj_reg_producto->list();
?>
<table class="table table-bordered table-hover">

    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Fecha caducidad</th>
            <th>Imagen</th>
            <th>Categoría</th>
            <th>Stock</th>
            <th>Modificar</th>
        </tr>
    </thead>

    <tbody>

        <?php while($fila=mysqli_fetch_array($rs)){ ?>

        <tr>
            <td><?php echo $fila["id_producto"]; ?></td>
            <td><?php echo $fila["nombre"]; ?></td>
            <td><?php echo $fila["precio"]; ?></td>
            <td><?php echo $fila["fecha_caducidad"]; ?></td>

            <td>
                <?php if($fila["imagen"] != ""){ ?>
                    <img src="../<?php echo $fila["imagen"]; ?>"
                         width="60"
                         height="60"
                         style="object-fit:cover;">
                <?php } ?>
            </td>

            <td><?php echo $fila["categoria"]; ?></td>
            <td><?php echo $fila["stock"]; ?></td>
            <td><button data-id=<?php echo $fila["id_producto"];?>
            title="Modificar" class="btn btn-xs btn-warning new-modal-producto"><i class="far fa-edit"></i></button></td>
        </tr>

        <?php } ?>

    </tbody>

</table>