function listarProductos()
{
    $.get(
        "../controlador/service/list.php",
        function(data)
        {
            $("#lista_productos").html(data);
        }
    );
}
$(document).ready(function(){

    listarProductos();

});