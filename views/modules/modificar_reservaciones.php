<?php
	if(!isset($_SESSION['usuario'])&&$_SESSION['usuario']['tipo_usuario']!='admin'){

        $URL="index.php?action=login";
        echo "<script >document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }

    $clientes = MvcController::show_clientes();
    $habitaciones = MvcController::show_habitaciones();


    $id_reservacion = $_GET['id'];
    
    $reservacion = MvcController::get_reservacion_by_id($id_reservacion);
    #var_dump($reservacion);
    $res = MvcController::update_reservacion($id_reservacion);
?>


<div class="col-md-9" >
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificando reservación</h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
              <div class="box-body">
              	<div class="form-group">
              		<label for="numero">Número de reservación</label>
              		<input type="text" value="<?php echo $reservacion['numero_reservacion']; ?>" name="numero_reservacion" id="numero" class="form-control" required="">
              	</div>
              	<div class="form-group">
                  <label for="id_cliente">Número de cliente</label>
                  <select multiple="" required="" class="form-control" name="id_cliente" id="id_cliente">
                      <?php
                          foreach ($clientes as $cliente){
                          	if($reservacion['id_cliente']!=$cliente['id'])
                            	echo "<option value='$cliente[id]'> $cliente[numero_cliente] </option>";
                          	else
                          		echo "<option value='$cliente[id]' selected> $cliente[numero_cliente] </option>";
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
                          	if($habitacion['id']!=$reservacion['id_habitacion'])
	                            echo "<option value='$habitacion[id]'> $habitacion[numero] </option>";
	                        else
	                       	    echo "<option value='$habitacion[id]' selected> $habitacion[numero] </option>";
                          }
                      ?>
                  </select>
                  <p class="help-block">Elejir una opción.</p>
                </div>
                
               <!-- Date dd/mm/yyyy -->
               <div class="form-group">
                <label>Fecha de reservación:</label>
                <div class="input-group">
	               	<div class="input-group-addon">
	                  <i class="fa fa-calendar"></i>
	                  </div>
	                  <input type="text" id="datemask" name="fecha_reserva" value="<?php echo $reservacion['fecha_reserva']; ?>" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
	                </div>
	                <!-- /.input group -->
              	</div>
              	
              	<div class="form-group">
              		<label for="dias">Días de hospedaje</label>
              		<input min="1" value="<?php echo $reservacion['dias_estadia']; ?>" type="number" name="dias_estadia" id="dias" class="form-control" required="">
              	</div>
               </div>

              <div class="box-footer">
                <button type="submit" name="guardar" class="btn btn-primary">Guardar datos</button>
              </div>
            </form>

        </div>
</div>
<script type="text/javascript">

  	$(function () {
	    //Datemask dd/mm/yyyy
	    $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
	})
</script>