<?php
	
    if(!isset($_SESSION['usuario'])&&$_SESSION['usuario']['tipo_usuario']!='admin'){
      $URL="index.php?action=login";
      echo "<script >document.location.href='{$URL}';</script>";
      echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }

    $clientes = MvcController::show_clientes();
    $habitaciones = MvcController::habitaciones_disponibles();

    $res = MvcController::insert_reservacion();
?>

<div class="col-md-9" >
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Nueva reservación</h3>
            </div>
            <!-- /.box-header -->

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

            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
              <div class="box-body">
              	<div class="form-group">
              		<label for="numero">Número de reservación</label>
              		<input type="text" name="numero_reservacion" id="numero" class="form-control" required="">
              	</div>
              	<div class="form-group">
                  <label for="id_cliente">Número de cliente</label>
                  <select multiple="" required="" class="form-control" name="id_cliente" id="id_cliente">
                      <?php
                          foreach ($clientes as $cliente) {
                            echo "<option value='$cliente[id]'> $cliente[numero_cliente] </option>";
                          }
                          if(empty($clientes))
                          	echo "<option disabled> No hay registros. </option>";
                      ?>
                  </select>
                  <p class="help-block">Elejir una opción.</p>
                </div>

              	<div class="form-group">
                  <label for="id_habitacion">Número de habitación</label>
                  <select multiple="" required="" class="form-control" name="id_habitacion" id="id_habitacion">
                      <?php
                          foreach ($habitaciones as $habitacion) {
                            echo "<option value='$habitacion[id]'> $habitacion[numero] </option>";
                          }
                          if(empty($habitaciones))
                          	echo "<option disabled> No hay registros. </option>";
                      ?>
                  </select>
                  <p class="help-block">Elejir una opción.</p>
                </div>

              	<div class="form-group">
              		<label for="dias">Días de hospedaje</label>
              		<input min="1" value="1" type="number" name="dias_estadia" id="dias" class="form-control" required="">
              	</div>
              </div>

              <div class="box-footer">
                <button type="submit" name="guardar" class="btn btn-primary">Guardar datos</button>
              </div>
            </form>

        </div>
</div>