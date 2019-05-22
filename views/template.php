
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Práctica 5</title>

	<?php include_once('modules/head-links.php'); #session_start();?>

</head>

<?php include_once "modules/navegacion.php";?>
<body class="hold-transition skin-blue sidebar-mini">
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