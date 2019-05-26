
  <?php
    if(isset($_SESSION['usuario'])){
      $URL="index.php?action=dashboard";
      echo "<script>document.location.href='{$URL}';</script>";
      echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }
    $controlador = new MvcController();
    $controlador->c_login();
  
?>
  <div class="hold-transition register-page" style="padding-bottom: 50px!important;">
          <!-- Horizontal Form -->
          <div class="register-logo">
            <a href="#"><b>Hotel</b>TAW</a>
          </div>
          <div class="register-box">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="register-box-body" method="post">
              <div class="box-body">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Nombre de usuario"><span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña"><span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> Remember me
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="registrar" class="btn btn-info pull-right form-control">Iniciar sesión</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
</div>
