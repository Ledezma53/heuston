<?php
include_once("cn.php");
class reg_producto extends cn{

    var $id_producto;
    var $nombre;
    var $precio;
    var $fecha_caducidad;
    var $imagen;
    var $categoria;
    var $stock;
    

    public function create()
    {
        $query="INSERT INTO producto VALUES(0,'$this->nombre',$this->precio,'$this->fecha_caducidad',
        '$this->imagen','$this->categoria',$this->stock)";
        $rs=mysqli_query($this->f_cn(),$query);
        mysqli_close($this->f_cn());
        return $rs;
    }
    public function update()
    {
        $query = "UPDATE producto SET 
                    nombre = '$this->nombre',
                    precio = $this->precio,
                    fecha_caducidad = '$this->fecha_caducidad',
                    imagen = '$this->imagen',
                    categoria = '$this->categoria',
                    stock = $this->stock
                WHERE id_producto = $this->id_producto";

        $rs = mysqli_query($this->f_cn(), $query);
        mysqli_close($this->f_cn());

        return $rs;
    }

    public  function combo()
    {
        $query="SELECT id_producto,nombre from producto";
        $rs=mysqli_query($this->f_cn(),$query);
        mysqli_close($this->f_cn());
        return $rs;
    }
    public function consult()
    {
        $query="SELECT * FROM producto WHERE id_producto='$this->id_producto'";
        $rs=mysqli_query($this->f_cn(),$query);
        if($fila=mysqli_fetch_array($rs)){
            $this->id_producto=$fila["id_producto"];
            $this->nombre=$fila["nombre"];
            $this->precio=$fila["precio"];
            $this->fecha_caducidad=$fila["fecha_caducidad"];
            $this->imagen=$fila["imagen"];
            $this->categoria=$fila["categoria"];
            $this->stock=$fila["stock"];
        }
        mysqli_close($this->f_cn());
        return $rs;
    }
    public function list()
    {
        $query="SELECT * FROM producto";
        $rs=mysqli_query($this->f_cn(),$query);
        mysqli_close($this->f_cn());
        return $rs;
    }

}

?>