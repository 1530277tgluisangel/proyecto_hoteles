 <?php
 	if(!isset($_SESSION['usuario'])){
	    $URL="index.php?action=login";
	    echo "<script >document.location.href='{$URL}';</script>";
	    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
 	}
 	var_dump($_SESSION['usuario']);
?>