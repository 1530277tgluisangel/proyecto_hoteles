<?php
	if(!isset($_SESSION['usuario'])&&$_SESSION['usuario']['tipo_usuario']!='admin'){
	  $URL="index.php?action=login";
	  echo "<script >document.location.href='{$URL}';</script>";
	  echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
	}

	$tipos = MvcController::get_tipos_clientes();
	$res = MvcController::insert_cliente();

?>

<div class="col-md-9" >
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Nuevo cliente</h3>
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
                  <label for="numero_cliente">Número de cliente</label>
                  <input type="text" class="form-control" name="numero_cliente" id="numero_cliente" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="nombres">Nombre(s)</label>
                  <input type="text" class="form-control" name="nombres" id="nombres" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="paterno">Apellido paterno</label>
                  <input type="text" class="form-control" name="paterno" id="paterno" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="materno">Apellido materno</label>
                  <input type="text" class="form-control" name="materno" id="materno" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="tipo_cliente">Tipo de cliente</label>
                  <select class="form-control" name="tipo_cliente" id="tipo_cliente">
                      <?php
                          foreach ($tipos as $tipo) {
                            echo "<option value='$tipo[id]'> $tipo[nombre] </option>";
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