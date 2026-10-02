<?php

include_once("cn.php");
class login extends cn{

    var $id_usuario;
    var $usuario;
    var $contraseña;
    
    public function loginUser()
    {
        $query="SELECT id_usuario,estado FROM usuario WHERE 
        usuario = '$this->usuario' and  
        contraseña = '$this->contraseña'";
        $rs=mysqli_query($this->f_cn(),$query);
        mysqli_close($this->f_cn());
        return $rs;
    }

    public function sesionLogin($iduser)
    {
        $this->id_usuario = $iduser;
        $query="SELECT id_usuario,
        usuario,contraseña,estado,id_rol
        FROM usuario 
        WHERE id_usuario = $this->id_usuario";
        $rs=mysqli_query($this->f_cn(),$query);
        mysqli_close($this->f_cn());
        return $rs;
    }
}
?>
