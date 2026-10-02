<?php
include_once("../../modelo/reg_producto.php");
$obj_reg_producto= new reg_producto();
$obj_reg_producto->id_producto=$_REQUEST["id"];
$obj_reg_producto->consult();

?>
<div class="row">
    <input type="hidden" name="id" value="<?php echo $obj_reg_producto->id_producto; ?>">
    <div class="col-4">
        <label for="txt_reg_producto">Nombre de producto <i class="text-danger" title="Ingrese Nombre deproducto">*</i></label>
        <label class="text-danger msj_txt_reg_producto"></label>  
        <div class="input-group mb-2">
            <div class="input-group-prepend ">
            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
            </div>
            <input type="text" class="form-control valid validText" id="txt_producto" name="txt_producto" value="<?php echo $obj_reg_producto->nombre; ?>"/>
        </div>
    </div>


    <div class="col-4">
        <label for="txt_precio">PRECIO <i class="text-danger" title="Ingrese Nombre de precio">*</i></label>
        <label class="text-danger msj_txt_precio"></label>  
        <div class="input-group mb-2">
            <div class="input-group-prepend ">
            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
            </div>
            <input type="number" step="0.01" class="form-control valid validNumberD" id="txt_precio" name="txt_precio" value="<?php echo $obj_reg_producto->precio; ?>"/>
        </div>
    </div>

    <div class="col-4">
        <label for="txt_f_c">Fecha de caducidad<i class="text-danger" title="Ingrese una fecha de vencimiento">*</i></label>
        <label class="text-danger msj_txt_f_c"></label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-align-left"></i></span>
            </div>
            <?php if($_REQUEST["id"]>0){?>                       
            <input type="text" class="form-control valid ValidTextSpecial"  id="txt_f_c" name="txt_f_c" 
            value="<?php echo  date('Y-m-d',strtotime($obj_reg_producto->fecha_caducidad));?>"/>                          
            <?php }else{?>
            <input type="text" class="form-control valid ValidTextSpecial"  id="txt_f_c" name="txt_f_c" 
            value="<?php echo date('Y-m-d');?>"/>
            <?php }?>
        </div>
    </div>
    <div class="col-4">
        <label for="txt_imagen">Imagen del producto<i class="text-danger" title="Ingrese imagen">*</i>
        </label><label class="text-danger msj_txt_imagen"></label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-image"></i></span>
            </div>
            <input type="file" class="form-control" id="txt_imagen" 
            name="txt_imagen" accept="image/*">

        </div>
    </div>
    <div class="col-4">
        <label for="txt_cat"> Categoria <i class="text-danger" title="Ingrese Nombre de categoria">*</i></label>
        <label class="text-danger msj_txt_cat"></label>  
        <div class="input-group mb-2">
            <div class="input-group-prepend ">
            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
            </div>
            <input type="text" class="form-control valid validText" id="txt_cat" name="txt_cat" 
            value="<?php echo $obj_reg_producto->categoria; ?>"/>
        </div>
    </div>
    <div class="col-4">
        <label for="txt_stock"> stock <i class="text-danger" title="Ingrese Nombre de stock">*</i></label>
        <label class="text-danger msj_txt_stock"></label>  
        <div class="input-group mb-2">
            <div class="input-group-prepend ">
            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
            </div>
            <input type="number" class="form-control valid validNumber" id="txt_stock" name="txt_stock" 
            value="<?php echo $obj_reg_producto->stock; ?>"/>
        </div>
    </div>

</div>
<script src="../js/valid.js"></script>
<script>
    $('#txt_f_c').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),10),
    maxDate:moment(),
    locale: {
      format: 'YYYY-MM-DD',
    }
  });
    fntValidText();
    fntValidNumber();
    fntValidNumberDecimal();

</script>