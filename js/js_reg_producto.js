
function listarProductos()
{
    $.get(
        "../controlador/reg_producto/list.php",
        function(data)
        {
            $("#lista_productos").html(data);
        }
    );
}
$(document).ready(function(){
    listarProductos();
});
/* ------ Crear y actualizar ------*/
$(document).on('click', '#btn_save', function() {
    
    var formulario = document.getElementById('form_producto');
    var data = new FormData(formulario);

    var strNombre = document.querySelector('#txt_producto').value;
    var strprecio = document.querySelector('#txt_precio').value;
    var strf_c = document.querySelector('#txt_f_c').value;
    var strImagen = document.querySelector('#txt_imagen').value;

    var strCat = document.querySelector('#txt_cat').value;
    var strStock = document.querySelector('#txt_stock').value;
    
    if (strNombre == '' || strprecio == '' || strf_c == '' || 
    strCat == '' || strStock == '') 
    {
        
        toastr.error("Todos los campos son obligatorios.");
        return false;
    }

    let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) { 
            if(elementsValid[i].classList.contains('is-invalid')) { 
                toastr.error("Atencion Por favor verifique los campos en rojo.");                
                return false;
            } 
        }
    
     $.ajax({
        type:'POST',
        url:'../controlador/reg_producto/accion.php',
        data:data,
        processData: false,
        contentType: false,
        success:function(data){   
            if(data.trim()=="true_create"){               
                $("#form_producto").empty();
                $("#modal-form-producto").modal("hide");
                toastr.success("Se creó el producto");
                listarProductos()
            }else if(data.trim()=="true_update"){
                $("#form_producto").empty();
                $("#modal-form-producto").modal("hide");
                toastr.success("Se actualizó el productoliado");
                listarProductos()              
            }else if(data.trim()=="incorrectos"){
                toastr.error("Por favor valide los campos los datos ingresados son incorrectos.");
            }else{
                toastr.error("No se guardaron correctamente los datos.");
            }
        }
    })
});
//mostrar listaa



/* ------Modal formulario Crear y Editar------*/

$(document).on('click', '.new-modal-producto', function() {
    var id=$(this).data("id");
    var url="../controlador/reg_producto/create.php?id="+id;

    $.get(url, function(data){
        $("#form_producto").empty();
        $("#form_producto").append(data);
        if(id>0){
            $(".title_producto").empty();
            $(".title_producto").append("Modificar producto");
        }else{
            $(".title_producto").empty();
            $(".title_producto").append("Nuevo producto");
        }
        $("#modal-form-producto").modal("show");
    })
});
/* ------ list------*/


/* ------ Activar Estado------*/


/* ------ Desactivar Estado------*/
