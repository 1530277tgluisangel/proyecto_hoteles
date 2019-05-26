<?php
	
	if(!isset($_SESSION['usuario'])&&$_SESSION['usuario']['tipo_usuario']!='admin'){
	  $URL="index.php?action=login";
	  echo "<script >document.location.href='{$URL}';</script>";
	  echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
	}

	$usuarios = MvcController::show_usuarios();//Arreglo con consulta a datos sobre las habitaciones, en archivo controllers/controller.php

?>



<?php
	if(!isset($_SESSION['usuario'])){
    	$URL="index.php?action=login";
    	echo "<script >document.location.href='{$URL}';</script>";
	    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
	}
    $habitaciones = MvcController::show_habitaciones();//Arreglo con consulta a datos sobre las habitaciones, en archivo controllers/controller.php
?>
<div class="col-md-9" >
          <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Lista de habitaciones</h3>
            </div>
            <div class="box-body">
            	<table id="habitaciones" class="table table-bordered table-striped">
	                <thead>
		                <tr>
		                	<th>Nombre de usuario</th>
		                	<th>Contraseña</th>
		                	<th>Nombres</th>
		                	<th>Apellido paterno</th>
		                	<th>Apellido materno</th>
		                	<th>Tipo de usuario</th>
		                	<th>Acciones</th>
		                </tr>
	                </thead>
	                <tbody>
	                	<?php foreach($usuarios as $usuario){ 
	                		if($usuario['user_name']!=$_SESSION['usuario']['user_name']){?>
		                	<tr>
				                <td> <?php echo $usuario['user_name']; ?> </td>
				                <td> <?php echo $usuario['passw']; ?> </td>
				                <td> <?php echo $usuario['nombres']; ?> </td>
				                <td> <?php echo $usuario['paterno']; ?> </td>
				                <td> <?php echo $usuario['materno']; ?> </td>
				                <td> <?php echo $usuario['nombre_tipo']; ?> </td>
				                <td> 
				                	<a type="button" class="btn btn-warning" href="index.php?action=modificar_usuarios&id=<?php echo $usuario['id']; ?>" title="Modificar" data-toggle="tooltip"><i class="fa fa-fw fa-edit"></i></a>
				                	<a type="button" class="btn btn-danger" onclick="confirmar('<?php echo $usuario['id']; ?>')" title="Eliminar" data-toggle="tooltip"><i class="fa fa-fw fa-trash"></i></a>
				                </td>
			                </tr>
			            <?php }} ?>
	                </tbody>
	                <tfoot>
		                <tr>
		                	<th>Nombre de usuario</th>
		                	<th>Contraseña</th>
		                	<th>Nombres</th>
		                	<th>Apellido paterno</th>
		                	<th>Apellido materno</th>
		                	<th>Tipo de usuario</th>
		                	<th>Acciones</th>
		                </tr>
	                </tfoot>
            	</table>
        	</div>
        </div>
</div>

<script>

		function confirmar(id){
            var reply=confirm("¿Seguro que desea eliminar este registro?");
            if (reply==true){
                location.href="index.php?action=eliminar_registro&id="+id+"&tabla=usuarios";
            }
            else {
            //AQUI NO HARIA NADA, SE CERRARIA EL POPUP Y SEGUIRIA EN LA PAGINA ACTUAL
            }
        }

		$(function () {
			$('#habitaciones').DataTable()
			/*$('#example2').DataTable({
			  'paging'      : true,
			  'lengthChange': false,
			  'searching'   : false,
			  'ordering'    : true,
			  'info'        : true,
			  'autoWidth'   : false
			})*/
		})
</script>