<?php 
    if(!isset($_SESSION['usuario'])&&$_SESSION['usuario']['tipo_usuario']!='admin'){
        $URL="index.php?action=login";
        echo "<script >document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }

    $id_habitacion = $_GET['id'];
    $tipos = MvcController::get_tipos_habitaciones();//arreglo de consulta a tabla tipos_habitaciones
    $estados = MvcController::get_estados_habitaciones();//arreglo de consulta a tabla estados_habitaciones
    $habitacion = MvcController::get_habitacion_by_id($id_habitacion);
    #var_dump($habitacion);
    #var_dump($habitacion);
    $res = MvcController::update_habitacion($id_habitacion,$habitacion['foto']);
 ?>
<div class="col-md-9" >
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificando datos de habitación</h3>
            </div>
          <?php if($res==1){ ?>
              <div class="box box-success" style="background: #dff0d8!important;color:green!important;margin:0 auto;width: 70%;">
                <div class="box-header with-border">
                  <h3 class="box-title">Notificación</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  Los datos fueron guardados exitosamente.
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
          <?php } ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="numero_habitacion">Número de la habitación</label>
                  <input type="text" class="form-control" name="numero" id="numero_habitacion" placeholder="" required value="<?php echo $habitacion['numero']; ?>" >
                </div>
                <div class="form-group">
                  <label for="foto_habitacion">Foto de la habitación</label>
                  <input type="text" class="form-control" disabled="" value="Foto actual: <?php echo $habitacion['foto']; ?>">
                  <input type="file" id="foto_habitacion" name="foto_habitacion">
                  <p class="help-block">Elija una nueva foto, de otra forma se conservará la actual.</p>
                </div>
                <div class="form-group">
                  <label for="precio">Precio (c/noche)</label>
                  <input type="text" value="<?php echo $habitacion['precio']; ?>" class="form-control"  name="precio" id="precio" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="tipo_habitacion">Tipo de habitación</label>
                  <select multiple="" class="form-control" name="tipo_habitacion" id="tipo_habitacion" placeholder="" required>
                      <?php
                          foreach ($tipos as $tipo) {
                            if($habitacion['id_tipo_habitacion'] != $tipo[id])
                              echo "<option value='$tipo[id]' > Tipo: $tipo[nombre] - Precio: $ $tipo[precio] </option>";
                            else
                              echo "<option value='$tipo[id]' selected> Tipo: $tipo[nombre] - Precio: $ $tipo[precio] </option>";
                            
                          }
                      ?>
                  </select>
                  <p class="help-block">Elejir una opción.</p>
                </div>
                <div class="form-group">
                  <label for="numero_habitacion">Estado de la habitación</label>
                  <select class="form-control" name="estado" id="estado" placeholder="" required>
                      <?php
                          foreach ($estados as $estado) {
                            if($habitacion['id_estado'] != $estado[id])
                              echo "<option value='$estado[id]' > $estado[nombre] </option>";
                            else
                                echo "<option value='$estado[id]' selected> $estado[nombre] </option>";
                          }
                      ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="descripcion">Descipción</label>
                  <textarea name="descripcion" class="form-control" id="descripcion" placeholder=""><?php echo $habitacion['descripcion']; ?></textarea>
                  <p class="help-block">Este campo no es obligatorio.</p>
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