
<?php
	if(!isset($_SESSION['usuario'])||$_SESSION['usuario']['user_name']!='admin'){
    	$URL="index.php?action=login";
    	echo "<script >document.location.href='{$URL}';</script>";
	    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
	}
    $clientes = MvcController::show_clientes();//Arreglo con consulta a datos sobre las habitaciones, en archivo controllers/controller.php
?>
<div class="col-md-9" >
          <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Lista de habitaciones</h3>
            </div>
            <div class="box-body">
            	<table id="clientes" class="table table-bordered table-striped">
	                <thead>
		                <tr>
		                	<th>Numero de cliente</th>
		                	<th>Nombres</th>
		                	<th>Apellido paterno</th>
		                	<th>Apellido materno</th>
		                	<th>Tipo de cliente</th>
		                	<th>Acciones</th>
		                </tr>
	                </thead>
	                <tbody>
	                	<?php foreach($clientes as $cliente){ ?>
		                	<tr>
				                <td> <?php echo $cliente['numero_cliente']; ?> </td>
				                <td> <?php echo $cliente['nombres']; ?> </td>
				                <td> <?php echo $cliente['paterno']; ?> </td>
				                <td> <?php echo $cliente['materno']; ?> </td>
				                <td> <?php echo $cliente['nombre_tipo']; ?> </td>
				                <td> 
				                	<a type="button" class="btn btn-warning" href="index.php?action=modificar_clientes&id=<?php echo $cliente['id']; ?>" title="Modificar" data-toggle="tooltip"><i class="fa fa-fw fa-edit"></i></a>
				                	<a type="button" class="btn btn-danger" onclick="confirmar('<?php echo $cliente['id']; ?>')" title="Eliminar" data-toggle="tooltip"><i class="fa fa-fw fa-trash"></i></a>
				                </td>
			                </tr>
			            <?php }?>
	                </tbody>
	                <tfoot>
		                <tr>
		                	<th>Numero de cliente</th>
		                	<th>Nombres</th>
		                	<th>Apellido paterno</th>
		                	<th>Apellido materno</th>
		                	<th>Tipo de cliente</th>
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
                location.href="index.php?action=eliminar_registro&id="+id+"&tabla=clientes";
            }
            else {
            //AQUI NO HARIA NADA, SE CERRARIA EL POPUP Y SEGUIRIA EN LA PAGINA ACTUAL
            }
        }

		$(function () {
			$('#clientes').DataTable()
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
