
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
		                	<th>Numero de habitación</th>
		                	<th>Tipo</th>
		                	<th>Estado</th>
		                	<th>Foto</th>
		                	<th>Precio</th>
				        	<?php if($_SESSION['usuario']['tipo_usuario']=="admin"){ ?>
		                		<th>Acciones</th>
		                	<?php } ?>
		                </tr>
	                </thead>
	                <tbody>
	                	<?php foreach($habitaciones as $habitacion){ ?>
		                	<tr>
				                <td> <?php echo $habitacion['numero']; ?> </td>
				                <td> <?php echo $habitacion['tipo']; ?> </td>
				                <td> <?php echo $habitacion['estado']; ?> </td>
				                <td> <img class="img-fluid" alt="Responsive image" style="max-width: 150px!important;max-height: 150px!important;" src="<?php echo '/taw_2019/proy_hoteles/views/img/habitaciones/'.$habitacion['foto']; ?>"> </td>
				                <td> <?php echo $habitacion['precio']; ?> </td>
				                <?php if($_SESSION['usuario']['tipo_usuario']=="admin"){ ?>
					                <td> 
					                	<a type="button" class="btn btn-warning" href="index.php?action=modificar_habitaciones&id=<?php echo $habitacion['id']; ?>" title="Modificar" data-toggle="tooltip"><i class="fa fa-fw fa-edit"></i></a>
					                	<a type="button" class="btn btn-danger" onclick="confirmar('<?php echo $habitacion['id']; ?>')" title="Eliminar" data-toggle="tooltip"><i class="fa fa-fw fa-trash"></i></a>
					                </td>
				            	<?php } ?>
			                </tr>
			            <?php }?>
	                </tbody>
	                <tfoot>
		                <tr>
		                  <th>Numero de habitación</th>
		                  <th>Tipo</th>
		                  <th>Estado</th>
		                  <th>Foto</th>
		                  <?php if($_SESSION['usuario']['tipo_usuario']=="admin"){ ?>
		                  	<th>Acciones</th>
		                  <? } ?>
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
                location.href="index.php?action=eliminar_registro&id="+id+"&tabla=habitaciones";
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
