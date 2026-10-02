<?php
include_once("../model_class/modulo.php");
include_once("../model_class/sub_modulo.php");
include_once("../model_class/permiso.php");
$obj_m= new modulo();
$obj_sm= new sub_modulo();
$obj_p= new permiso();


?>
      <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="" class="d-block"><?php echo $_SESSION['nombre']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="font-size:11px">
          <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
          <?php
          $rs_modulo=$obj_m->read();
          while($filaM=mysqli_fetch_assoc($rs_modulo)){
            $obj_p->id_rol=$_SESSION['id_rol'];
            $obj_p->id_modulo= $filaM["id_modulo"];
            $obj_p->consult_crud_x_rol_modulo();
            if ($obj_p->ver==1) {
              if ($filaM["estado"]==1) {
          ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              <?php echo $filaM["modulo"] ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php
            $rs_sub_modulo=$obj_sm->read();
            while($filaSM=mysqli_fetch_assoc($rs_sub_modulo)){
              if ($filaSM["estado"]==1) {
              if ($filaM["id_modulo"]==$filaSM["id_modulo"]) {
            ?>
              <li class="nav-item">
                <a href="<?php echo $filaSM["enlace"];?>" class="nav-link active">
                  <i class="far fa-user nav-icon"></i>
                  <p><?php echo $filaSM["sub_modulo"];?></p>
                </a>
              </li>      
              <?php }}} ?>
            </ul>
          </li>
          <?php }}} ?>
          <li class="nav-item">
            <a href="logout.php" class="nav-link active">
              <i class="far fa-user nav-icon"></i>
              <p>Cerrar sesion</p>
            </a>
          </li>  

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->