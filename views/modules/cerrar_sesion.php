<?php
	$_SESSION=array();
	session_destroy();

    $URL="index.php?action=login";
    echo "<script >document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
?>