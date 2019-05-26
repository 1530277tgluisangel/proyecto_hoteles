
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Sistema gestor de hotel</title>
	<style type="text/css">
		.malert{
			background: #dff0d8!important;
			color:green!important;
			margin:0 auto;width: 70%;
		}
	</style>
	<?php include_once('modules/head-links.php'); #session_start();?>

</head>

<?php #if($_GET['action']!='login'){
	include_once "modules/navegacion.php"; //ssh root@167.99.171.84?>
<body class="skin-black fixed sidebar-mini sidebar-mini-expand-feature">
	<div class="content-wrapper">
		<section class="content-header"><?php #}?>
			<?php 
				$mvc = new MvcController();

				include_once('modules/foot-links.php');#Se agregan aqui las etiquetas/links Javascript ya que es necesario adjuntarlas al proyecto antes que se carguen las vistas

				$mvc -> enlacesPaginasController();#Función que carga las vistas en función de la url que se recibe
			?>
		</section>
	</div>
</body>
</html>