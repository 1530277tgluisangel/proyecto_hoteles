<?php 
    if(!isset($_SESSION['usuario'])||$_SESSION['usuario']['tipo_usuario']!='admin'){
        $URL="index.php?action=login";
        echo "<script >document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }

    $id_cliente = $_GET['id'];
    $tipos = MvcController::get_tipos_clientes();
    $cliente = MvcController::get_cliente_by_id($id_cliente);
    $res = MvcController::update_cliente($id_cliente);
 ?>

<div class="col-md-9" >
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Nuevo cliente</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="numero_cliente">Número de cliente</label>
                  <input type="text" value="<?php echo $cliente['numero_cliente']; ?>" class="form-control" name="numero_cliente" id="numero_cliente" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="nombres">Nombre(s)</label>
                  <input type="text" value="<?php echo $cliente['nombres']; ?>"  class="form-control" name="nombres" id="nombres" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="paterno">Apellido paterno</label>
                  <input type="text" value="<?php echo $cliente['paterno']; ?>"  class="form-control" name="paterno" id="paterno" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="materno">Apellido materno</label>
                  <input type="text" value="<?php echo $cliente['materno']; ?>"  class="form-control" name="materno" id="materno" placeholder="" required>
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