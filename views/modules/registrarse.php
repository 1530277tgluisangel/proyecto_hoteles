<div class="content">

  <div class="col-md-9">
          <!-- Horizontal Form -->
          <div class="box box-info">
              <h1 class="box-title">REGISTRARSE</h1>
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombres" class="col-sm-2 control-label">Nombres</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombres">
                  </div>
                </div>
                <div class="form-group">
                  <label for="apellidos" class="col-sm-2 control-label">Apellidos</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos">
                  </div>
                </div>
                <div class="form-group">
                  <label for="usuario" class="col-sm-2 control-label">Usuario</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="usuario" id="usuario" placeholder="usuario">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password" class="col-sm-2 control-label">Contraseña</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="registrar" class="btn btn-info pull-right form-control">Guardar datos</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
</div>
 <?php
  
  $controlador = new MvcController();
  $controlador->c_insert_usuario();
  
?>