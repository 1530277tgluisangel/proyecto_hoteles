<?php 
    if(!isset($_SESSION['usuario'])&&$_SESSION['usuario']['tipo_usuario']!='admin'){//Valida que solo un administrador acceda a esta página, si no lo redirecciona al login/dashboard
        $URL="index.php?action=login";
        echo "<script >document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }

    $id_usuario = $_GET['id'];//id recibido por el método GET
    $tipos = MvcController::get_tipos_usuarios();//Trae todos los registros de la tabla tipo_usuarios
    $usuario = MvcController::get_usuario_by_id($id_usuario);//Trae los registros de la fila que coincida con el id_usuario
    $res = MvcController::update_usuario($id_usuario);//Valida la activación del método POST del botón 'guardar' y realiza la consulta para actualizar todos los datos de la tabla usuario
 ?>
 <div class="col-md-9" >
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificando usuario</h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombres">Nombre(s)</label>
                  <input type="text" class="form-control" name="nombres" value="<?php echo $usuario['nombres']; ?>"  id="nombres" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="paterno">Apellido paterno</label>
                  <input type="text" class="form-control" name="paterno" value="<?php echo $usuario['paterno']; ?>"  id="paterno" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="materno">Apellido materno</label>
                  <input type="text" class="form-control"  value="<?php echo $usuario['materno']; ?>"  name="materno" id="materno" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="user_name">Nombre de usuario</label>
                  <input type="text" class="form-control" value="<?php echo $usuario['user_name']; ?>"  name="user_name" id="user_name" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="passw">Contraseña</label>
                  <input class="form-control" type="text" value="<?php echo $usuario['passw']; ?>" id="passw" name="passw" required>
                </div>
                <div class="form-group">
                  <label for="tipo_usuario">Tipo de usuario</label>
                  <select class="form-control" name="tipo_usuario" id="tipo_usuario">
                      <?php
                          foreach ($tipos as $tipo) {
                            if($tipo['id']!=$usuario['id_tipo'])
                                echo "<option value='$tipo[id]' >$tipo[nombre] </option>";
                            else
                                echo "<option value='$tipo[id]' selected>$tipo[nombre] </option>";

                          }
                      ?>
                  </select>
                  <p class="help-block">Elejir una opción.</p>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="guardar" class="btn btn-primary">Guardar datos</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
</div>