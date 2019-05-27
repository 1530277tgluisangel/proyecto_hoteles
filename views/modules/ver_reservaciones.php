<?php
	if(!isset($_SESSION['usuario'])){
    	$URL="index.php?action=login";
    	echo "<script >document.location.href='{$URL}';</script>";
	    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
	}
    $reservaciones = MvcController::show_reservaciones();//Arreglo con consulta a datos sobre las habitaciones, en archivo controllers/controller.php
?>

<div class="col-md-9" >
          <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Lista de reservaciones</h3>
            </div>
            <div class="box-body">
            	<table id="reservaciones" class="table table-bordered table-striped">
	                <thead>
		                <tr>
		                	<th>Número de cliente</th>
		                	<th>Número de habitación</th>
		                	<th>Número de reservación</th>
		                	<th>Fecha</th>
		                	<th>Acciones</th>
		                </tr>
	                </thead>
	                <tbody>
	                	<?php foreach($reservaciones as $reservacion){ ?>
		                	<tr>
				                <td> <?php echo $reservacion['numero_cliente']; ?> </td>
				                <td> <?php echo $reservacion['numero_habitacion']; ?> </td>
				                <td> <?php echo $reservacion['numero_reservacion']; ?> </td>
				                <td> <?php echo $reservacion['fecha']; ?> </td>
				                <td> 
				                	<a type="button" class="btn btn-warning" href="index.php?action=modificar_reservaciones&id=<?php echo $reservacion['id']; ?>" title="Modificar" data-toggle="tooltip"><i class="fa fa-fw fa-edit"></i></a>
				                	<a type="button" class="btn btn-danger" onclick="confirmar('<?php echo $reservacion['id']; ?>')" title="Eliminar" data-toggle="tooltip"><i class="fa fa-fw fa-trash"></i></a>
				                </td>
			                </tr>
			            <?php }?>
	                </tbody>
	                <tfoot>
		                <tr>
		                	<th>Número de cliente</th>
		                	<th>Número de habitación</th>
		                	<th>Número de reservación</th>
		                	<th>Fecha</th>
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
                location.href="index.php?action=eliminar_registro&id="+id+"&tabla=reservaciones";
            }
            else {
            //AQUI NO HARIA NADA, SE CERRARIA EL POPUP Y SEGUIRIA EN LA PAGINA ACTUAL
            }
        }

		$(function () {
			$('#reservaciones').DataTable()
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
