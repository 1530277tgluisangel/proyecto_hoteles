
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Sistema gestor de hotel</title>

	<?php include_once('modules/head-links.php'); #session_start();?>

</head>

<?php include_once "modules/navegacion.php";?>
<body class="skin-black fixed sidebar-mini sidebar-mini-expand-feature">
	<div class="content-wrapper">
		<section class="content-header">
			<?php 
				$mvc = new MvcController();
				$mvc -> enlacesPaginasController();
			?>
		</section>
	</div>
</body>
<?php include_once('modules/foot-links.php');?>
</html>