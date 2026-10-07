<?php

include_once("../../modelo/reg_producto.php");

$obj_reg_producto = new reg_producto();

$rs = $obj_reg_producto->list();

?>

<div class="row">

    <?php while($fila = mysqli_fetch_array($rs)){ ?>

        <div class="col-md-4 mb-4">

            <div class="card h-100 text-center">

                <!-- Imagen -->
                <div class="card-body">

                    <?php if($fila["imagen"] != ""){ ?>

                        <img src="../<?php echo $fila["imagen"]; ?>"
                             class="img-fluid"
                             style="width: 180px; height: 150px; object-fit: contain;">

                    <?php } else { ?>

                        <div style="width:180px; height:150px; margin:auto;">
                            Sin imagen
                        </div>

                    <?php } ?>

                    <!-- Nombre -->
                    <h5 class="card-title mt-2">
                        <?php echo $fila["nombre"]; ?>
                    </h5>

                    <!-- Precio -->
                    <p style="color:red;">
                        Precio: $<?php echo $fila["precio"]; ?>
                    </p>

                    <!-- Botón -->
                    <button type="button"
                            class="btn btn-outline-danger btn-sm btn-carrito"
                            data-id="<?php echo $fila["id_producto"]; ?>"
                            data-nombre="<?php echo htmlspecialchars($fila["nombre"]); ?>"
                            data-precio="<?php echo $fila["precio"]; ?>">

                        AÑADIR AL CARRITO

                    </button>

                </div>

            </div>

        </div>

    <?php } ?>

</div>


<!-- ========================= -->
<!-- CARRITO -->
<!-- ========================= -->

<div class="row mt-4">

    <div class="col-md-12">

        <div class="card">

            <div class="card-header">
                <h3>Tu carrito</h3>
            </div>

            <div class="card-body">

                <div id="cart-items">

                    <p>Tu carrito está vacío</p>

                </div>

                <hr>

                <h4>
                    Total: $ <span id="cart-total">0</span>
                </h4>

                <button type="button"
                        id="checkout"
                        class="btn btn-success">

                    Procesar compra

                </button>

            </div>

        </div>

    </div>

</div>
