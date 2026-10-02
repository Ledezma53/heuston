<?php
include_once("cn.php");
class contact extends cn{

    var $id_contactos;
    var $nombre;
    var $correo;
    var $celular;
    var $servicio;
    var $mensaje;
    

    public function create()
    {
        $query="INSERT INTO contactos VALUES(0,'$this->nombre','$this->correo','$this->celular',
        '$this->servicio','$this->mensaje')";
        $rs=mysqli_query($this->f_cn(),$query);
        mysqli_close($this->f_cn());
        return $rs;
    }

    public  function combo()
    {
        $query="SELECT id_contactos,nombre from contactos";
        $rs=mysqli_query($this->f_cn(),$query);
        mysqli_close($this->f_cn());
        return $rs;
    }
    

}

?>