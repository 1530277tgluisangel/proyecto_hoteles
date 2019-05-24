<div class="col-md-9" >
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Nuevo usuario</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <div class="form-group">
                  <label for="user_name">Nombre(s)</label>
                  <input type="text" class="form-control" name="user_name" id="user_name" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="paterno">Apellido paterno</label>
                  <input type="text" class="form-control" name="paterno" id="paterno" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="materno">Apellido materno</label>
                  <input type="text" class="form-control" name="maaterno" id="materno" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="user_name">Nombre de usuario</label>
                  <input type="text" class="form-control" name="user_name" id="user_name" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="passw">Contraseña</label>
                  <input class="form-control" type="password" id="passw" name="passw" required>
                </div>
                <div class="form-group">
                  <label for="tipo_habitacion">Tipo de usuario</label>
                  <select multiple="" class="form-control" name="tipo_habitacion" id="tipo_habitacion" placeholder="" required>
                      <?php
                          foreach ($tipos as $tipo) {
                            echo "<option value='$tipo[id]' > Tipo: $tipo[nombre] - Precio: $ $tipo[precio] </option>";
                          }
                      ?>
                  </select>
                  <p class="help-block">Elejir una opción.</p>
                </div>
                <div class="form-group">
                  <label for="descripcion">Descipción</label>
                  <textarea name="descripcion" class="form-control" id="descripcion" placeholder="" required> </textarea>
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