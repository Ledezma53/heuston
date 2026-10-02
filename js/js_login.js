/* ------ Login ------*/
$(document).on('click', '#btn_iniciar', function(){
    
    var data=$('#form_login').serialize();
    
/*
    var strUsuario = document.querySelector('#usuario').value;
    var strPassword = document.querySelector('#password').value;

    if (strUsuario == '' || strPassword == '') 
    {
        toastr.error("Todos los campos son obligatorios.");
        return false;
    }   */
    $.ajax({
        type:'POST',
        url:"../controlador/login/accion.php",
        data:data, 
        success:function(data){
            alert(data.trim());
            if(data.trim()=="existe"){               
                window.location.replace('../vista/reg_producto.php');                
            }else if(data.trim()=="error_datos"){
                toastr.error("Datos vacios.");
            }else if(data.trim()=="inactivo"){
                toastr.error("Su usuario esta inactivo por favor comuniquese con un administrador.");
            }else{
                toastr.error("El usuario o contraseña son incorrectoooos.");
                document.querySelector('#contraseña').value = "";
            }
        } 
    })
});
